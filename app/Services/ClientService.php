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
            $this->response['data']['clients'] = $this->repository->bestByOrders($limit);
        }catch (\Exception $e){
            $this->response['message'] = $e->getMessage();
            $this->response['error'] = true;
        }

        return $this->response;
    }
}
