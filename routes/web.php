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
  //return view('welcome');
  return redirect()->action('UserController@profile');
});

//用户管理
  Route::get('login', [
    'uses' => 'UserController@login',
    'as' => 'login'
  ]);
  Route::group(['prefix' => 'User'], function () {
    Route::get('login', 'UserController@login');
    Route::post('login', 'UserController@doLogin')
      ->name('doLogin'); //本路由命名'doLogin'被用于login视图
    Route::get('logout', 'UserController@logout');
    Route::get('profile', 'UserController@profile')->name('profile');
    Route::post('changePassword', 'UserController@changePassword')
      ->name('changePassword'); 
    Route::get('{id}/edit', 'UserController@edit');
    Route::put('{id}', 'UserController@update')
      ->where('id', '[0-9]+');  //需要做路由参数约束,否则会截获下面的selfedit
    Route::get('selfedit', 'UserController@selfEdit');
    Route::put('selfedit', 'UserController@selfUpdate'); 
    Route::get('all', 'UserController@all');
    Route::get('editor', 'UserController@editor');
    Route::get('auditor', 'UserController@auditor');
    Route::get('adManager', 'UserController@adManager');
    Route::get('adClient', 'UserController@adClient');
    Route::get('systemManager', 'UserController@systemManager');
    Route::get('adjustType/{id}', 'UserController@adjustType')->name('User.adjustType');
    Route::put('modifyType/{id}', 'UserController@modifyType')->name('User.modifyType'); 
    // Route::get('adjustADClientType/{id}', 'UserController@adjustADClientType')->name('User.adjustADClientType');
    // Route::put('modifyADClientType/{id}', 'UserController@modifyADClientType')->name('User.modifyADClientType'); 
      
    Route::resource('/', 'UserController');
  });

//电视节目管理
  Route::resource('TvPrograme', 'TvProgrameController');

//电台节目管理
  Route::resource('RadioPrograme', 'RadioProgrameController');

//论坛管理
  // Route::post('Forum/destroyReply?{threadReplyid}', [ 
  //   'use' => 'ForumThreadMainController@destroyReply',
  //   'as' => 'Forum.destroyReply']);
  Route::delete('Forum/destroyReply/{threadReplyid}', 'ForumThreadMainController@destroyReply')->name('Forum.destroyReply');
  Route::get('Forum/unchecked', 'ForumThreadMainController@unchecked')->name('Forum.unchecked');
  Route::get('Forum/checkMain/{id}', 'ForumThreadMainController@checkMain')->name('Forum.checkMain');       
  Route::get('Forum/checkReply/{id}', 'ForumThreadMainController@checkReply')->name('Forum.checkReply');    
  Route::resource('Forum', 'ForumThreadMainController');

//广告图片管理
  Route::resource('AdSetting', 'AdSettingController');