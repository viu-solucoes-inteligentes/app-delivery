<?php

namespace ApiDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use ApiDelivery\Models\Category;

/**
 * Class CategoryTransformer.
 *
 * @package namespace ApiDelivery\Transformers;
 */
class CategoryTransformer extends TransformerAbstract
{
    /**
     * Transform the Category entity.
     *
     * @param \ApiDelivery\Models\Category $model
     *
     * @return array
     */
    public function transform(Category $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
