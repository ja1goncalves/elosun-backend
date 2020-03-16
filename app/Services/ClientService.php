<?php


namespace App\Services;


use App\Entities\Client;
use App\Repositories\AddressRepository;
use App\Repositories\BankAccountsRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ElectricAccountRepository;
use App\Repositories\EnergyDistributorRepository;
use App\Repositories\OrderRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Support\Facades\DB;

class ClientService extends AppService
{
    use CrudMethods;

    /**
     * @var ClientRepository
     */
    protected $repository;

    /**
     * @var ElectricAccountRepository
     */
    protected $accounts;

    /**
     * @var EnergyDistributorRepository
     */
    protected $distributors;

    /**
     * @var BankAccountsRepository
     */
    protected $bankAccounts;

    /**
     * @var OrderRepository
     */
    protected $order;

    /**
     * @var AddressRepository
     */
    protected $address;

    /**
     * ClientsController constructor.
     *
     * @param ClientRepository $repository
     * @param ElectricAccountRepository $electricAccountRepository
     * @param EnergyDistributorRepository $energyDistributor
     * @param BankAccountsRepository $bankAccounts
     * @param OrderRepository $order
     * @param AddressRepository $address
     */
    public function __construct(ClientRepository $repository,  ElectricAccountRepository $electricAccountRepository,
                                EnergyDistributorRepository $energyDistributor, BankAccountsRepository $bankAccounts,
                                 AddressRepository $address, OrderRepository $order)
    {
        $this->repository = $repository;
        $this->accounts = $electricAccountRepository;
        $this->distributors = $energyDistributor;
        $this->bankAccounts = $bankAccounts;
        $this->order = $order;
        $this->address = $address;
    }

    public function bestsByOrders($limit = 15)
    {
        try{
            return $this->returnSuccess($this->repository->bestByOrders($limit));
        }catch (\Exception $e){
            return $this->returnError([], $e->getMessage());
        }
    }

    /**
     * @param Client $client
     * @param string $password
     * @return mixed
     */
    public function addUseClient(Client $client, $password)
    {
        return $client['user_id'] ? $client['user'] : $client->user()->with('client')->create([
            'name' => $client['name'],
            'email' => $client['email'],
            'password' => bcrypt($password)
        ]);
    }

    public function updateByOrder(array $data)
    {
        $client = $this->repository->with('user')->find($data['client']['id']);

        $user = $this->addUseClient($client, $data['client']['password']);
        $data['client']['user_id'] = $user->id;
        $client = $this->repository->update($data['client'], $client->id);

        if ($data['client']['bank'])
            $client['bank'] = $client->bankAccounts()->create($data['client']['bank']);

        $client['address'] = $client->addresses()->update($data['client']['address'], $data['client']['address']['id']);

        $distributor = $this->distributors
            ->findWhere(['initials' => $data['client']['electric_account']['distributor_initials']], 'id')
            ->first();
        $data['client']['electric_account']['energy_distributor_id'] = $distributor->id ?? null;
        $account = $client->electricAccounts()->create($data['client']['electric_account']);

        if ($data['client']['electric_account']['address']) {
            $data['provider']['station']['address']['electric'] = true;
            $account['address'] = $account->address()->create($data['client']['electric_account']['address']);
        }

        return $this->returnSuccess([
            'user' => $user,
            'client' => $client,
            'account' => $account,
        ]);
    }

    public function getSearchs($info)
    {
        $data = [];
        $dataOrder = [];
        $addresses = [];

        if(isset($info['name'])){
            $data[] = ['name', 'LIKE', "%".$info['name']."%"];
        }
        if(isset($info['email'])){
            $data[] = ['email', 'LIKE', "%".$info['email']."%"];
        }
        if(isset($info['cellphone'])){
            $data[] = ['cellphone', 'LIKE', "%".$info['cellphone']."%"];
        }
        if(isset($info['orderStatusId'])){
            $dataOrder[] = ['order_status_id', '=', $info['orderStatusId']];
        }
        if(isset($info['startWatts'])){
            $dataOrder[] = ['start_watts', '>=', $info['startWatts']];
        }
        if(isset($info['endWatts'])){
            $dataOrder[] = ['end_watts', '<=', $info['endWatts']];
        }
        if (isset($info['state'])) {
            $addresses[] = ['state', 'LIKE', "%".$info['state']."%"];
        }

        return $this->repository->with(['orders.status', 'addresses'])
        ->whereHas('orders', function($query) use($dataOrder) { 
            $query->where($dataOrder);            
        })
        ->whereHas('addresses', function($query) use($addresses) { 
            $query->where($addresses);            
        })->where($data)->paginate(15);
    }

    public function getDetail($info)
    {
        $id = $info["id"];
        $client = $this->repository->with('addresses')->with('orders')->find($id);

        if ($client) {
        $data = [
            'name' => $client['name'],
            'email' => $client['email'],
            'cpf_cnpj' => $client['cpf_cnpj'],
            'phone' => $client['phone'],
            'cellphone' => $client['cellphone'],
            'created' => $client['created_at'],
            'updated' => $client['updated_at'],
            'state' => $client['addresses'][0]['state'],
            'zip_code' => $client['addresses'][0]['zip_code'],
            'city' => $client['addresses'][0]['city'],
            'street' => $client['addresses'][0]['street'],
            'number' => $client['addresses'][0]['number'],
            'start_watts' => $client['orders'][0]['start_watts'],
            'end_watts' => $client['orders'][0]['end_watts'], 
            'order_status_id' => $client['orders'][0]['order_status_id']
            ];
     }

     return $this->returnSuccess($data);
    }

    public function getUpdateClient(array $data)
    {
        $client = $this->repository->with('addresses')->with('orders')->find($data['id']);

        if ($client) {
        $client = [
            'name' => $data['name'],
            'email' => $data['email'],
            'cpf_cnpj' => $data['cpf_cnpj'],
            'phone' => $data['phone'],
            'cellphone' => $data['cellphone'] 
         ];
         
        $client = $this->repository->update($client, $data['id']);

        $addresses = [
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
            'city' => $data['city'],
            'street' => $data['street'],
            'number' => $data['number']
        ];

        $client->addresses()->update($addresses);

        $order = [
            'start_watts' => $data['start_watts'],
            'end_watts' => $data['end_watts'],
            'order_status_id' => $data['order_status_id']
        ];

        $client->orders()->update($order);

      }
        return $this->returnSuccess([], 'Cliente atualizado com sucesso!');
    }

}
