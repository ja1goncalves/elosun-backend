<?php


namespace App\Services;


use App\Entities\ProductionTypes;
use App\Enums\PhasesEnum;
use App\Repositories\ElectricAccountRepository;
use App\Repositories\ProductionTypesRepository;
use App\Services\Traits\CrudMethods;

class ElectricAccountService extends AppService
{
    use CrudMethods;

    /**
     * @var ElectricAccountRepository
     */
    protected $repository;

    /**
     * @var ProductionTypesRepository
     */
    protected $consumptionTypes;

    /**
     * ClientsController constructor.
     *
     * @param ElectricAccountRepository $repository
     */
    public function __construct(ElectricAccountRepository $repository, ProductionTypesRepository $productionTypes)
    {
        $this->repository = $repository;
        $this->consumptionTypes = $productionTypes;
    }

    public function allPhases()
    {
        $this->responseOK['data'] = PhasesEnum::allPhases();
        return $this->responseOK;
    }

    public function allConsumptionTypes()
    {
        return $this->consumptionTypes->all(['id', 'class']);
    }
}
