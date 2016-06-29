<?php

Route::singularResourceParameters();

$api = app('api.router');

$api->version('v1', function (Dingo\Api\Routing\Router $api) {
    $api->group(
        [
            'namespace' => 'App\Http\Api\Controllers',
            'prefix'    => 'v1'
        ],
        function (Dingo\Api\Routing\Router $api) {
            $api->resource('items', 'ItemsController');
            $api->resource('item_attributes', 'ItemAttributesController');
            $api->get('itemgroups/{id}/parent', 'ItemGroupsController@parent');
            $api->get('itemgroups/{id}/children', 'ItemGroupsController@children');
            $api->get('itemgroups/{id}/ancestors', 'ItemGroupsController@ancestors');
            $api->resource('itemgroups', 'ItemGroupsController');
            $api->resource('units', 'UnitsController');
            $api->resource(
                'depot_item_operations',
                'DepotItemOperationsController',
                [
                    'except' => ['destroy']
                ]
            );
            $api->resource('depots', 'DepotsController');
            $api->resource('depot_items', 'DepotItemsController');
            $api->resource(
                'depot_item_operations',
                'DepotItemOperationsController',
                [
                    'except' => ['destroy']
                ]
            );
            $api->resource('depot_item_transactions', 'DepotItemTransactionsController');
        }
    );
});
