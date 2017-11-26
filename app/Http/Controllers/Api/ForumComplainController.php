<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;

use UUID;
use JWTAuth;

use App\ForumBoard;
use App\ForumThreadMain;
use App\ForumThreadReply;
use App\ForumThreadMainComplain;
use App\ForumThreadReplyComplain;

class ForumComplainController extends ApiController
{
  public function complainThread(Request $request)
  {
    $user = JWTAuth::parseToken()->authenticate();

    $complain = $request->only('forumThreadId', 'forumBoardId','complainContent');
    $complain['complainerId'] = $user->id;
    $complain['isProcessed'] = false;

    return response()->json(ForumThreadMainComplain::create($complain), 
      Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }

  public function complainReply(Request $request)
  {
    $user = JWTAuth::parseToken()->authenticate();
    
    $complain = $request->only('forumThreadReplyId', 'forumBoardId', 'complainContent');
    $complain['complainerId'] = $user->id;
    $complain['isProcessed'] = false;

    return response()->json(ForumThreadReplyComplain::create($complain),
      Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }
}