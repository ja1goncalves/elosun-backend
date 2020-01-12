<?php

namespace App\Presenters;

use App\Transformers\BankAccountsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BankAccountsPresenter.
 *
 * @package namespace App\Presenters;
 */
class BankAccountsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BankAccountsTransformer();
    }
}
