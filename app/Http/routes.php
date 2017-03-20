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

$app->get('/', function() {
    return view('index');
});

$app->get('address', ['uses' => 'App\Http\Controllers\AddressController@index']);
$app->get('search', ['uses' => 'App\Http\Controllers\AddressController@search']);
$app->delete('address/{id}', ['uses' => 'App\Http\Controllers\AddressController@destroy']);
$app->put('address/{id}', ['uses' => 'App\Http\Controllers\AddressController@update']);
$app->post('address', ['uses' => 'App\Http\Controllers\AddressController@store']);



