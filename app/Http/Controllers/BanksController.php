<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\BankService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BanksCreateRequest;
use App\Http\Requests\BanksUpdateRequest;
use App\Repositories\BanksRepository;
use App\Validators\BanksValidator;

/**
 * Class BanksController.
 *
 * @package namespace App\Http\Controllers;
 */
class BanksController extends Controller
{
    use CrudMethods;
    /**
     * @var BanksRepository
     */
    protected $repository;

    /**
     * @var BankService
     */
    protected $service;

    /**
     * BanksController constructor.
     *
     * @param BanksRepository $repository
     * @param BankService $service
     */
    public function __construct(BanksRepository $repository, BankService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }

}
