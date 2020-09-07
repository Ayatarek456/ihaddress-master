<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('website.ih');
});

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return view('website.ih');
});

Auth::routes();

Route::get('/search','Website\SearchController@index')->name('search');
Route::get('/get-country','Website\CountryController@get_country')->name('search');
Route::get('/get-address','Website\AddressController@get_address')->name('get_address');
Route::post('/search','Website\SearchController@search_ajax')->name('ajax.search');
Route::post('/set_address','Website\AddressController@store')->name('set_address');
Route::post('/upload_image','Website\AddressController@store_image')->name('upload_image');


Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('redirect');
Route::get('login/{provider}/callback','Auth\LoginController@handleProviderCallback')->name('callback');
