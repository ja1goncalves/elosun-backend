<?php

namespace App\Presenters;

use App\Transformers\ElectricAccountTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ElectricAccountPresenter.
 *
 * @package namespace App\Presenters;
 */
class ElectricAccountPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ElectricAccountTransformer();
    }
}
