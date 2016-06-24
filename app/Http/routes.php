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
            $api->get('itemgroups/{id}/parent', 'ItemgroupsController@parent');
            $api->get('itemgroups/{id}/children', 'ItemgroupsController@children');
            $api->get('itemgroups/{id}/ancestors', 'ItemgroupsController@ancestors');

            $api->resource('items', 'ItemsController');
        }
    );
});
