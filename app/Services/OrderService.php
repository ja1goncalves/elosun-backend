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

        $email = $this->provider->findWhere([['email', "=" ,$data['email']] ]);
   
        if (count($email) > 0) {
            
            return $this->returnError([], 'E-mail já cadastrado.', 200);
    
        } else {

            $provider = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'cellphone' => $data['cellphone'],
                'cpf_cnpj' => $data['cpf_cnpj'] ?? null
            ];
        }
        
        $provider = $this->provider->updateOrCreate($provider);

        $address = $provider->addresses()->updateOrCreate($data['address']);

        $order = [
            'start_watts' => $data['start_watts'],
            'end_watts' => $data['end_watts'],
            'type_order' => Order::SALE,
            'order_status_id' => 2
        ]; 


        $return['order'] = $provider->orders()->create($order);

        $return['provider'] = $provider;
        $return['address'] = $address;

        $url_front = Config::get('services.provider_front.url');
        $data_send_mail = [
            'to' => $provider['email'],
            'subject' => 'Confirmar cadastro de venda',
            'user' => $provider,
            'order' => $return['order'],
            'url' => url("{$url_front}/cadastro/".$return['order']['id'])
        ];
        SendMailBySendGrid::dispatch($data_send_mail, 'confirm_order')->delay(0.5);

        return $this->returnSuccess($return);
    }

    public function purchase(array $data)
    {
        $email = $this->client->findWhere([['email', "=" ,$data['email']] ]);

        if (count($email) > 0) {
            
            return $this->returnError([], 'E-mail já cadastrado.', 200);
    
        } else {
            $client = [
                'name' => $data['name'],
                'email' => $data['email'],
                'cellphone' => $data['cellphone'],
                'cpf_cnpj' => $data['cpf_cnpj'] ?? null
            ];
        }    

        $client = $this->client->updateOrCreate($client);

        $address = $client->addresses()->updateOrCreate($data['address']);

        $order = [
            'start_watts' => $data['start_watts'],
            'end_watts' => $data['end_watts'],
            'type_order' => Order::PURCHASE,
            'order_status_id' => 2
        ];

        $return['client'] = $client;
        $return['address'] = $address;
        $return['order'] = $client->orders()->create($order);

        $url_front = Config::get('services.provider_front.url');
        $data_send_mail = [
            'to' => $client['email'],
            'subject' => 'Confirmar cadastro de compra',
            'user' => $client,
            'order' => $return['order'],
            'url' => url("{$url_front}/cadastro/".$return['order']['id'])
        ];
        SendMailBySendGrid::dispatch($data_send_mail, 'confirm_order')->delay(0.5);

        return $this->returnSuccess($return);
    }

    public function getByInterval($interval)
    {
        $interval_date = Util::getIntervalDate($interval);

        $orders = $this->repository
            ->with('orderly')
            ->with('status')
            ->orderBy('end_watts')
            ->findWhereBetween('created_at', $interval_date);

        return $this->returnSuccess([
            'purchase' => $orders->where('type_order', Order::PURCHASE)->take(10),
            'sale' => $orders->where('type_order', Order::SALE)->take(10),
            'total' => $orders->count()
        ]);
    }

    public function getOrderly(int $id)
    {
        return $this->repository->getOrderWithOrderlyAndAddress($id);
    }
}
