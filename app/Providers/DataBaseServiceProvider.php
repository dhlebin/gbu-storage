<?php namespace App\Providers;
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 22.06.2016
 * Time: 9:32
 */

use Illuminate\Support\ServiceProvider;

class DataBaseServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind(
            'App\Contracts\Repositories\ItemGroupAttributeRepository',
            'App\Repositories\DataBaseItemGroupAttributeRepository'
        );
    }

}