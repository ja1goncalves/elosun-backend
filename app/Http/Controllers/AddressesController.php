<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\AddressService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AddressCreateRequest;
use App\Http\Requests\AddressUpdateRequest;
use App\Validators\AddressValidator;

/**
 * Class AddressesController.
 *
 * @package namespace App\Http\Controllers;
 */
class AddressesController extends Controller
{
    use CrudMethods;

    /**
     * @var AddressService
     */
    protected $service;

    /**
     * @var AddressValidator
     */
    protected $validator;

    /**
     * AddressesController constructor.
     *
     * @param AddressService $service
     * @param AddressValidator $validator
     */
    public function __construct(AddressService $service, AddressValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }
}
