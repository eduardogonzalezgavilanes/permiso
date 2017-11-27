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
    return view('welcome');
});
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
Route::resource('pais','PaisControl');
Route::post('pais/changeStatus', array('as' => 'changeStatus', 'uses' => 'PaisControl@changeStatus'));
Route::resource('provincias','ProvinciasControl');
Route::post('provincias/changeStatus', array('as' => 'changeStatus', 'uses' => 'ProvinciasControl@changeStatus'));
Route::resource('cantones','CantonesControl');
Route::post('cantones/changeStatus', array('as' => 'changeStatus', 'uses' => 'CantonesControl@changeStatus'));
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
