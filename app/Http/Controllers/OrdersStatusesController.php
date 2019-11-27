<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\OrderStatusService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Validators\OrdersStatusValidator;

/**
 * Class OrdersStatusesController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrdersStatusesController extends Controller
{
    use CrudMethods;

    /**
     * @var OrderStatusService
     */
    protected $service;

    /**
     * @var OrdersStatusValidator
     */
    protected $validator;

    /**
     * OrdersStatusesController constructor.
     *
     * @param OrderStatusService $service
     * @param OrdersStatusValidator $validator
     */
    public function __construct(OrderStatusService $service, OrdersStatusValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }
}
