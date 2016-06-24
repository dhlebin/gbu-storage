<?php

namespace App\Providers;

use App\Contracts\Repositories\ItemAttributesRepository;
use App\Repositories\DbItemAttributesRepository;
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
    }
}
