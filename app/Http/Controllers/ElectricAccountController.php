<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\ElectricAccountService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ElectricAccountCreateRequest;
use App\Http\Requests\ElectricAccountUpdateRequest;
use App\Repositories\ElectricAccountRepository;
use App\Validators\ElectricAccountValidator;

/**
 * Class ElectricAccountController.
 *
 * @package namespace App\Http\Controllers;
 */
class ElectricAccountController extends Controller
{
    use CrudMethods;

    /**
     * @var ElectricAccountService
     */
    protected $service;

    /**
     * @var ElectricAccountValidator
     */
    protected $validator;

    /**
     * ElectricAccountController constructor.
     *
     * @param ElectricAccountService $service
     * @param ElectricAccountValidator $validator
     */
    public function __construct(ElectricAccountService $service, ElectricAccountValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

    public function allPhases()
    {
        return response()->json($this->service->allPhases());
    }
}
