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

Route::get('/', function () {
    return view('welcome');
})->name('index');

  /* register and login  */
  Route::group(['middleware' => 'guest'], function(){
    Route::get('login', 'AuthController@login')->name('auth.login');
    Route::post('login', 'AuthController@checkAccount')->name('auth.check');
    Route::get('signup', 'AuthController@register')->name('auth.signup');
    Route::post('signup', 'AuthController@submit')->name('auth.submit');
  });
  Route::get('/verify/{id}', 'AuthController@verifyAccount')->name('user.confirm');
  Route::get('logout', 'AuthController@logout')->name('auth.logout');
  /* admin */
  Route::get('admin/home', 'Admin\AdminController@index')->name('admin.index');
  /* admin/user */
  Route::resource('admin/user', 'Admin\UserManagementController',['as'=>'admin']);
  /*  member */
  Route::get('home', 'User\UserController@index')->name('user.index'); //News Feed
  Route::post('home', 'User\UserController@addPost')->name('user.post');
  Route::get('/{id}','User\UserController@see')->name('user.see');
  Route::get('/{id}/edit','User\UserController@edit')->name('user.edit');
  Route::get('{id}/subscribe','User\UserController@like')->name('user.sub');
  Route::get('post/{id}','User\UserController@seePost')->name('user.seepost');
  Route::post('post/{id}/reply','User\UserController@reply')->name('user.reply');
  Route::get('post/{id}/like','User\UserController@like')->name('user.like');
  Route::get('post/{id}/dislike','User\UserController@dislike')->name('user.dislike');
  Route::put('{id}/update','User\UserController@update')->name('user.update');
  Route::put('{id}/avatar','User\UserController@updateAvatar')->name('user.update.avatar');
  Route::put('{id}/banner','User\UserController@updateBanner')->name('user.update.banner');

  /* Settings and stuff */
  Route::get('{id}/settings', 'User\UserController@getAccountSettings')->name('account.settings');
  Route::get('{id}/settings/privacy', 'User\UserController@getAccountSettings')->name('account.privacy');
  Route::get('{id}/settings/change/password', 'User\UserController@getAccountSettings')->name('account.changepass');
