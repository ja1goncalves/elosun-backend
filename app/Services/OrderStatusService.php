<?php


namespace App\Services;


use App\Repositories\OrdersStatusRepository;
use App\Services\Traits\CrudMethods;

class OrderStatusService extends AppService
{
    use CrudMethods;

    /**
     * @var OrdersStatusRepository
     */
    protected $repository;

    /**
     * ClientsController constructor.
     *
     * @param OrdersStatusRepository $repository
     */
    public function __construct(OrdersStatusRepository $repository)
    {
        $this->repository = $repository;
    }
}
