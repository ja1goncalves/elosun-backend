<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\BankAccounts;

/**
 * Class BankAccountsTransformer.
 *
 * @package namespace App\Transformers;
 */
class BankAccountsTransformer extends TransformerAbstract
{
    /**
     * Transform the BankAccounts entity.
     *
     * @param \App\Entities\BankAccounts $model
     *
     * @return array
     */
    public function transform(BankAccounts $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
