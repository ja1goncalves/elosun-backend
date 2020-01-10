<?php


namespace App\Services;


use App\Entities\EnergyDistributor;
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

            $this->responseOK['data']['distributors'] = $distributors;
            $this->responseOK['error'] = false;
        }catch (\Exception $e){
            $this->responseOK['message'] = $e->getMessage();
            $this->responseOK['error'] = true;
        }

        return $this->responseOK;
    }

    public function updateCrw($data)
    {
        $distributors = $data['distributors'];
        try{
            foreach ($distributors as $distributor){
                $update = [
                    'name' => $this->getNameDistributor($distributor['company']),
                    'total_stations' => (int)$distributor['amount'],
                    'total_ucs' => (int)$distributor['ucs'],
                    'potency_kW' => (float)str_replace(',', '.', $distributor['potency']),
                    'initials' => $this->getNameInitials($distributor['company']),
                    'link_ucs' => $distributor['link']
                ];

                $this->repository->updateOrCreate([
                        'name' => $update['name'],
                        'link_ucs' => $update['link_ucs'],
                        'initials' => $update['initials']
                    ], $update);
            }

            $this->responseOK['message'] = 'Distribuidoras de energia atualizadas!';
        }catch (\Exception $e){
            $this->responseOK['error'] = true;
            $this->responseOK['message'] = $e->getMessage();
            $this->responseOK['status'] = 500;
            \Log::error($e);
        }

        return $this->responseOK;
    }

    private function getNameDistributor($name)
    {
        $name = explode('(', $name);
        return trim($name[0]);
    }

    private function getNameInitials($name)
    {
        $name = explode('(', $name);
        return trim($name[1], ')');
    }
}
