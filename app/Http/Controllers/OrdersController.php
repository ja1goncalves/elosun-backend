<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\OrderService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Repositories\OrderRepository;
use App\Validators\OrderValidator;

/**
 * Class OrdersController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrdersController extends Controller
{
    use CrudMethods;

    /**
     * @var OrderService
     */
    protected $service;

    /**
     * @var OrderValidator
     */
    protected $validator;

    /**
     * OrdersController constructor.
     *
     * @param OrderService $service
     * @param OrderValidator $validator
     */
    public function __construct(OrderService $service, OrderValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

    public function sale(OrderCreateRequest $request)
    {
        $response = $this->service->sale($request->all());
        return response()->json($response, $response['status']);
    }

    public function purchase(OrderCreateRequest $request)
    {
        
        $response = $this->service->purchase($request->all());
        return response()->json($response, $response['status']);
    }

    public function getOrdersByIntervalDate(Request $request)
    {
        $request->validate([
            'days' => 'required|min:1'
        ]);

        $response = $this->service->getByInterval($request->get('days'));

        return response()->json($response, $response['error'] ? 500:200);
    }

    public function getOrderly($id)
    {
        return response()->json($this->service->getOrderly($id));
    }
    
}
