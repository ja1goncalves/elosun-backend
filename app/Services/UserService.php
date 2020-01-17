<?php


namespace App\Services;


use App\Repositories\UserRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Support\Facades\Auth;

class UserService extends AppService
{
    use CrudMethods;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * ClientsController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUser()
    {
        return Auth::user();
    }

    public function getUserProviderOrClient()
    {
        $data = $this->repository
            ->with([
                'client.addresses',
                'client.electricAccounts',
                'client.electricAccounts.address',
                'client.electricAccounts.energyDistributor',
                'client.orders',
                'client.bankAccounts'
            ])->with([
                'provider.addresses',
                'provider.electricStations',
                'provider.electricStations.address',
                'provider.electricStations.energyDistributor',
                'provider.orders',
                'provider.bankAccounts'
            ])->findWhere(['email' => Auth::user()['email']])
            ->first();

        if(!$data) {
            return $this->returnError([], 'Não foi possível encontrar esse usuário', 404);
        }

        return $this->returnSuccess($data->toArray());
    }
}
