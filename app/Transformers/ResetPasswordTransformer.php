<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ResetPassword;

/**
 * Class ResetPasswordTransformer.
 *
 * @package namespace App\Transformers;
 */
class ResetPasswordTransformer extends TransformerAbstract
{
    /**
     * Transform the ResetPassword entity.
     *
     * @param \App\Entities\ResetPassword $model
     *
     * @return array
     */
    public function transform(ResetPassword $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
