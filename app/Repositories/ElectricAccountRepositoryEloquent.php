<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ElectricAccountRepository;
use App\Entities\ElectricAccount;
use App\Validators\ElectricAccountValidator;

/**
 * Class ElectricAccountRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ElectricAccountRepositoryEloquent extends BaseRepository implements ElectricAccountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ElectricAccount::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ElectricAccountValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
