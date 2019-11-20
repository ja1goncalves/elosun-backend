<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ElectricStation;

/**
 * Class ElectricStationTransformer.
 *
 * @package namespace App\Transformers;
 */
class ElectricStationTransformer extends TransformerAbstract
{
    /**
     * Transform the ElectricStation entity.
     *
     * @param \App\Entities\ElectricStation $model
     *
     * @return array
     */
    public function transform(ElectricStation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
