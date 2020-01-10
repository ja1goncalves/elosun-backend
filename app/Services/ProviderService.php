<?php


namespace App\Services;


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
     * ClientsController constructor.
     *
     * @param ProviderRepository $repository
     * @param UserRepository $userRepository
     */
    public function __construct(ProviderRepository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
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
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function addUserProvider(int $id, array $data)
    {
        $provider = $this->repository->with('user')->find($id);
        return $provider->user_id ? $provider->user : $this->userRepository->create([
            'name' => $provider->name,
            'email' => $provider->email,
            'password' => bcrypt($data['password'])
        ]);
    }
}
