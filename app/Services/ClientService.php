<?php


namespace App\Services;


use App\Repositories\ClientRepository;
use App\Services\Traits\CrudMethods;

class ClientService
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
}
