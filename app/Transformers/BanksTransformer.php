<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Banks;

/**
 * Class BanksTransformer.
 *
 * @package namespace App\Transformers;
 */
class BanksTransformer extends TransformerAbstract
{
    /**
     * Transform the Banks entity.
     *
     * @param \App\Entities\Banks $model
     *
     * @return array
     */
    public function transform(Banks $model)
    {
        return [
            'id'    => (int) $model->id,
            'title' => $model->title,
            'code'  => $model->code
        ];
    }
}
