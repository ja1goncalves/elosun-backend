<?php

namespace App\Presenters;

use App\Transformers\EnergyDistributorTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EnergyDistributorPresenter.
 *
 * @package namespace App\Presenters;
 */
class EnergyDistributorPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EnergyDistributorTransformer();
    }
}
