<?php


namespace App\Services;


use App\Repositories\ElectricStationRepository;
use App\Services\Traits\CrudMethods;

class ElectricStationService extends AppService
{
    use CrudMethods {
        all    as public processAll;
    }

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

    public function all($limit = 15)
    {
        $this->repository
            ->resetCriteria()
            ->pushCriteria(app('App\Criteria\FilterElectricStationsByDistributorsCriteria'));

        return $this->returnSuccess($this->processAll($limit));
    }

}
