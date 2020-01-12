<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Segments;

/**
 * Class SegmentsTransformer.
 *
 * @package namespace App\Transformers;
 */
class SegmentsTransformer extends TransformerAbstract
{
    /**
     * Transform the Segments entity.
     *
     * @param \App\Entities\Segments $model
     *
     * @return array
     */
    public function transform(Segments $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
