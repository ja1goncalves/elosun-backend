<?php

namespace App\Http\Controllers;

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
    /**
     * @var ElectricStationRepository
     */
    protected $repository;

    /**
     * @var ElectricStationValidator
     */
    protected $validator;

    /**
     * ElectricStationsController constructor.
     *
     * @param ElectricStationRepository $repository
     * @param ElectricStationValidator $validator
     */
    public function __construct(ElectricStationRepository $repository, ElectricStationValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $electricStations = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $electricStations,
            ]);
        }

        return view('electricStations.index', compact('electricStations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ElectricStationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ElectricStationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $electricStation = $this->repository->create($request->all());

            $response = [
                'message' => 'ElectricStation created.',
                'data'    => $electricStation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $electricStation = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $electricStation,
            ]);
        }

        return view('electricStations.show', compact('electricStation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $electricStation = $this->repository->find($id);

        return view('electricStations.edit', compact('electricStation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ElectricStationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ElectricStationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $electricStation = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ElectricStation updated.',
                'data'    => $electricStation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'ElectricStation deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ElectricStation deleted.');
    }
}
