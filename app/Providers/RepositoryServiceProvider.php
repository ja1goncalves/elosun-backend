<?php

namespace App\Providers;

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
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProviderRepository::class, \App\Repositories\ProviderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ClientRepository::class, \App\Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AddressRepository::class, \App\Repositories\AddressRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EnergyDistributorRepository::class, \App\Repositories\EnergyDistributorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ElectricAccountRepository::class, \App\Repositories\ElectricAccountRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EletricStationRepository::class, \App\Repositories\EletricStationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ElectricStationRepository::class, \App\Repositories\ElectricStationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrderRepository::class, \App\Repositories\OrderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrdersStatusRepository::class, \App\Repositories\OrdersStatusRepositoryEloquent::class);
        //:end-bindings:
    }
}
