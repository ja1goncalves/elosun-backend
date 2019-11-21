<?php


namespace App\Services;


use App\Entities\Client;
use App\Entities\Order;
use App\Entities\Provider;
use App\Repositories\AddressRepository;
use App\Repositories\ClientRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProviderRepository;
use App\Services\Traits\CrudMethods;

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
     * ClientsController constructor.
     *
     * @param OrderRepository $repository
     * @param ProviderRepository $provider
     * @param AddressRepository $address
     * @param ClientRepository $client
     */
    public function __construct(OrderRepository $repository, ProviderRepository $provider, AddressRepository $address,
                                ClientRepository $client)
    {
        $this->repository = $repository;
        $this->provider = $provider;
        $this->address = $address;
        $this->client = $client;
    }

    public function sale(array $data)
    {
        $provider = $this->provider->findByField('email', $data['email']);

        if (!$provider) {
            $provider = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'cellphone' => $data['cellphone'],
                'cpf_cnpj' => $data['cpf_cnpj']
            ];

            $provider = $this->provider->create($provider);
        }

        $address = $this->address($data['address'], $provider, Provider::class);

        $order = [
            'start_watts' => $data['start_watts'],
            'end_watts' => $data['end_watts'],
            'type_order' => Order::SALE,
            'orderly_type' => Provider::class,
            'orderly_id' => $provider['id'],
        ];

        $this->response['data']['provider'] = $provider;
        $this->response['data']['address'] = $this->address->create($address);
        $this->response['data'] = $this->repository->create($order);

        return $this->response;
    }

    public function purchase(array $data)
    {
        $client = $this->client->findByField('email', $data['email']);

        if (!$client) {
            $client = [
                'name' => $data['name'],
                'email' => $data['email'],
                'cellphone' => $data['cellphone'],
                'cpf_cnpj' => $data['cpf_cnpj']
            ];

            $client = $this->client->create($client);
        }

        $address = $this->address($data['address'], $client, Client::class);

        $order = [
            'start_watts' => $data['start_watts'],
            'end_watts' => $data['end_watts'],
            'type_order' => Order::PURCHASE,
            'orderly_type' => Client::class,
            'orderly_id' => $client['id'],
        ];

        $this->response['data']['client'] = $client;
        $this->response['data']['address'] = $this->address->create($address);
        $this->response['data']['order'] = $this->repository->create($order);

        return $this->response;
    }

    private function address($address, $addressable, $type)
    {
        if (isset($address['zip_code'])) {
            $_address = $this->address->findWhere([
                'zip_code' => $address['zip_code'],
            ]);

            if(!$_address){
                $address['addressable_id'] = $addressable['id'];
                $address['addressable_type'] = $type;
            }
        } else {
            $address['addressable_id'] = $addressable['id'];
            $address['addressable_type'] = $type;
        }

        return $address;
    }
}
