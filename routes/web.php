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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test/test', ['name' => 'Developer']);
});

Route::get('/calc', function () {
    return view('calc/index');
});

Route::post('calc/result.php', function () {
    return view('calc/result');
});


Route::get('/katrin', function () {
    return view('katrin/index');
});

//


Route::get('mycalc','MyCalcController@index');