<?php


namespace App\Services;


use App\Entities\Client;
use App\Entities\ElectricStation;
use App\Entities\Order;
use App\Entities\Provider;
use App\Jobs\SendMailBySendGrid;
use App\Repositories\AddressRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ElectricStationRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProviderRepository;
use App\Services\Traits\CrudMethods;
use App\Util;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class OrderService extends AppService
{
    use CrudMethods;

    /**
     * @var OrderRepository
     */
    protected $repository;

    /**
     * @var ProviderRepository
     */
    protected $provider;

    /**
     * @var ClientRepository
     */
    protected $client;

    /**
     * @var AddressRepository
     */
    protected $address;

    /**
     * @var ElectricStationRepository
     */
    protected $electricStation;

    /**
     * @var ProviderService
     */
    protected $providerService;

    /**
     * @var ClientService
     */
    protected $clientService;

    /**
     * ClientsController constructor.
     *
     * @param OrderRepository $repository
     * @param ProviderRepository $provider
     * @param AddressRepository $address
     * @param ClientRepository $client
     * @param ElectricStationRepository $electricStation
     * @param ProviderService $providerService
     * @param ClientService $clientService
     */
    public function __construct(OrderRepository $repository, ProviderRepository $provider, AddressRepository $address,
                                ClientRepository $client, ElectricStationRepository $electricStation,
                                ProviderService $providerService, ClientService $clientService)
    {
        $this->repository = $repository;
        $this->provider = $provider;
        $this->address = $address;
        $this->client = $client;
        $this->electricStation = $electricStation;
        $this->providerService = $providerService;
        $this->clientService = $clientService;
    }

    public function sale(array $data)
    {
        $provider = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'cellphone' => $data['cellphone'],
            'cpf_cnpj' => $data['cpf_cnpj'] ?? null
        ];

        $provider = $this->provider->updateOrCreate($provider);

        $address = $provider->addresses()->updateOrCreate($data['address']);

        $order = [
            'start_watts' => $data['start_watts'],
            'end_watts' => $data['end_watts'],
            'type_order' => Order::SALE,
            'order_status_id' => 2
        ];

        $this->responseOK['data']['provider'] = $provider;
        $this->responseOK['data']['address'] = $address;
        $this->responseOK['data']['order'] = $provider->orders()->create($order);

        $url_front = Config::get('services.provider_front.url');
        $data_send_mail = [
            'to' => $provider['email'],
            'subject' => 'Confirmar cadastro de venda',
            'user' => $provider,
            'order' => $this->responseOK['data']['order'],
            'url' => url("{$url_front}/cadastro-fornecedor/".$this->responseOK['data']['order']['id'])
        ];
        SendMailBySendGrid::dispatch($data_send_mail, 'confirm_order')->delay(0.5);

        return $this->responseOK;
    }

    public function purchase(array $data)
    {
        $client = [
            'name' => $data['name'],
            'email' => $data['email'],
            'cellphone' => $data['cellphone'],
            'cpf_cnpj' => $data['cpf_cnpj'] ?? null
        ];

        $client = $this->client->updateOrCreate($client);

        $address = $client->addresses()->updateOrCreate($data['address']);

        $order = [
            'start_watts' => $data['start_watts'],
            'end_watts' => $data['end_watts'],
            'type_order' => Order::PURCHASE,
            'order_status_id' => 2
        ];

        $this->responseOK['data']['client'] = $client;
        $this->responseOK['data']['address'] = $address;
        $this->responseOK['data']['order'] = $client->orders()->create($order);

        $url_front = Config::get('services.provider_front.url');
        $data_send_mail = [
            'to' => $client['email'],
            'subject' => 'Confirmar cadastro de compra',
            'user' => $client,
            'order' => $this->responseOK['data']['order'],
            'url' => url("{$url_front}/cadastro-fornecedor/".$this->responseOK['data']['order']['id'])
        ];
        SendMailBySendGrid::dispatch($data_send_mail, 'confirm_order')->delay(0.5);

        return $this->responseOK;
    }

    public function getByInterval($interval)
    {
        $interval_date = Util::getIntervalDate($interval);

        $orders = $this->repository
            ->with('orderly')
            ->with('status')
            ->orderBy('end_watts')
            ->findWhereBetween('created_at', $interval_date);

        $this->responseOK['data'] = [
            'purchase' => $orders->where('type_order', Order::PURCHASE)->take(10),
            'sale' => $orders->where('type_order', Order::SALE)->take(10),
            'total' => $orders->count()
        ];
        $this->responseOK['error'] = false;

        return $this->responseOK;
    }

    public function getOrderly(int $id)
    {
        return $this->repository->getOrderWithOrderlyAndAddress($id);
    }

    /**
     * @param array $data
     * @return array
     */
    public function updateOrderly(array $data)
    {
        $order = $this->repository->getOrderWithOrderlyAndAddress($data['order']['id']);

        if ($order->orderly_type == Provider::class) {
            $user = $this->providerService->addUserProvider($data['provider']['id'], $data['provider']);
            $data['provider']['user_id'] = $user->id;
            $provider = $this->provider->update($data['provider'], $data['provider']['id']);
            $address = $this->address->update($data['provider']['address'], $data['provider']['address']['id']);

            $station = $this->electricStation
                ->with('address')
                ->findWhere(['code_gd' => strtoupper($data['provider']['station']['code_gd'])])
                ->first();
            $station->provider_id = $provider->id;
            $station = $this->electricStation->update($station->toArray(), $station->id);

            if (!is_null($data['provider']['station']['address'])) {
                $this->address->update($data['provider']['station']['address'], $station->address->id);
            }
        } else if ($order->orderly_type == Client::class) {
            $client = $this->client->update($data['client'], $data['client']['id']);
            $user = $this->clientService->addUseClient($client->id, $data['client']);
            $address = $client->addresses()->update($data['client']['address'], $data['client']['address']['id']);

            $account = $client->electricAccounts()->create($data['client']['account']);
            $address_account = $account->address()->updateOrCreate($data['client']['account']['address'], $data['client']['account']['address']);
        } else {
            $this->responseERROR['message'] = 'O pedido é inválido, pois não tem comprador ou vendedor!';
            return $this->responseERROR;
        }

        return [
            'user' => $user,
            'provider' => $provider ?? null,
            'client' => $client ?? null,
            'address' => $address,
            'account' => $account ?? null,
            'station' => $station ?? null,
        ];
    }
}
