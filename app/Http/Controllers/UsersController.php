<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    use CrudMethods;

    /**
     * @var UserService
     */
    protected $service;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * UsersController constructor.
     *
     * @param UserService $service
     * @param UserValidator $validator
     */
    public function __construct(UserService $service, UserValidator $validator, UserRepository $repository)
    {
        $this->service = $service;
        $this->validator  = $validator;
        $this->repository = $repository;
    }

    public function create(UserCreateRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function getUserProviderOrClient()
    {
        return response()->json($this->service->getUserProviderOrClient());
    }

    public function index(Request $request)
    {
        $form = $request->input("formInfo");
        return response()->json($this->service->getSearchs($form));
    }
}
