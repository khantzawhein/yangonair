<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/', 'IndexController@index')->name('home');
Route::get('/charts', 'ChartsController@index')->name('charts');
Route::get('/maps', 'MapController@index')->name('map');
Route::get('/data', 'ListsController@index')->name('data');
Route::get('/data/download', 'ListsController@export')->middleware('throttle:5,1')->name('download');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('whatisaqi', 'WhatisAQIController@index')->name('whatisaqi');
Route::get('/about', function() {
    LangSwitcher::switch();
    return view('about');
});
Route::post('/push', 'PushController@store');
Route::post('/push/now', 'PushController@push')->name('push')->middleware('auth');
Route::post('/lang', 'langController@switch')->name('lang');
Route::post('/admin/fb-update', 'FacebookAQIPostController@post')->name('post')->middleware('auth');

Route::get('/admin', 'AdminController@index')->name('admin');
Route::post('/admin/refresh', 'AdminController@refresh')->name('refresh');
Route::resource('admin/fb-settings', 'FbSettingsController', ['parameters' => [
    'fb-settings' => 'template'
]]);
Route::post('admin/fb-settings/{template}/set-default', 'FbSettingsController@setDefault')->name('set-default-fb');