<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\ApiDelivery\Models\User::class, 5)
            ->states('admin')
            ->create()
            ->each(function($user){
                $user->client()->save(factory(\ApiDelivery\Models\Client::class)
                    ->create(['user_id' => $user->id])); // Pra cada usuário, um novo cliente
            });

        factory(\ApiDelivery\Models\User::class, 50)
            ->states('client')
            ->create()
            ->each(function($user){
                $user->client()->save(factory(\ApiDelivery\Models\Client::class)
                    ->create(['user_id' => $user->id])); // Pra cada usuário, um novo cliente
            });


    }
}
