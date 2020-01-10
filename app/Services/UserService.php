<?php


namespace App\Services;


use App\Repositories\UserRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Support\Facades\Auth;

class UserService extends AppService
{
    use CrudMethods;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * ClientsController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUser()
    {
        return Auth::user();
    }

    public function getUserWithProviderOrClient($email)
    {
        $user = $this->repository
            ->with('provider')
            ->with('client')
            ->findWhere(['email' => $email])
            ->first();

        if(!$user) {
            $this->responseERROR['message'] = 'Não foi possível encontrar esse usuário';
            $this->responseERROR['status'] = 404;
            return $this->responseERROR;
        }

        return $this->responseOK['data'] = $user;
    }
}
