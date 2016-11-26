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

  Route::get('/', 'HomeController@index')->name('index')->middleware('guest');

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
  Route::get('admin/dashboard', 'Admin\AdminController@index')->name('admin.index');
  /* admin/user */
  Route::resource('admin/user', 'Admin\UserManagementController',['as'=>'admin']);
  Route::get('admin/user/ban/{id}','Admin\UserManagementController@banUser')->name('admin.user.ban');
  /*  member */
  Route::get('home', 'User\UserController@index')->name('user.index'); //News Feed
  Route::get('/{id}','User\UserController@see')->name('user.see');
  Route::get('/{id}/edit','User\UserController@edit')->name('user.edit');
  Route::get('{id}/subscribe','User\UserController@subscribeTo')->name('user.sub');
  Route::put('{id}/update','User\UserController@update')->name('user.update');
  Route::put('{id}/avatar','User\UserController@updateAvatar')->name('user.update.avatar');
  Route::put('{id}/banner','User\UserController@updateBanner')->name('user.update.banner');
  /* Post and see and like and reply */
  Route::post('home', 'User\PostsController@addPost')->name('user.post');
  Route::get('post/{id}','User\PostsController@seePost')->name('user.seepost');
  Route::get('post/{id}/dislike','User\PostsController@dislike')->name('user.dislike');
  Route::get('post/{id}/like','User\PostsController@like')->name('user.like');
  Route::post('post/{id}/reply','User\PostsController@reply')->name('user.reply');
  /* Settings and stuff */
  Route::get('{id}/settings', 'User\SettingsController@getAccountSettings')->name('account.settings');
  Route::get('{id}/settings/privacy', 'User\SettingsController@getPrivacySettings')->name('account.privacy');
  Route::get('{id}/settings/change/password', 'User\SettingsController@getChangePass')->name('account.changepass');
  Route::put('{id}/settings', 'User\SettingsController@updateAccountSettings')->name('account.settings.update');
  Route::put('{id}/settings/privacy', 'User\SettingsController@updateAccountSettings')->name('account.privacy.update');
  Route::put('{id}/settings/change/password', 'User\SettingsController@updateChangePass')->name('account.changepass.update');
  Route::get('{id}/settings/deactivate', 'User\SettingsController@getDeactivateAccount')->name('account.deactivate');
  Route::put('{id}/settings/deactivate', 'User\SettingsController@deactivateAccount')->name('account.dead');
  /* JSON */
  Route::get('api/users', 'JSON\UserController@data');
  Route::post('api/login', 'JSON\UserController@login');
