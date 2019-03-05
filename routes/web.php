<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/**
 * Main routes
 */
Route::get('/', 'HomeController@home');
Route::get('/cookbook', 'Apps\Cookbook\RecipeController@cookbook');
Route::get('/about', 'PagesController@about');

/**
 * Authentication routes
 */
Auth::routes();

/**
 * Login/Logout routes
 */
// Show login form
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// Login
Route::post('/login', 'Auth\LoginController@login');
// Logout
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

/**
 * Registration routes
 */
// Show registration form
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Registration
Route::post('/register', 'Auth\RegisterController@register');
// Email verification
//Route::post('/verify', 'Auth\RegisterController@verify');

/**
 * Password reset routes
 */
// Send password reset link to user email
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Link to password reset (can be sent by email)
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Show password reset form
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Password reset
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

/**
 * Cookbook routes
 */
// Check logged user
Route::group(['middleware' => ['auth']], function () {
    // Show new recipe
    Route::get('cookbook/new-recipe', 'Apps\Cookbook\RecipeController@create');
    // Save new recipe
    Route::post('cookbook/new-recipe', 'Apps\Cookbook\RecipeController@store');
    // Edit recipe
    Route::get('cookbook/edit/{slug}', 'Apps\Cookbook\RecipeController@edit');
    // Update recipe
    Route::post('cookbook/update', 'Apps\Cookbook\RecipeController@update');
    // Delete recipe
    Route::get('cookbook/delete/{id}', 'Apps\Cookbook\RecipeController@destroy');
    // Show all user recipe
    Route::get('cookbook/all-recipes', 'UserController@userRecipesAll');
    // Show user private recipe
    Route::get('cookbook/my-private-recipes', 'UserController@userPrivateRecipes');
    // Add comment
    Route::post('cookbook/comment/add', 'Apps\Cookbook\CommentController@store');
    // Delete comment
    Route::post('cookbook/comment/delete/{id}', 'Apps\Cookbook\CommentController@distroy');
    // Author profiles
    Route::get('user/{id}', 'UserController@profile')->where('id', '[0-9]+');
});

Route::group(['middleware' => ['guest']], function () {
    // Author profiles
    Route::get('user/{id}', 'UserController@userRecipes')->where('id', '[0-9]+');
});

/**
 * Cookbook routes for not auth users
 */
// Show posts list
Route::get('user/{id}/recipes', 'UserController@userRecipes')->where('id', '[0-9]+');
// Show one post
Route::get('/{slug}', ['as' => 'recipe', 'uses' => 'Apps\Cookbook\RecipeController@show'])
    ->where('slug', '[A-Za-z0-9-_]+');
