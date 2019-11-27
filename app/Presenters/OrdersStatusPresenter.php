<?php

namespace App\Presenters;

use App\Transformers\OrdersStatusTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrdersStatusPresenter.
 *
 * @package namespace App\Presenters;
 */
class OrdersStatusPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrdersStatusTransformer();
    }
}
