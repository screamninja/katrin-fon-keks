<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/**
 * Main routes
 */
Route::get('/', 'HomeController@home');
Route::get('/blog', 'Apps\Blog\PostController@index');

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
 * Blog routes
 */
// Check logged user
Route::group(['middleware' => ['auth']], function () {
    // Show new post
    Route::get('blog/new-post', 'Apps\Blog\PostController@create');
    // Save new post
    Route::post('blog/new-post', 'Apps\Blog\PostController@store');
    // Edit post
    Route::get('blog/edit/{slug}', 'Apps\Blog\PostController@edit');
    // Update post
    Route::post('blog/update', 'Apps\Blog\PostController@update');
    // Delete post
    Route::get('blog/delete/{id}', 'Apps\Blog\PostController@destroy');
    // Show all user posts
    Route::get('blog/my-all-posts', 'Apps\Blog\UserController@userPostsAll');
    // Show user drafts
    Route::get('blog/my-drafts', 'Apps\Blog\UserController@userPostsDraft');
    // Add comment
    Route::post('blog/comment/add', 'Apps\Blog\CommentController@store');
    // Delete comment
    Route::post('blog/comment/delete/{id}', 'Apps\Blog\CommentController@distroy');
});

/**
 * User profile routes
 */
// Author profiles
Route::get('user/{id}', 'Apps\Blog\UserController@profile')->where('id', '[0-9]+');
// Show posts list
Route::get('user/{id}/posts', 'Apps\Blog\UserController@userPosts')->where('id', '[0-9]+');
// Show one post
Route::get('blog/{slug}', ['as' => 'post', 'uses' => 'Apps\Blog\PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
