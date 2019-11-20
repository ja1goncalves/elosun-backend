<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ElectricAccount;

/**
 * Class ElectricAccountTransformer.
 *
 * @package namespace App\Transformers;
 */
class ElectricAccountTransformer extends TransformerAbstract
{
    /**
     * Transform the ElectricAccount entity.
     *
     * @param \App\Entities\ElectricAccount $model
     *
     * @return array
     */
    public function transform(ElectricAccount $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
