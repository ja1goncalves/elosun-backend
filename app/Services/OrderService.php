<?php


namespace App\Services;


use App\Repositories\OrderRepository;
use App\Services\Traits\CrudMethods;

class OrderService extends AppService
{
    use CrudMethods;

    /**
     * @var OrderRepository
     */
    protected $repository;

    /**
     * ClientsController constructor.
     *
     * @param OrderRepository $repository
     */
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function sale(array $data)
    {
        return $this->response;
    }

    public function purchase(array $data)
    {
        return $this->response;
    }
}
