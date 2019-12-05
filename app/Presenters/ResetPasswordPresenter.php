<?php

namespace App\Presenters;

use App\Transformers\ResetPasswordTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ResetPasswordPresenter.
 *
 * @package namespace App\Presenters;
 */
class ResetPasswordPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ResetPasswordTransformer();
    }
}
