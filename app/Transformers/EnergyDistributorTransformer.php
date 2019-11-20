<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\EnergyDistributor;

/**
 * Class EnergyDistributorTransformer.
 *
 * @package namespace App\Transformers;
 */
class EnergyDistributorTransformer extends TransformerAbstract
{
    /**
     * Transform the EnergyDistributor entity.
     *
     * @param \App\Entities\EnergyDistributor $model
     *
     * @return array
     */
    public function transform(EnergyDistributor $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
