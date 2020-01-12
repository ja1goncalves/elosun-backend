<?php


namespace App\Services;


use App\Repositories\BankAccountsRepository;
use App\Services\Traits\CrudMethods;

class BankAccountService extends AppService
{
    use CrudMethods;

    /**
     * @var BankAccountsRepository
     */
    protected $repository;

    /**
     * BankAccountService constructor.
     * @param BankAccountsRepository $accountsRepository
     */
    public function __construct(BankAccountsRepository $accountsRepository)
    {
        $this->repository = $accountsRepository;
    }
}
