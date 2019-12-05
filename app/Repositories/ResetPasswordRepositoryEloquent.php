<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ResetPasswordRepository;
use App\Entities\ResetPassword;
use App\Validators\ResetPasswordValidator;

/**
 * Class ResetPasswordRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ResetPasswordRepositoryEloquent extends BaseRepository implements ResetPasswordRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ResetPassword::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ResetPasswordValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
