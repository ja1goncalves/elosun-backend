<?php


namespace App\Services;


use App\Repositories\ElectricAccountRepository;
use App\Services\Traits\CrudMethods;

class ElectricAccountService extends AppService
{
    use CrudMethods;

    /**
     * @var ElectricAccountRepository
     */
    protected $repository;

    /**
     * ClientsController constructor.
     *
     * @param ElectricAccountRepository $repository
     */
    public function __construct(ElectricAccountRepository $repository)
    {
        $this->repository = $repository;
    }
}
