<?php

namespace App\Presenters;

use App\Transformers\ElectricStationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ElectricStationPresenter.
 *
 * @package namespace App\Presenters;
 */
class ElectricStationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ElectricStationTransformer();
    }
}
