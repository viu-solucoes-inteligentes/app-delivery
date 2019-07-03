<?php

namespace ApiDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use ApiDelivery\Models\Product;

/**
 * Class ProductTransformer.
 *
 * @package namespace ApiDelivery\Transformers;
 */
class ProductTransformer extends TransformerAbstract
{
    /**
     * Transform the Product entity.
     *
     * @param \ApiDelivery\Models\Product $model
     *
     * @return array
     */
    public function transform(Product $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
