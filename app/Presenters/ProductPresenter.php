<?php

namespace ApiDelivery\Presenters;

use ApiDelivery\Transformers\ProductTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProductPresenter.
 *
 * @package namespace ApiDelivery\Presenters;
 */
class ProductPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProductTransformer();
    }
}
