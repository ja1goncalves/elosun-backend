<?php

namespace App\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterElectricStationsByDistributorsCriteria.
 *
 * @package namespace App\Criteria;
 */
class FilterElectricStationsByDistributorsCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {

        $distributor_id = $this->request->query->get('distributor_id', null);

        if(is_numeric($distributor_id)){
            $model = $model->where('energy_distributor_id', '=', $distributor_id);
        }

        return $model;
    }
}
