<?php

$api = app('api.router');

$api->version('v1', function (Dingo\Api\Routing\Router $api) {
    $api->group(
        [
            'namespace' => 'App\Http\Api\Controllers',
            'prefix'    => 'v1'
        ],
        function (Dingo\Api\Routing\Router $api) {
            $api->resource('itemgroups', 'ItemGroupsController');
            $api->resource('items', 'ItemsController');
            $api->resource('item_attributes', 'ItemAttributesController');
            $api->get('itemgroups/{id}/parent', 'ItemgroupsController@parent');
            $api->get('itemgroups/{id}/children', 'ItemgroupsController@children');
            $api->get('itemgroups/{id}/ancestors', 'ItemgroupsController@ancestors');
        }
    );
});
