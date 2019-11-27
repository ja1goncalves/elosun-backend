<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrdersStatusRepository;
use App\Entities\OrdersStatus;
use App\Validators\OrdersStatusValidator;

/**
 * Class OrdersStatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrdersStatusRepositoryEloquent extends BaseRepository implements OrdersStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrdersStatus::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrdersStatusValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
