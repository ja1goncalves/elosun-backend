<?php


namespace App\Services;


use App\Entities\Provider;
use App\Repositories\AddressRepository;
use App\Repositories\ElectricStationRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\Services\Traits\CrudMethods;
use App\Repositories\ProviderRepository;

class ProviderService extends AppService
{
    use CrudMethods;

    /**
     * @var ProviderRepository
     */
    protected $repository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var AddressRepository
     */
    protected $address;

    /**
     * @var ElectricStationRepository
     */
    protected $electricStation;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;
    /**
     * ClientsController constructor.
     *
     * @param ProviderRepository $repository
     * @param UserRepository $userRepository
     * @param AddressRepository $addressRepository
     * @param ElectricStationRepository $electricStationRepository
     * @param OrderRepository $orderRepository
     */
    public function __construct(ProviderRepository $repository, UserRepository $userRepository,
                                AddressRepository $addressRepository, ElectricStationRepository $electricStationRepository,
                                OrderRepository $orderRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->address = $addressRepository;
        $this->electricStation = $electricStationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function bestsByOrders($limit = 15)
    {
        try{
            $this->responseOK['data']['clients'] = $this->repository->bestByOrders($limit);
        }catch (\Exception $e){
            $this->responseOK['message'] = $e->getMessage();
            $this->responseOK['error'] = true;
        }

        return $this->responseOK;
    }

    /**
     * @param Provider $provider
     * @param string $password
     * @return mixed
     */
    public function addUserProvider(Provider $provider, $password)
    {
        return $provider['user_id'] ? $provider['user'] : $provider->user()->create([
            'name' => $provider['name'],
            'email' => $provider['email'],
            'password' => bcrypt($password)
        ]);
    }

    public function updateByOrder(array $data)
    {
        $provider = $this->repository->with('user')->find($data['provider']['id']);

        $user = $this->addUserProvider($provider, $data['provider']['password']);
        $data['provider']['user_id'] = $user->id;
        $provider = $this->repository->update($data['provider'], $provider->id);

        $provider['address'] = $this->address->update($data['provider']['address'], $data['provider']['address']['id']);

        $station = $this->electricStation
            ->with('address')
            ->findWhere(['code_gd' => strtoupper($data['provider']['station']['code_gd'])])
            ->first();

        if (!is_null($data['provider']['station']['address'])) {
            $this->address->update($data['provider']['station']['address'], $station->address->id);
        }

        $station->provider_id = $provider->id;
        $station = $this->electricStation->update($station->toArray(), $station->id);
        $station['address'] = $station->address()->get();

        $this->responseOK['data'] = [
            'user' => $user,
            'provider' => $provider,
            'station' => $station,
        ];

        return $this->responseOK;
    }
}
