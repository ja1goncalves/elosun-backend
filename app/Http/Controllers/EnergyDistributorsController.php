<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\EnergyDistributorService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EnergyDistributorCreateRequest;
use App\Http\Requests\EnergyDistributorUpdateRequest;
use App\Repositories\EnergyDistributorRepository;
use App\Validators\EnergyDistributorValidator;

/**
 * Class EnergyDistributorsController.
 *
 * @package namespace App\Http\Controllers;
 */
class EnergyDistributorsController extends Controller
{
    use CrudMethods;

    /**
     * @var EnergyDistributorService
     */
    protected $service;

    /**
     * @var EnergyDistributorValidator
     */
    protected $validator;

    /**
     * EnergyDistributorsController constructor.
     *
     * @param EnergyDistributorService $service
     * @param EnergyDistributorValidator $validator
     */
    public function __construct(EnergyDistributorService $service, EnergyDistributorValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }
}
