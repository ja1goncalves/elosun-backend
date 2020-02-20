<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\ElectricStationService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ElectricStationCreateRequest;
use App\Http\Requests\ElectricStationUpdateRequest;
use App\Validators\ElectricStationValidator;

/**
 * Class ElectricStationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ElectricStationsController extends Controller
{
    use CrudMethods;

    /**
     * @var ElectricStationService
     */
    protected $service;

    /**
     * @var ElectricStationValidator
     */
    protected $validator;

    /**
     * ElectricStationsController constructor.
     *
     * @param ElectricStationService $service
     * @param ElectricStationValidator $validator
     */
    public function __construct(ElectricStationService $service, ElectricStationValidator $validator)
    {
        $this->service = $service;
        $this->validator  = $validator;
    }

    public function index(Request $request)
    {
        $form = $request->input("formInfo");
        $form['id'] = $request->input("id"); 


        return response()->json($this->service->getSearchs($form));
    }
}
