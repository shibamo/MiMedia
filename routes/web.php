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

// https://laracasts.com/discuss/channels/laravel/how-i-can-force-all-my-routes-to-be-https-not-http?page=1
if (env('APP_ENV') === 'aws_production' || env('APP_ENV') === 'aws_test') {
  URL::forceScheme('https');
}

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
  //使用web页面查看电视节目(一般是微信导入)
  Route::get('TvPrograme/webview/{id}', 'TvProgrameController@webview')->name('TvPrograme.webview'); 

//电台节目管理
  Route::resource('RadioPrograme', 'RadioProgrameController');
  //使用web页面查看电台节目(一般是微信导入)
  Route::get('RadioPrograme/webview/{id}', 'RadioProgrameController@webview')->name('RadioPrograme.webview'); 

//论坛管理
  // Route::post('Forum/destroyReply?{threadReplyid}', [ 
  //   'use' => 'ForumThreadMainController@destroyReply',
  //   'as' => 'Forum.destroyReply']);
  Route::delete('Forum/destroyReply/{threadReplyid}', 'ForumThreadMainController@destroyReply')->name('Forum.destroyReply');
  Route::get('Forum/unchecked', 'ForumThreadMainController@unchecked')->name('Forum.unchecked');
  Route::get('Forum/checkMain/{id}', 'ForumThreadMainController@checkMain')->name('Forum.checkMain');       
  Route::get('Forum/checkReply/{id}', 'ForumThreadMainController@checkReply')->name('Forum.checkReply');    
  //使用web页面查看某个讨论线索(一般是微信导入)
  Route::get('Forum/webview/{id}', 'ForumThreadMainController@webview')->name('Forum.webview');
  Route::resource('Forum', 'ForumThreadMainController');

//论坛投诉管理
  //待处理列表
  Route::get('ForumComplain/unProcessed', 'ForumThreadComplainController@unProcessed')->name('ForumComplain.unProcessed');
  //删除
  Route::delete('ForumComplain/destroyMain/{complainId}', 'ForumThreadComplainController@destroyMain')->name('ForumComplain.destroyMain');
  Route::delete('ForumComplain/destroyReply/{complainId}', 'ForumThreadComplainController@destroyReply')->name('ForumComplain.destroyReply'); 
  //查看
  Route::get('ForumComplain/showMain/{id}', 'ForumThreadComplainController@showMain')->name('ForumComplain.showMain');       
  Route::get('ForumComplain/showReply/{id}', 'ForumThreadComplainController@showReply')->name('ForumComplain.showReply');
  //审查处理意见    
  Route::put('ForumComplain/processMain/{id}', 'ForumThreadComplainController@processMain')->name('ForumComplain.processMain');       
  Route::put('ForumComplain/processReply/{id}', 'ForumThreadComplainController@processReply')->name('ForumComplain.processReply');
  //其他操作 
  // Route::resource('ForumComplain', 'ForumThreadComplainController',['only' => ['index', 'update','destroy']]);

//广告图片管理
  Route::resource('AdSetting', 'AdSettingController');

//直播节目管理
Route::resource('LivePrograme', 'LiveProgrameController');
//使用web页面查看直播节目(一般是微信导入)
Route::get('LivePrograme/webview/{id}', 'LiveProgrameController@webview')->name('LivePrograme.webview'); 