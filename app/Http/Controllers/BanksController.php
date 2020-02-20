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
     * @var BanksValidator
     */
    protected $validator;

    /**
     * @var BankService
     */
    protected $service;

    /**
     * BanksController constructor.
     *
     * @param BanksValidator $validator
     * @param BankService $service
     */
    public function __construct(BanksValidator $validator, BankService $service)
    {
        $this->validator = $validator;
        $this->service  = $service;
    }

    public function listAll() {
        return $this->service->getAllBanks();
    }

    public function listSegments($bank_d)
    {
        return $this->service->findByBank($bank_d);
    }
}
