<?php

namespace App\Providers;

use App\Contracts\Repositories\ItemAttributesRepository;
use App\Contracts\Repositories\DepotItemOperationsRepository;
use App\Repositories\DbItemAttributesRepository;
use App\Repositories\DbDepotItemOperationsRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\UnitsRepository;
use App\Repositories\DbUnitsRepository;

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
            DepotItemOperationsRepository::class,
            DbDepotItemOperationsRepository::class
        );
    }
}
