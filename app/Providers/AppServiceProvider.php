<?php

namespace App\Providers;

use App\Contracts\Repositories\DepotItemsRepository;
use App\Contracts\Repositories\DepotsRepository;
use App\Contracts\Repositories\ItemAttributesRepository;
use App\Repositories\DbDepotItemsRepository;
use App\Repositories\DbDepotsRepository;
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
            DepotsRepository::class,
            DbDepotsRepository::class
        );

        $this->app->bind(
            DepotItemsRepository::class,
            DbDepotItemsRepository::class
        );
        $this->app->bind(
            DepotItemOperationsRepository::class,
            DbDepotItemOperationsRepository::class
        );
    }
}
