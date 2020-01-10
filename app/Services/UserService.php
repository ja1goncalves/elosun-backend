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

    public function getUserProviderOrClient()
    {
        $this->responseOK['data'] = $this->repository
            ->with('client')
            ->with('provider')
            ->findWhere(['email' => Auth::user()['email']])
            ->first();

        if(!$this->responseOK['data']) {
            $this->responseERROR['message'] = 'Não foi possível encontrar esse usuário';
            $this->responseERROR['status'] = 404;
            return $this->responseERROR;
        }

        return $this->responseOK;
    }
}
