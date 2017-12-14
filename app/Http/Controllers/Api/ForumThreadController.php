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

class ForumThreadController extends ApiController
{
  public function index(int $forumBoardId, int $page = 1)
  {
    $grouped = ForumBoard::find($forumBoardId)->forumThreadMains()
    ->where('isPublished', 1)->orderBy('created_at', 'desc')
    ->skip($this->recordCountPerPage * ($page-1)) // 跳过本页以前的数据集
    ->take($this->recordCountPerPage) // 取当前页的数据集
    ->get()->map(
        function($item){
          return $item->dto();
      });

    return response()->json($grouped->toArray(), 
      Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }

  public function postNewThread(Request $request)
  {
    $user = JWTAuth::parseToken()->authenticate();
    $thread = $request->only('forumBoardId', 'name','content');
    $sections = $request->input('sections');
    $thread['content'] = $thread['content'] . 
      $this->generateImageSectionContent($sections);
    $thread['guid'] = UUID::generate()->string;
    $thread['authorId'] = $user->id;
    $thread['isChecked'] = true;
    $thread['isPublished'] = true;

    return response()->json(ForumThreadMain::create($thread), 
      Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);    
  }

  private function generateImageSectionContent(array $sections){
    return collect($sections)->reduce(
      function ($carry, $section) {
        return $carry . 
          ($section['beforeContent']? '<p>' . $section['beforeContent'] . '</p>' : '') . 
          ("<img src='" . $section['imageFileLink'] . "'>") . 
          ($section['afterContent']? '<p>' . $section['afterContent'] . '</p>' : '') ;
      }, ''
    );
  }

  public function replyThread(Request $request)
  {
    $user = JWTAuth::parseToken()->authenticate();
    $thread = $request->only('forumThreadId', 'content');
    $thread['forumBoardId'] = ForumThreadMain::find($request->forumThreadId)->id;
    $thread['guid'] = UUID::generate()->string;
    $thread['authorId'] = $user->id;
    $thread['isChecked'] = true;
    $thread['isPublished'] = true;

    return response()->json(ForumThreadReply::create($thread),
      Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }

  public function boards(){
    return response()->json(ForumBoard::all(),
    Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }
}