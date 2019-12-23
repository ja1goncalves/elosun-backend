<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductionTypesRepository;
use App\Entities\ProductionTypes;
use App\Validators\ProductionTypesValidator;

/**
 * Class ProductionTypesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductionTypesRepositoryEloquent extends BaseRepository implements ProductionTypesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductionTypes::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
