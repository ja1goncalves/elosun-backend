<?php


namespace App\Services;


use App\Repositories\UserRepository;

class AuthService extends AppService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * AuthService constructor.
     * @param UserRepository $repository
     * @param UserService $userService
     */
    public function __construct(UserRepository $repository, UserService $userService)
    {
        $this->repository  = $repository;
        $this->userService = $userService;
    }

    /**
     * @return array
     */
    public function getUserByToken()
    {
        $user  = $this->userService->getUser();

        if (isset($user))
            return ['error' => false, 'data' => $user];
        else
            return ["error" => true, "message" => "Usuário não encontrado!"];
    }

    public function signUpActivate($token)
    {
        $provider = $this->repository->findByField('activation_token', $token)->first();
        if (!$provider) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $providerData = [
            'active'             => true,
            'activation_token'   => '',
        ];

        $this->repository->update($providerData,$provider->id);

        return [
            "error" => false,
            "message" => "Cadastro confirmado com sucesso!",
        ];
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyToken()
    {
        $user = $this->userService->getUser();
        if (!is_null($user)) {
            $user->token()->revoke();
            return response()->json([
                'erro'    => 'false',
                'message' => 'Successfully logged out'
            ]);
        }
        return response()->json([
            'erro'    => 'true',
            'message' => 'User not found'
        ]);
    }
}
