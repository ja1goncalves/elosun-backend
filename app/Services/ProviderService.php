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
            $this->response['data']['clients'] = $this->repository->bestByOrders($limit);
        }catch (\Exception $e){
            $this->response['message'] = $e->getMessage();
            $this->response['error'] = true;
        }

        return $this->response;
    }
}
