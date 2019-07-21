<?php

namespace ApiDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use ApiDelivery\Models\Order;

/**
 * Class OrderTransformer.
 *
 * @package namespace ApiDelivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    /**
     * Transform the Order entity.
     *
     * @param \ApiDelivery\Models\Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
