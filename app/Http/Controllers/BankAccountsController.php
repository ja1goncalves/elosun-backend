<?php

namespace App\Http\Controllers;

use App\Services\BankAccountService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BankAccountsCreateRequest;
use App\Http\Requests\BankAccountsUpdateRequest;
use App\Validators\BankAccountsValidator;

/**
 * Class BankAccountsController.
 *
 * @package namespace App\Http\Controllers;
 */
class BankAccountsController extends Controller
{
    /**
     * @var BankAccountsValidator
     */
    protected $validator;

    /**
     * @var BankAccountService
     */
    protected $service;

    /**
     * BankAccountsController constructor.
     *
     * @param BankAccountService $service
     * @param BankAccountsValidator $validator
     */
    public function __construct(BankAccountService $service, BankAccountsValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

}
