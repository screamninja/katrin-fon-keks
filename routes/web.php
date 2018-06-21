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

use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@home');



Route::get('/test', function () {
    return view('apps.test.test', ['name' => 'Developer']);
});

Route::get('/mycalc','MyCalcController@index');

