<?php

namespace ApiDelivery\Presenters;

use ApiDelivery\Transformers\OrderTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderPresenter.
 *
 * @package namespace ApiDelivery\Presenters;
 */
class OrderPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderTransformer();
    }
}
