<?php

namespace App\Providers;

use App\Contracts\Repositories\DepotItemTransactionsRepository;
use App\Contracts\Repositories\ItemAttributesRepository;
use App\Contracts\Repositories\UnitsRepository;
use App\Repositories\DbDepotItemTransactionRepository;
use App\Repositories\DbItemAttributesRepository;
use App\Repositories\DbUnitsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ItemAttributesRepository::class,
            DbItemAttributesRepository::class
        );
        $this->app->bind(
            UnitsRepository::class,
            DbUnitsRepository::class
        );
        $this->app->bind(
            'App\Contracts\Repositories\ItemsRepository',
            'App\Repositories\DbItemsRepository'
        );
        $this->app->bind(
            'App\Contracts\Repositories\ItemGroupsRepository',
            'App\Repositories\DbItemGroupsRepository'
        );
        $this->app->bind(
            DepotItemTransactionsRepository::class,
            DbDepotItemTransactionRepository::class
        );
    }
}
