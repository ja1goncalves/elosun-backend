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

    public function getSearchs($info)
    {
        $data = [];
        $data[] = ['energy_distributor_id', '=', $info["id"]];

        if(isset($info['name'])){
            $data[] = ['name', 'LIKE', "%".$info['name']."%"];
        }
        if(isset($info['holder'])){
            $data[] = ['holder', 'LIKE', "%".$info['holder']."%",];
        }
        if(isset($info['potencykW'])){
            $data[] = ['potency_kW', 'LIKE', "%".$info['potencykW']."%",];
        }
        if(isset($info['subgroup'])){
            $data[] = ['subgroup', 'LIKE', "%".$info['subgroup']."%",];
        } 
        if(isset($info['dateConnection']) && !empty($info['dateConnection'])){
            $data[] = ['connection_at', 'LIKE', $info['dateConnection']."%"];
        }

        return  $this->repository->where($data)->paginate(15);   
    }

    public function getDetail($info)
    {
        $id = $info["id"];
        $electricStation = $this->repository->with('productionType')->with('address')
                                            ->with('modality')->with('provider')->with('energyDistributor')
                                            ->find($id);

        if ($electricStation) {
        $data = [
            'name' => $electricStation['name'],
            'code_gd' => $electricStation['code_gd'],
            'holder' => $electricStation['holder'],
            'class' => $electricStation['productionType']['class'],
            'subgroup' => $electricStation['subgroup'],
            'area' => $electricStation['area'],
            'potency_kW' => $electricStation['potency_kW'],
            'inverters' => $electricStation['inverters'],
            'modules' => $electricStation['modules'],
            'total_ucs' => $electricStation['total_ucs'],
            'description' => $electricStation['modality']['description'],
            'nameProvider' => $electricStation['provider']['name'],
            'cpf_cnpj' => $electricStation['provider']['cpf_cnpj'],
            'state' => $electricStation['address']['state'],
            'nameEnergyDistributor' => $electricStation['energyDistributor']['name'],
            'connectionAt' => $electricStation['connection_at'],
            'created' => $electricStation['created_at'],
            'updated' => $electricStation['updated_at']
            ];
     }

     return $this->returnSuccess($data);
    }


}
