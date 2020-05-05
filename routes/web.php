<?php

use Illuminate\Support\Facades\Route;
use App\AppFunctions\SensorDataStore;
use App\AppFunctions\LangSwitcher;
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

Auth::routes(['register' => false]);
Route::get('/refresh', function() {
    SensorDataStore::store();
    return redirect('/');
});
Route::get('/', 'IndexController@index')->name('home');
Route::get('/charts', 'ChartsController@index')->name('charts');
Route::get('/maps', 'MapController@index')->name('map');
Route::get('/data', 'ListsController@index')->name('data');
Route::get('/data/download', 'ListsController@export')->middleware('throttle:5,1')->name('download');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('whatisaqi', function() {
    LangSwitcher::switch();
    return view('whatisaqi');
})->name('whatisaqi');
Route::get('/about', function() {
    LangSwitcher::switch();
    return view('about');
});
Route::post('/push', 'PushController@store');
Route::get('/push', 'PushController@push')->name('push');
Route::post('/lang', 'langController@switch')->name('lang');