<?php

namespace App\Providers;

use App\Contracts\Repositories\ItemGroupAttributeRepository;
use App\Repositories\DataBaseItemGroupAttributeRepository;
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
            ItemGroupAttributeRepository::class,
            DataBaseItemGroupAttributeRepository::class
        );
    }
}
