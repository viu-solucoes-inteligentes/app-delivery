<?php

namespace ApiDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use ApiDelivery\Models\Client;

/**
 * Class ClientTransformer.
 *
 * @package namespace ApiDelivery\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{
    /**
     * Transform the Client entity.
     *
     * @param \ApiDelivery\Models\Client $model
     *
     * @return array
     */
    public function transform(Client $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
