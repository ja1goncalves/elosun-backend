<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\ProviderService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProviderCreateRequest;
use App\Http\Requests\ProviderUpdateRequest;
use App\Validators\ProviderValidator;

/**
 * Class ProvidersController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProvidersController extends Controller
{
    use CrudMethods;

    /**
     * @var ProviderService
     */
    protected $service;

    /**
     * @var ProviderValidator
     */
    protected $validator;

    /**
     * ProvidersController constructor.
     *
     * @param ProviderService $service
     * @param ProviderValidator $validator
     */
    public function __construct(ProviderService $service, ProviderValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }
}
