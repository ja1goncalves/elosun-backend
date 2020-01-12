<?php

namespace App\Presenters;

use App\Transformers\BanksTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BanksPresenter.
 *
 * @package namespace App\Presenters;
 */
class BanksPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BanksTransformer();
    }
}
