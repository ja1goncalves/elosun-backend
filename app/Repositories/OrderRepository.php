<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OrderRepository.
 *
 * @package namespace App\Repositories;
 */
interface OrderRepository extends RepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getOrderWithOrderlyAndAddress(int $id);
}
