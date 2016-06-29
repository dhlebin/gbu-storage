<?php

namespace App\Providers;

use App\Contracts\Repositories\DepotItemsRepository;
use App\Contracts\Repositories\DepotsRepository;
use App\Contracts\Repositories\DepotItemTransactionsRepository;
use App\Contracts\Repositories\ItemAttributesRepository;
use App\Contracts\Repositories\DepotItemOperationsRepository;
use App\Contracts\Repositories\ItemsRepository;
use App\Contracts\Repositories\UnitsRepository;
use App\Contracts\Repositories\ItemGroupsRepository;
use App\Repositories\DbDepotItemsRepository;
use App\Repositories\DbDepotsRepository;
use App\Repositories\DbItemAttributesRepository;
use App\Repositories\DbDepotItemOperationsRepository;
use App\Repositories\DbDepotItemTransactionRepository;
use App\Repositories\DbItemGroupsRepository;
use App\Repositories\DbItemsRepository;
use App\Repositories\DbUnitsRepository;
use App\Services\ExtendedValidator;
use Illuminate\Support\Facades\Validator;
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
        Validator::resolver(function($translator, $data, $rules, $messages) {
            return new ExtendedValidator($translator, $data, $rules, $messages);
        });
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
            ItemsRepository::class,
            DbItemsRepository::class
        );
        $this->app->bind(
            ItemGroupsRepository::class,
            DbItemGroupsRepository::class
        );
        $this->app->bind(
            DepotItemTransactionsRepository::class,
            DbDepotItemTransactionRepository::class
        );
        $this->app->bind(
            DepotItemOperationsRepository::class,
            DbDepotItemOperationsRepository::class
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
