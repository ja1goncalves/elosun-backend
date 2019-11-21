<?php


namespace App\Services;


use App\Repositories\ElectricStationRepository;
use App\Services\Traits\CrudMethods;

class ElectricStationService extends AppService
{
    use CrudMethods;

    /**
     * @var ElectricStationRepository
     */
    protected $repository;

    /**
     * ClientsController constructor.
     *
     * @param ElectricStationRepository $repository
     */
    public function __construct(ElectricStationRepository $repository)
    {
        $this->repository = $repository;
    }

}
