<?php


namespace App\Services;


use App\Presenters\BanksPresenter;
use App\Repositories\BanksRepository;
use App\Services\Traits\CrudMethods;

class BankService extends AppService
{
    use CrudMethods;

    /**
     * @var BanksRepository
     */
    protected $repository;

    /**
     * BankService constructor.
     * @param BanksRepository $banksRepository
     */
    public function __construct(BanksRepository $banksRepository)
    {
        $this->repository = $banksRepository;
    }

    public function getAllBanks()
    {
        return $this->repository
            ->setPresenter(BanksPresenter::class)
            ->all();
    }}
