<?php

namespace App\Presenters;

use App\Transformers\SegmentsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SegmentsPresenter.
 *
 * @package namespace App\Presenters;
 */
class SegmentsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SegmentsTransformer();
    }
}
