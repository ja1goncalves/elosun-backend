<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ElectricStationRepository;
use App\Entities\ElectricStation;
use App\Validators\ElectricStationValidator;

/**
 * Class ElectricStationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ElectricStationRepositoryEloquent extends BaseRepository implements ElectricStationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ElectricStation::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ElectricStationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
