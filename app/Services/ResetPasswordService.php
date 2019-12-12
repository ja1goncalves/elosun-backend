<?php


namespace App\Services;


use App\Entities\User;
use App\Jobs\SendMailBySendGrid;
use App\Repositories\ResetPasswordRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class ResetPasswordService extends AppService
{
    protected $userRepository;

    protected $repository;

    /**
     * @param UserRepository $userRepository
     * @param ResetPasswordRepository $repository
     */
    public function __construct(UserRepository $userRepository, ResetPasswordRepository $repository)
    {
        $this->userRepository = $userRepository;
        $this->repository = $repository;
    }

    public function create($data)
    {
        try{
            $user = $this->userRepository->skipPresenter()->findByField('email', $data['email'])->first();
            $passwordReset = $this->repository->updateOrCreate(
                [
                    'email' => $user->email
                ],
                [
                    'email' => $user->email,
                    'token' => str_random(60)
                ]
            );
            if (isset($user) && isset($passwordReset)){
                $url_front = Config::get("services.front-end.{$data['origin']}");
                $data_send_mail = [
                    'to' => $passwordReset->email,
                    'subject' => 'Mudar senha',
                    'user' => $user,
                    'url_reset' => url("{$url_front}/recuperar-senha/".$passwordReset->token)
                ];

                SendMailBySendGrid::dispatch($data_send_mail, 'password_reset')->delay(0.5);
            }
            return response()->json([
                'error' => false,
                'message' => 'Enviamos um e-mail com um link para mudança de senha!'
            ]);
        }catch (\Exception $e){
            return response()->json(['error' => true, 'message' => "Não encontramos seu usuário ou coisa do tipo."], 404);
        }

    }

    public function find($token)
    {
        $passwordReset = $this->repository->findByField('token', $token)->first();

        if (!$passwordReset)
            return response()->json([
                'error' => true,
                'message' => 'Não encontramos um pedido de mudança com essa chave :(.'
            ], 404);

        if (Carbon::parse($passwordReset->updated_at)->addHours(6)->isPast()) {
            $this->repository->delete($passwordReset->id);

            return response()->json([
                'error' => true,
                'message' => 'O tempo para mudar a senha já passou :(.'
            ], 404);
        }

        return response()->json(['error' => false, 'data' => $passwordReset]);
    }

    public function reset($request)
    {
        $where =[
            'token' => $request->token,
            'email' => $request->email
        ];

        $passwordReset = $this->repository->skipPresenter()->findWhere($where)->first();
        if (!$passwordReset) {
            return response()->json([
                'message' => 'Esse token não pode ser usado pra mudar senha!'
            ], 404);
        }

        $user = $this->userRepository->findByField('email', $passwordReset->email)->first();

        if (!$user) {
            return response()->json([
                'message' => "Não encontramos nenhum registro com esse e-mail :("
            ], 404);
        }

        $user['password'] = bcrypt($request->password);
        $user = $this->userRepository->updateOrCreate($user->toArray());

        $data_send_mail = [
            'to' => $passwordReset->email,
            'subject' => 'Sua senha foi alterada',
            'provider' => $user,
        ];

        SendMailBySendGrid::dispatch($data_send_mail, 'password_change')->delay(0.5);

        $this->repository->delete($passwordReset->id);

        return response()->json([
            'error' => false,
            'message' => 'A senha senha foi mudada com sucesso :)'
        ], 200);
    }
}
