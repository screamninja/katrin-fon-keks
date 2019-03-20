<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/**
 * Main routes
 *
 * 1) Home page (GET);
 * 2) Cookbook page (GET);
 * 3) About page (GET).
 */
Route::get('/', 'HomeController@home');
Route::get('/cookbook', 'RecipeController@cookbook');
Route::get('/about', 'PagesController@about');

/**
 * Authentication routes
 */
Auth::routes();

/**
 * Login/Logout routes
 *
 * 1) Show login form (GET);
 * 2) Login (POST);
 * 3) Logout (GET),
 */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

/**
 * Registration routes
 *
 * 1) Show registration form (GET);
 * 2) Registration (POST);
 * 3) Email verification (POST).
 */
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/verify', 'Auth\RegisterController@verify');

/**
 * Password reset routes
 *
 * 1) Send password reset link to user email (POST);
 * 2) Link to password reset (can be sent by email) (GET);
 * 3) Show password reset form (GET);
 * 4) Password reset (POST)/
 */
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

/**
 * Cookbook routes for guests
 *
 * 1) Show recipes list (GET);
 * 2) Show one recipe (GET).
 */
Route::get('user/{id}/recipes', 'UserController@userRecipes')->where('id', '[0-9]+');
Route::get('/{slug}', ['as' => 'recipe', 'uses' => 'RecipeController@show'])
    ->where('slug', '[A-Za-z0-9-_]+');

/**
 * Cookbook routes (with Auth middleware)
 *
 * 1) Show form for new recipe (GET);
 * 2) Save new recipe (POST);
 * 3) Edit recipe form (GET);
 * 4) Update recipe (POST);
 * 5) Delete recipe (GET);
 * 6) Show all user recipe (GET);
 * 7) Show user private recipe (GET);
 * 8) Add comment (POST);
 * 9) Delete comment (POST);
 * 10) Show user profile (GET).
 */
Route::group(['middleware' => ['auth']], function () {
    Route::get('cookbook/new-recipe', 'RecipeController@create');
    Route::post('cookbook/new-recipe', 'RecipeController@store');
    Route::get('cookbook/edit/{slug}', 'RecipeController@edit');
    Route::post('cookbook/update', 'RecipeController@update');
    Route::get('cookbook/delete/{id}', 'RecipeController@destroy');
    Route::get('cookbook/all-recipes', 'UserController@userRecipesAll');
    Route::get('cookbook/my-private-recipes', 'UserController@userPrivateRecipes');
    Route::post('cookbook/comment/add', 'CommentController@store');
    Route::post('cookbook/comment/delete/{id}', 'CommentController@distroy');
    Route::get('user/{id}', 'UserController@profile')->where('id', '[0-9]+');
});
