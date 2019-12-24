<?php


namespace App\Services;


use App\Entities\Client;
use App\Entities\Order;
use App\Entities\Provider;
use App\Jobs\SendMailBySendGrid;
use App\Repositories\AddressRepository;
use App\Repositories\ClientRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProviderRepository;
use App\Services\Traits\CrudMethods;
use App\Util;
use Carbon\Carbon;

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
     * @var MovideskService
     */
    protected $movideskService;

    /**
     * OrderService constructor.
     * @param OrderRepository $repository
     * @param ProviderRepository $provider
     * @param AddressRepository $address
     * @param ClientRepository $client
     * @param MovideskService $movideskService
     */
    public function __construct(OrderRepository     $repository,
                                ProviderRepository  $provider,
                                AddressRepository   $address,
                                ClientRepository    $client,
                                MovideskService     $movideskService)
    {
        $this->repository       = $repository;
        $this->provider         = $provider;
        $this->address          = $address;
        $this->client           = $client;
        $this->movideskService  = $movideskService;
    }

    public function sale(array $data)
    {
        $provider = [
            'name'      => $data['name'],
            'email'     => $data['email'],
            'phone'     => $data['phone'] ?? null,
            'cellphone' => $data['cellphone'],
            'cpf_cnpj'  => $data['cpf_cnpj'] ?? null
        ];

        $provider = $this->provider->updateOrCreate($provider);

        $address = $provider->addresses()->updateOrCreate($data['address']);

        $order = [
            'start_watts'       => $data['start_watts'],
            'end_watts'         => $data['end_watts'],
            'type_order'        => Order::SALE,
            'order_status_id'   => 2
        ];

        $this->response['data']['provider'] = $provider;
        $this->response['data']['address']  = $address;
        $this->response['data']['order']    = $provider->orders()->create($order);

        $data_send_mail = [
            'to'        => $provider['email'],
            'subject'   => 'Confirmar cadastro de venda',
            'user'      => $provider,
            'order'     => $this->response['data']['order'],
            'url'       => ''
        ];

        SendMailBySendGrid::dispatch($data_send_mail, 'confirm_order')->delay(0.5);

        $params = [
            'type'   	    => 1,
            'subject'       => 'Confirmação de cadastro de venda',
            'createdBy'     => [
                'id'            => '1386645053',
                'personType'    => 1,
                'profileType'   => 2
            ],
            'clients'       => [
                [
                    'id'            => '1386645053',
                    'personType'    => 2,
                    'profileType'   => 2
                ]
            ],
            'actions'       => [
                [
                    'type'          => 2,
                    'description'   => 'O fornecedor de email: ' . $provider['email'] . 'deseja confimar o cadastro da venda do pedido de nº ' . $this->response['data']['order'] . '.'
                ]
            ]
        ];

        $this->movideskService->sendToMovidesk($params);

        return $this->response;
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

        $this->response['data']['client'] = $client;
        $this->response['data']['address'] = $address;
        $this->response['data']['order'] = $client->orders()->create($order);

        $data_send_mail = [
            'to' => $client['email'],
            'subject' => 'Confirmar cadastro de compra',
            'user' => $client,
            'order' => $this->response['data']['order'],
            'url' => ''
        ];
        SendMailBySendGrid::dispatch($data_send_mail, 'confirm_order')->delay(0.5);

        return $this->response;
    }

    public function getByInterval($interval)
    {
        $interval_date = Util::getIntervalDate($interval);

        $orders = $this->repository
            ->with('orderly')
            ->with('status')
            ->orderBy('end_watts')
            ->findWhereBetween('created_at', $interval_date);

        $this->response['data'] = [
            'purchase' => $orders->where('type_order', Order::PURCHASE)->take(10),
            'sale' => $orders->where('type_order', Order::SALE)->take(10),
            'total' => $orders->count()
        ];
        $this->response['error'] = false;

        return $this->response;
    }
}
