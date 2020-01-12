<?php


namespace App\Services;


use App\Presenters\BanksPresenter;
use App\Repositories\BanksRepository;
use App\Repositories\SegmentsRepository;
use App\Services\Traits\CrudMethods;

class BankService extends AppService
{
    use CrudMethods;

    /**
     * @var BanksRepository
     */
    protected $repository;

    /**
     * @var SegmentsRepository
     */
    protected $segments;

    /**
     * BankService constructor.
     * @param BanksRepository $banksRepository
     * @param SegmentsRepository $segments
     */
    public function __construct(BanksRepository $banksRepository, SegmentsRepository $segments)
    {
        $this->repository = $banksRepository;
        $this->segments = $segments;
    }

    public function getAllBanks()
    {
        return $this->repository
            ->setPresenter(BanksPresenter::class)
            ->all();
    }

    /**
     * @param int $bank_id
     * @return mixed
     */
    public function findByBank(int $bank_id)
    {
        return $this->segments->findWhere(['bank_id' => $bank_id]);
    }
}
