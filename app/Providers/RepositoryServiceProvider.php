<?php

namespace ApiDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\ApiDelivery\Repositories\UserRepository::class, \ApiDelivery\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\ApiDelivery\Repositories\CategoryRepository::class, \ApiDelivery\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\ApiDelivery\Repositories\ProductRepository::class, \ApiDelivery\Repositories\ProductRepositoryEloquent::class);
        $this->app->bind(\ApiDelivery\Repositories\ClientRepository::class, \ApiDelivery\Repositories\ClientRepositoryEloquent::class);
        //:end-bindings:
    }
}
