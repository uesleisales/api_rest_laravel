<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('product')->group(function(){
        Route::get('/' , 'ProductController@index')->name('index_products'); // o name de cima com esse ira concatenar
        Route::get('/{id}' , 'ProductController@show')->name('single_products'); // o name de cima com esse ira concatenar
        Route::post('/' , 'ProductController@store')->name('store_products');
        Route::put('/{id}' , 'ProductController@update')->name('update_products');
        Route::delete('/{id}' , 'ProductController@delete')->name('delete_products');
    });
});
