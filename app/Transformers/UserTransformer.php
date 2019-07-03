<?php

namespace ApiDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use ApiDelivery\Models\User;

/**
 * Class UserTransformer.
 *
 * @package namespace ApiDelivery\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Transform the User entity.
     *
     * @param \ApiDelivery\Models\User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,

            'name' => $model->name,
            'email' => $model->email,
            'role' => $model->role == 1 ? 'Administrador' : 'Usuário',
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
