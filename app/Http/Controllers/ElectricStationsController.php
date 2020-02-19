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
    public function __construct(ElectricStationService $service, ElectricStationValidator $validator, ElectricStationRepository $repository)
    {
        $this->service = $service;
        $this->validator  = $validator;
        $this->repository = $repository;
    }


    public function searchs(Request $request)
    {
        $data = [];
        $data[] = ['energy_distributor_id', '=', $request->input("id")];
        $form = $request->input("formInfo");

        if(isset($form['name'])){
            $data[] = ['name', 'LIKE', "%".$form['name']."%"];
        }
        if(isset($form['holder'])){
            $data[] = ['holder', 'LIKE', "%".$form['holder']."%",];
        }
        if(isset($form['potencykW'])){
            $data[] = ['potency_kW', 'LIKE', "%".$form['potencykW']."%",];
        }
        if(isset($form['subgroup'])){
            $data[] = ['subgroup', 'LIKE', "%".$form['subgroup']."%",];
        } 
        if(isset($form['dateConnection']) && !empty($form['dateConnection'])){
            $data[] = ['connection_at', 'LIKE', $form['dateConnection']."%"];
        }

        return  response()->json($this->repository->where($data)->paginate(15));   
    }
}
