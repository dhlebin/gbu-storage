<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
$api = app('Dingo\Api\Routing\Router');

Route::get('/', function () {
    return view('welcome');
});

$api->version('v1', function($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->get('item_group_attribute/get_list', 'ItemGroupAttributeController@index');
        $api->get('item_group_attribute/get_by_id', 'ItemGroupAttributeController@getById');
        $api->post('item_group_attribute/store', 'ItemGroupAttributeController@store');
        $api->post('item_group_attribute/update', 'ItemGroupAttributeController@update');
        $api->delete('item_group_attribute/remove', 'ItemGroupAttributeController@remove');
    });
});
