<?php

use Illuminate\Support\Facades\Route;
use App\AppFunctions\SensorDataStore;

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
Route::get('/dashboard', function() {
    return view("welcome");
});

Auth::routes();
Route::get('HomeController@index', function() {
    SensorDataStore::store();
    return redirect('/');
});
Route::get('/', 'IndexController@index');
Route::get('/maps', 'IndexController@index')->name('map');
Route::get('lists', 'ListsController@index')->name('lists');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/push', 'PushController@store');
Route::get('/push', 'PushController@push')->name('push');
