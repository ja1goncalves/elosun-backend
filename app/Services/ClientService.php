<?php


namespace App\Services;


use App\Entities\Client;
use App\Repositories\AddressRepository;
use App\Repositories\BankAccountsRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ElectricAccountRepository;
use App\Repositories\EnergyDistributorRepository;
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
     * @var AddressRepository
     */
    protected $addresses;

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
     * ClientsController constructor.
     *
     * @param ClientRepository $repository
     * @param AddressRepository $addressRepository
     * @param ElectricAccountRepository $electricAccountRepository
     * @param EnergyDistributorRepository $energyDistributor
     * @param BankAccountsRepository $bankAccounts
     */
    public function __construct(ClientRepository $repository, AddressRepository $addressRepository,
                                ElectricAccountRepository $electricAccountRepository,
                                EnergyDistributorRepository $energyDistributor, BankAccountsRepository $bankAccounts)
    {
        $this->repository = $repository;
        $this->addresses = $addressRepository;
        $this->accounts = $electricAccountRepository;
        $this->distributors = $energyDistributor;
        $this->bankAccounts = $bankAccounts;
    }

    public function bestsByOrders($limit = 15)
    {
        try{
            $this->responseOK['data']['clients'] = $this->repository->bestByOrders($limit);
        }catch (\Exception $e){
            $this->responseOK['message'] = $e->getMessage();
            $this->responseOK['error'] = true;
        }

        return $this->responseOK;
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

        if ($client['user']) {
            $this->responseERROR['message'] = 'O fornecedor já foi devidamente cadastrado!';
            return $this->responseERROR;
        }

        $user = $this->addUseClient($client, $data['client']['password']);
        $data['client']['user_id'] = $user->id;
        $client = $this->repository->update($data['client'], $client->id);

        $data['provider']['bank']['provider_id'] = $client->id;
        $client['bank'] = $this->bankAccounts->create($data['provider']['bank']);

        $client['address'] = $this->addresses->update($data['client']['address'], $data['client']['address']['id']);

        $distributor = $this->distributors
            ->findWhere(['initials' => $data['client']['account']['distributor_initials']], 'id')
            ->first();
        $data['client']['account']['energy_distributor_id'] = $distributor->id;
        $account = $client->electricAccounts()->create($data['client']['account']);

        if ($data['client']['account']['address']) {
            $account['address'] = $account->address()->create($data['client']['account']['address']);
        }

        $this->responseOK['data'] = [
            'user' => $user,
            'client' => $client,
            'account' => $account,
        ];

        return $this->responseOK;
    }
}
