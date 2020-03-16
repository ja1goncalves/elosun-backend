<?php


namespace App\Services;


use App\Repositories\UserRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $data = $this->repository
            ->with([
                'client.addresses',
                'client.electricAccounts',
                'client.electricAccounts.address',
                'client.electricAccounts.energyDistributor',
                'client.orders',
                'client.bankAccounts'
            ])->with([
                'provider.addresses',
                'provider.electricStations',
                'provider.electricStations.address',
                'provider.electricStations.energyDistributor',
                'provider.orders',
                'provider.bankAccounts'
            ])->findWhere(['email' => Auth::user()['email']])
            ->first();

        if(!$data) {
            return $this->returnError([], 'Não foi possível encontrar esse usuário', 404);
        }

        return $this->returnSuccess($data->toArray());
    }

    public function getSearchs($info)
    {
        $data = [];

        if(isset($info['name'])){
            $data[] = ['name', 'LIKE', "%".$info['name']."%"];
        }
        if(isset($info['email'])){
            $data[] = ['email', 'LIKE', "%".$info['email']."%"];
        }

        return  $this->repository->where($data)->paginate(15);
    }

    public function getDetail($info)
    {
        $id = $info["id"];
        $user = $this->repository->find($id);

        if ($user) {
        $data = [
            'name' => $user['name'],
            'email' => $user['email']
            ];
     }

     return $this->returnSuccess($data);
    }

    public function getUpdateUrser(array $data)
    {
        $user = $this->repository->find($data['id']);

        if ($user) {
        $user = [
            'name' => $data['name'],
            'email' => $data['email']
        ];
        
        if(!empty($data['password'])){
          $user['password'] = Hash::make($data['password']);
        }

        $this->repository->update($user, $data['id']);
      }

      return $this->returnSuccess([], 'Usuário atualizado com sucesso!');
    }
}
