<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BankAccountsRepository;
use App\Entities\BankAccounts;
use App\Validators\BankAccountsValidator;

/**
 * Class BankAccountsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BankAccountsRepositoryEloquent extends BaseRepository implements BankAccountsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BankAccounts::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BankAccountsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
