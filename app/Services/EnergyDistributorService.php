<?php


namespace App\Services;


use App\Repositories\EnergyDistributorRepository;
use App\Services\Traits\CrudMethods;
use function foo\func;

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

    public function populars()
    {
        try{
            $distributors = $this->repository
                ->withCount('electricAccounts')
                ->withCount('electricStations')
                ->all()
                ->groupBy('name');

            $this->response['data']['distributors'] = $distributors;
            $this->response['error'] = false;
        }catch (\Exception $e){
            $this->response['message'] = $e->getMessage();
            $this->response['error'] = true;
        }

        return $this->response;
    }
}
