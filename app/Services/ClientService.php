<?php


namespace App\Services;


use App\Repositories\ClientRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Support\Facades\DB;

class ClientService extends AppService
{
    use CrudMethods;

    /**
     * @var ClientRepository
     */
    protected $repository;

    /**
     * ClientsController constructor.
     *
     * @param ClientRepository $repository
     */
    public function __construct(ClientRepository $repository)
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
    public function addUseClient(int $id, array $data)
    {
        $client = $this->repository->find($id);
        return $client->user()->with('client')->create([
            'name' => $client->name,
            'email' => $client->email,
            'password' => bcrypt($data['password'])
        ]);
    }
}
