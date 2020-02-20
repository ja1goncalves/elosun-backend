<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ClientRepository;
use App\Entities\Client;
use App\Validators\ClientValidator;

/**
 * Class ClientRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Client::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ClientValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function bestByOrders($limit)
    {
        return $this->model->newQuery()
            ->limit($limit)
            ->with('orders')
            ->selectRaw('name, email, cpf_cnpj, SUM(orders.end_watts) as watts, COUNT(orders) as total_orders')
            ->orderByRaw('SUM(orders.end_watts)');
    }
    

}
