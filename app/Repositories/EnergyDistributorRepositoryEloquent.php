<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EnergyDistributorRepository;
use App\Entities\EnergyDistributor;
use App\Validators\EnergyDistributorValidator;

/**
 * Class EnergyDistributorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EnergyDistributorRepositoryEloquent extends BaseRepository implements EnergyDistributorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EnergyDistributor::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EnergyDistributorValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
