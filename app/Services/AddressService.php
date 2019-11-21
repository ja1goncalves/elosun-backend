<?php


namespace App\Services;


use App\Repositories\AddressRepository;
use App\Services\Traits\CrudMethods;

class AddressService extends AppService
{
    use CrudMethods;

    /**
     * @var AddressRepository
     */
    protected $repository;

    /**
     * ClientsController constructor.
     *
     * @param AddressRepository $repository
     */
    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }

}
