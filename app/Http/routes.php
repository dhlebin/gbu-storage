<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api) {
    $api->group(
        [
            'namespace' => 'App\Api\Controllers',
            'prefix' => 'v1'
        ],
        function ($api) {
            $api->resource('itemgroups', 'ItemGroupsController');
            $api->resource('items', 'ItemsController');
        }
    );
});
