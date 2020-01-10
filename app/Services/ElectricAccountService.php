<?php


namespace App\Services;


use App\Enums\PhasesEnum;
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

    public function allPhases()
    {
        $this->responseOK['data'] = PhasesEnum::allPhases();
        return $this->responseOK;
    }
}
