<?php


namespace App\Services;


/**
 * Class AppService
 * @package App\Services
 * @method create(array $all)
 * @method find(int $id)
 * @method all($get)
 * @method update(array $all, $id)
 * @method restore($id)
 * @method delete($id)
 * @method forceDelete(int $id)
 * @method findWhere(array $data)
 */
class AppService
{
    protected $responseOK = [
        'data' => [],
        'error' => false,
        'message' => 'Everything OK!',
        'status' => 200
    ];

    protected $responseERROR = [
        'data' => [],
        'error' => true,
        'message' => 'Any error occurrence!',
        'status' => 500
    ];
}
