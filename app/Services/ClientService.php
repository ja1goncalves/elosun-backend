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
     * @param ElectricAccountRepository $electricAccountRepository
     * @param EnergyDistributorRepository $energyDistributor
     * @param BankAccountsRepository $bankAccounts
     */
    public function __construct(ClientRepository $repository,  ElectricAccountRepository $electricAccountRepository,
                                EnergyDistributorRepository $energyDistributor, BankAccountsRepository $bankAccounts)
    {
        $this->repository = $repository;
        $this->accounts = $electricAccountRepository;
        $this->distributors = $energyDistributor;
        $this->bankAccounts = $bankAccounts;
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
}
