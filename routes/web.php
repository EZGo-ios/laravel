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

Route::get('/', ['as' => 'page.index', 'uses' => 'PagesController@index']);
Route::resource('animalPosts', 'AnimalPostsController', ['except' => ['show', 'edit', 'update', 'destroy']]);
Route::get('/animalPosts/show/{animal_id}/{location_id}', ['as' => 'animalPosts.show', 'uses' => 'AnimalPostsController@show']);
Route::get('/animalPosts/edit', ['as' => 'animalPosts.edit', 'uses' => 'AnimalPostsController@edit']);
Route::put('/animalPosts/update', ['as' => 'animalPosts.update', 'uses' => 'AnimalPostsController@update']);
Route::delete('/animalPosts/delete', ['as' => 'animalPosts.destroy', 'uses' => 'AnimalPostsController@destroy']);

Route::resource('questionPosts', 'QuestionPostsController', ['except' => ['show', 'edit', 'update']]);
Route::get('/questionPosts/show', ['as' => 'questionPosts.show', 'uses' => 'QuestionPostsController@show']);
Route::get('/questionPosts/edit', ['as' => 'questionPosts.edit', 'uses' => 'QuestionPostsController@edit']);
Route::put('/questionPosts/update', ['as' => 'questionPosts.update', 'uses' => 'QuestionPostsController@update']);

//login
Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Registration Routes
Route::get('auth/register', ['as' => 'register','uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('auth/register', ['as' => 'register.post','uses' => 'Auth\RegisterController@register']);

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');