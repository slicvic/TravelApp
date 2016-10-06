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

// Ajax
Route::group(['namespace' => 'Ajax'], function() {
    Route::get('/ajax/autosuggest/regions', 'AutoSuggestController@regions');
});

// Hotels
Route::get('/hotels', 'HotelsController@index')->name('hotels.home');
Route::get('/hotels/search', 'HotelsController@search')->name('hotels.search');

// Home
Route::get('/', 'HomeController@index')->name('home');
