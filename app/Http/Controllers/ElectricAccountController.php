<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ElectricAccountCreateRequest;
use App\Http\Requests\ElectricAccountUpdateRequest;
use App\Repositories\ElectricAccountRepository;
use App\Validators\ElectricAccountValidator;

/**
 * Class ElectricAccountController.
 *
 * @package namespace App\Http\Controllers;
 */
class ElectricAccountController extends Controller
{
    /**
     * @var ElectricAccountRepository
     */
    protected $repository;

    /**
     * @var ElectricAccountValidator
     */
    protected $validator;

    /**
     * ElectricAccountController constructor.
     *
     * @param ElectricAccountRepository $repository
     * @param ElectricAccountValidator $validator
     */
    public function __construct(ElectricAccountRepository $repository, ElectricAccountValidator $validator)
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
        $contractAccounts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contractAccounts,
            ]);
        }

        return view('contractAccounts.index', compact('contractAccounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ElectricAccountCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ElectricAccountCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $contractAccount = $this->repository->create($request->all());

            $response = [
                'message' => 'ElectricAccount created.',
                'data'    => $contractAccount->toArray(),
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
        $contractAccount = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contractAccount,
            ]);
        }

        return view('contractAccounts.show', compact('contractAccount'));
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
        $contractAccount = $this->repository->find($id);

        return view('contractAccounts.edit', compact('contractAccount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ElectricAccountUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ElectricAccountUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $contractAccount = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ElectricAccount updated.',
                'data'    => $contractAccount->toArray(),
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
                'message' => 'ElectricAccount deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ElectricAccount deleted.');
    }
}
