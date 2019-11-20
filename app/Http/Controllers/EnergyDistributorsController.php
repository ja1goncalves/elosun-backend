<?php

namespace App\Http\Controllers;

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
    /**
     * @var EnergyDistributorRepository
     */
    protected $repository;

    /**
     * @var EnergyDistributorValidator
     */
    protected $validator;

    /**
     * EnergyDistributorsController constructor.
     *
     * @param EnergyDistributorRepository $repository
     * @param EnergyDistributorValidator $validator
     */
    public function __construct(EnergyDistributorRepository $repository, EnergyDistributorValidator $validator)
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
        $energyDistributors = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $energyDistributors,
            ]);
        }

        return view('energyDistributors.index', compact('energyDistributors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EnergyDistributorCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EnergyDistributorCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $energyDistributor = $this->repository->create($request->all());

            $response = [
                'message' => 'EnergyDistributor created.',
                'data'    => $energyDistributor->toArray(),
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
        $energyDistributor = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $energyDistributor,
            ]);
        }

        return view('energyDistributors.show', compact('energyDistributor'));
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
        $energyDistributor = $this->repository->find($id);

        return view('energyDistributors.edit', compact('energyDistributor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EnergyDistributorUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EnergyDistributorUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $energyDistributor = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'EnergyDistributor updated.',
                'data'    => $energyDistributor->toArray(),
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
                'message' => 'EnergyDistributor deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'EnergyDistributor deleted.');
    }
}
