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
use Illuminate\Support\Facades\Auth;

//Route::get('/', 'PagesController@home');

Route::get('/', 'PostController@index');
Route::get('/home', ['as' => 'home', 'uses' => 'PostController@index']);

Auth::routes();

//отображение формы аутентификации
Route::get('/auth/login', 'Auth\LoginController@showLoginForm')->name('login');
//POST запрос аутентификации на сайте
Route::post('/auth/login', 'Auth\LoginController@login');
//POST запрос на выход из системы (логаут)
Route::post('/auth/logout', 'Auth\LoginController@logout')->name('logout');

/**
 * Маршруты регистрации...
 */

//страница с формой Laravel регистрации пользователей
Route::get('/auth/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//POST запрос регистрации на сайте
Route::post('/auth/register', 'Auth\RegisterController@register');

/**
 * URL для сброса пароля...
 */

//POST запрос для отправки email письма пользователю для сброса пароля
Route::post('/auth/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//ссылка для сброса пароля (можно размещать в письме)
Route::get('/auth/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//страница с формой для сброса пароля
Route::get('/auth/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//POST запрос для сброса старого и установки нового пароля
Route::post('/auth/password/reset', 'Auth\ResetPasswordController@reset');

// Check logged user.
Route::group(['middleware' => ['auth']], function () {
    // Show new post.
    Route::get('new-post', 'PostController@create');
    // Save new post.
    Route::post('new-post', 'PostController@store');
    // Edit post.
    Route::get('edit/{slug}', 'PostController@edit');
    // Update post.
    Route::post('update', 'PostController@update');
    // Delete post.
    Route::get('delete/{id}', 'PostController@destroy');
    // Show all user posts.
    Route::get('my-all-posts', 'UserController@user_posts_all');
    // Show user drafts.
    Route::get('my-drafts', 'UserController@user_posts_draft');
    // Add comment.
    Route::post('comment/add', 'CommentController@store');
    // Delete comment.
    Route::post('comment/delete/{id}', 'CommentController@distroy');
});

// Users profiles.
Route::get('user/{id}', 'UserController@profile')->where('id', '[0-9]+');
// Show posts list.
Route::get('user/{id}/posts', 'UserController@user_posts')->where('id', '[0-9]+');
// Show one post.
Route::get('/{slug}', ['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
