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
use App\Repositories\ProviderRepository;

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
    public function __construct(ProviderService $service, ProviderValidator $validator, ProviderRepository $repository)
    {
        $this->service = $service;
        $this->validator  = $validator;
        $this->repository = $repository;
    }

    public function bestsByOrders(Request $request)
    {
        $response = $this->service->bestsByOrders($request->query->get('limit', 15));
        return response()->json($response, $response['error'] ? 500 : 200);
    }

    public function updateProviderByOrder(ProviderUpdateRequest $request)
    {
        return response()->json($this->service->updateByOrder($request->all()));
    }

    public function index(Request $request)
    {
        $form = $request->input("formInfo");
        $lead = $request->input("lead");

        if (isset($lead)) {
            $form['orderStatusId'] = 2; 
        }

        return response()->json($this->service->getSearchs($form));
    }
}

