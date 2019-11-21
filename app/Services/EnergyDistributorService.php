<?php


namespace App\Services;


use App\Repositories\EnergyDistributorRepository;
use App\Services\Traits\CrudMethods;

class EnergyDistributorService extends AppService
{
    use CrudMethods;

    /**
     * @var EnergyDistributorRepository
     */
    protected $repository;

    /**
     * ClientsController constructor.
     *
     * @param EnergyDistributorRepository $repository
     */
    public function __construct(EnergyDistributorRepository $repository)
    {
        $this->repository = $repository;
    }

}
