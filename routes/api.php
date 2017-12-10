<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'jwt.auth'], function()
{//需要登录的部分, 主要是UGC和用户profile信息更改相关
  Route::post('forum-thread/postNewThread', [
    'uses' => 'Api\ForumThreadController@postNewThread',
    'as' => 'postNewThread'
  ]);    

  Route::post('forum-file/postNewImage', [
    'uses' => 'Api\ForumFileController@postNewImage',
    'as' => 'postNewForumImage'
  ]);

  Route::post('forum-thread/replyThread', [
    'uses' => 'Api\ForumThreadController@replyThread',
    'as' => 'replyThread'
  ]);

  Route::post('forum-thread/complainThread', [
    'uses' => 'Api\ForumComplainController@complainThread',
    'as' => 'complainThread'
  ]);

  Route::post('forum-thread/complainReply', [
    'uses' => 'Api\ForumComplainController@complainReply',
    'as' => 'complainReply'
  ]);  


  Route::post('user/setAvatar', [
    'uses' => 'Api\UserController@setAvatar',
    'as' => 'setAvatar'
  ]); 

  Route::post('user/changePassword', [
    'uses' => 'Api\UserController@changePassword',
    'as' => 'changePassword'
  ]);

});

#region 基本用户管理
  Route::post('user/login', [
    'uses' => 'Api\UserController@login',
    'as' => 'login'
  ]);

  Route::post('user/register', [
    'uses' => 'Api\UserController@register',
    'as' => 'register'
  ]);

  Route::post('user/getQuestionFromEmail', [
    'uses' => 'Api\UserController@getQuestionFromEmail',
    'as' => 'getQuestionFromEmail'
  ]);
  
  Route::post('user/resetPassword', [
    'uses' => 'Api\UserController@resetPassword',
    'as' => 'resetPassword'
  ]);
#endregion

#region 电视节目管理
  Route::get('tv-programe/channels', [
    'uses' => 'Api\TvProgrameController@channels',
    'as' => 'tv-channels'
  ]);

  Route::get('tv-programe/index', [
    'uses' => 'Api\TvProgrameController@index',
    'as' => 'tv-programes'
  ]);
#endregion

#region 电台节目管理
  Route::get('radio-programe/channels', [
    'uses' => 'Api\RadioProgrameController@channels',
    'as' => 'radio-channels'
  ]);

  Route::get('radio-programe/index', [
    'uses' => 'Api\RadioProgrameController@index',
    'as' => 'radio-programes'
  ]);
#endregion

#region 论坛管理
  Route::get('forum-thread/index/{forumBoardId}/{page?}', [
    'uses' => 'Api\ForumThreadController@index',
    'as' => 'forum-threads'
  ]);

  Route::get('forum-thread/boards', [
    'uses' => 'Api\ForumThreadController@boards',
    'as' => 'forum-boards'
  ]);
#endregion




#region 广告
  Route::get('ad-setting/index', [
    'uses' => 'Api\AdSettingController@index',
    'as' => 'ad-settings'
  ]);
#endregion

#region 资源定位
  Route::get('resource-location-setting/index', [
    'uses' => 'Api\ResourceLocationSettingController@index',
    'as' => 'resource-location-settings'
  ]);
#endregion

#region 用户操作访问收集,估计数据发生频繁,因此尽量缩短url
Route::post('cv/a', [
  'uses' => 'Api\ContentVisitController@add',
  'as' => 'addContentVisit'
]);
#endregion

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
