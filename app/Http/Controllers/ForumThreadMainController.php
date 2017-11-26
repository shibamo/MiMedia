<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ForumBoard;
use App\ForumThreadMain;
use App\ForumThreadReply;

class ForumThreadMainController extends Controller
{
  public function index(Request $request)
  {
    $boards = ForumBoard::all();

    return view('forum-thread-main.index',[
      'viewBag' => $this->viewBag,
      'boards' => $boards,
      'activeBoardId' => $request['id'] ?: 1,
      'currentFunction' => 'Forum',
    ]);
  }

  public function show($id)
  {
    $item = ForumThreadMain::find($id)->dto();
    return view('forum-thread-main.show',[
      'viewBag' => $this->viewBag,
      'main'=>$item,
      'board'=>ForumThreadMain::find($id)->forumBoard, 
      'currentFunction' => 'Forum',
      'replies' => $item['replies'],
    ]);
  }

  public function webview($id)
  {
    $item = ForumThreadMain::find($id)->dto();
    return view('forum-thread-main.webview',[
      'viewBag' => $this->viewBag,
      'main'=>$item,
      'board'=>ForumThreadMain::find($id)->forumBoard, 
      'currentFunction' => 'Forum',
      'replies' => $item['replies'],
    ]);
  }

  public function create()
  {
      //
  }

  public function store(Request $request)
  {
      //
  }
  public function edit($id)
  {
      //
  }


  public function update(Request $request, $id)
  {
      //
  }

  public function checkMain(Request $request, $id)
  {
    $item = ForumThreadMain::find($id);
    $item->isChecked = true;
    $item->isPublished = true;
    $item->save();

    return redirect()->back();
  }

  public function checkReply(Request $request, $id)
  {
    $item = ForumThreadReply::find($id);
    $item->isChecked = true;
    $item->isPublished = true;
    $item->save();

    return redirect()->back();
  }

  public function unchecked(Request $request)
  {
    $uncheckedThreadMains = ForumThreadMain::where('isChecked', 0)->get();
    $uncheckedThreadReplies = ForumThreadReply::where('isChecked', 0)->get();
    return view('forum-thread-main.unchecked',[
      'viewBag' => $this->viewBag,
      'currentFunction' => 'Forum.Check',
      'uncheckedMains'=>$uncheckedThreadMains,
      'uncheckedReplies'=>$uncheckedThreadReplies,
    ]);
  }

  public function destroy($threadMainid)
  {
    ForumThreadMain::destroy($threadMainid);
    return redirect()->back();
  }

  public function destroyReply($threadReplyid)
  {
    // $threadMainid = ForumThreadReply::find($threadReplyid)->forumThreadId;
    ForumThreadReply::destroy($threadReplyid);
    return redirect()->back();
  }  
}
