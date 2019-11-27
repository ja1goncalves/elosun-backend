<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OrdersStatus;

/**
 * Class OrdersStatusTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrdersStatusTransformer extends TransformerAbstract
{
    /**
     * Transform the OrdersStatus entity.
     *
     * @param \App\Entities\OrdersStatus $model
     *
     * @return array
     */
    public function transform(OrdersStatus $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
