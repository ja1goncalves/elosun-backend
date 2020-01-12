<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\ClientService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Validators\ClientValidator;

/**
 * Class ClientsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ClientsController extends Controller
{
    use CrudMethods;

    /**
     * @var ClientValidator
     */
    protected $validator;

    /**
     * @var ClientService
     */
    protected $service;

    /**
     * ClientsController constructor.
     *
     * @param ClientService $service
     * @param ClientValidator $validator
     */
    public function __construct(ClientService $service, ClientValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

    public function bestsByOrders(Request $request)
    {
        $response = $this->service->bestsByOrders($request->query->get('limit', 15));
        return response()->json($response, $response['error'] ? 500 : 200);
    }

    public function updateClientByOrder(ClientUpdateRequest $request)
    {
        return response()->json($this->service->updateByOrder($request->all()));
    }
}
