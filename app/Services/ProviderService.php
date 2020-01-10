<?php


namespace App\Services;


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
     * ClientsController constructor.
     *
     * @param ProviderRepository $repository
     */
    public function __construct(ProviderRepository $repository)
    {
        $this->repository = $repository;
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
        $provider = $this->repository->find($id);
        return $provider->user()->with('provider')->create([
            'name' => $provider->name,
            'email' => $provider->email,
            'password' => bcrypt($data['password'])
        ]);
    }
}
