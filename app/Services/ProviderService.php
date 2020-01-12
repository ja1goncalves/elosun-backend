<?php


namespace App\Services;


use App\Entities\Provider;
use App\Repositories\AddressRepository;
use App\Repositories\BankAccountsRepository;
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
     * @var ElectricStationRepository
     */
    protected $electricStation;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var BankAccountsRepository
     */
    protected $bankAccounts;

    /**
     * ClientsController constructor.
     *
     * @param ProviderRepository $repository
     * @param UserRepository $userRepository
     * @param ElectricStationRepository $electricStationRepository
     * @param OrderRepository $orderRepository
     * @param BankAccountsRepository $bankAccounts
     */
    public function __construct(ProviderRepository $repository, UserRepository $userRepository,
                                ElectricStationRepository $electricStationRepository,
                                OrderRepository $orderRepository, BankAccountsRepository $bankAccounts)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->electricStation = $electricStationRepository;
        $this->orderRepository = $orderRepository;
        $this->bankAccounts = $bankAccounts;
    }

    public function bestsByOrders($limit = 15)
    {
        try{
            return $this->returnSuccess($this->repository->bestByOrders($limit));
        }catch (\Exception $e) {
            return $this->returnError([], $e->getMessage());
        }
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

        $provider['bank'] = $provider->bankAccounts()->create($data['provider']['bank']);

        $provider['address'] = $provider->addresses()->update($data['provider']['address'], $data['provider']['address']['id']);

        $station = $this->electricStation
            ->with('address')
            ->findWhere(['code_gd' => strtoupper($data['provider']['station']['code_gd'])])
            ->first();

        if (is_null($station))
            return $this->returnError([], 'Estação não encontrada com esse código GD na ANEEL', 404);

        if (!is_null($data['provider']['statexitsion']['address'])) {
            $data['provider']['station']['address']['electric'] = true;
            $station->address()->update($data['provider']['station']['address'], $station->address->id);
        }

        $station->provider_id = $provider->id;
        $station = $this->electricStation->update($station->toArray(), $station->id);
        $station['address'] = $station->address()->get();

        return $this->returnSuccess([
            'user' => $user,
            'provider' => $provider,
            'station' => $station,
        ]);
    }
}
