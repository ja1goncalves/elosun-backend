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

    public function getAllInitials()
    {
        $initials = $this->repository->all('initials')->toArray();
        return $this->returnSuccess(array_column($initials, 'initials'));
    }

    public function populars()
    {
        try{
            $distributors = $this->repository
                ->withCount('electricAccounts')
                ->withCount('electricStations')
                ->all()
                ->groupBy('name');

            return $this->returnSuccess($distributors);
        }catch (\Exception $e){
            return $this->returnError([], $e->getMessage());
        }
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

            return $this->returnSuccess([], 'Distribuidoras de energia atualizadas!');
        }catch (\Exception $e){
            \Log::error($e);
            return $this->returnError([], $e->getMessage());
        }
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
