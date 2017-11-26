<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ForumBoard;
use App\ForumThreadMain;
use App\ForumThreadReply;
use App\ForumThreadMainComplain;
use App\ForumThreadReplyComplain;

class ForumThreadComplainController extends Controller
{
  public function unProcessed(Request $request)
  {
    $needRefresh = false;
    $mainComplains = ForumThreadMainComplain::where('isProcessed', 0)->get();
    foreach ($mainComplains as &$complain) {
      if(!isset($complain->forumThreadMain))
      {
        $needRefresh = $this->synchronizeComplainWithMain($complain);
      }
    }
    if($needRefresh){
      $mainComplains = ForumThreadMainComplain::where('isProcessed', 0)->get();
    }

    $needRefresh = false;
    $replyComplains = ForumThreadReplyComplain::where('isProcessed', 0)->get();
    foreach ($replyComplains as &$complain) {
      if(!isset($complain->forumThreadReply))
      {
        $needRefresh = $this->synchronizeComplainWithReply($complain);
      }
    }
    if($needRefresh){
      $replyComplains = ForumThreadReplyComplain::where('isProcessed', 0)->get();
    }

    return view('forum-thread-complain.unProcessed',[
      'viewBag' => $this->viewBag,
      'mainComplains' => $mainComplains,
      'replyComplains' => $replyComplains,
      'currentFunction' => 'Forum.Complain',
    ]);
  }
  
  public function showMain($id)
  {
    $item = ForumThreadMainComplain::find($id);
    if($this->synchronizeComplainWithMain($item)){
      return $this->jumpToUnProcessedList();
    }
    return view('forum-thread-complain.showMain',[
      'viewBag' => $this->viewBag,
      'item' => $item,
      'currentFunction' => 'Forum.Complain',
    ]);
  }

  public function processMain(Request $request, $id)
  {
    $item = ForumThreadMainComplain::find($id);

    $item->memo = $request['memo'];
    $item->isProcessed = true;
    $item->supervisorId = $this->viewBag['currentUser']->id;
    $item->save();

    ForumThreadMain::destroy($item->forumThreadMain->id);

    return $this->jumpToUnProcessedList();
  }

  public function showReply($id)
  {
    $item = ForumThreadReplyComplain::find($id);
    if($this->synchronizeComplainWithReply($item)){
      return $this->jumpToUnProcessedList();
    }
    return view('forum-thread-complain.showReply',[
      'viewBag' => $this->viewBag,
      'item' => $item,
      'currentFunction' => 'Forum.Complain',
    ]);
  }

  public function processReply(Request $request, $id)
  {
    $item = ForumThreadReplyComplain::find($id);

    $item->memo = $request['memo'];
    $item->isProcessed = true;
    $item->supervisorId = $this->viewBag['currentUser']->id;
    $item->save();

    ForumThreadReply::destroy($item->forumThreadReply->id);

    return $this->jumpToUnProcessedList();
  }

  /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
  public function index(Request $request)
  {
    $mainComplains = ForumThreadMainComplain::all();
    $replyComplains = ForumThreadReplyComplain::all();

    return view('forum-thread-complain.index',[
      'viewBag' => $this->viewBag,
      'mainComplains' => $mainComplains,
      'replyComplains' => $replyComplains,
      'currentFunction' => 'Forum.Complain',
    ]);
  }

  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function store(Request $request)
  {
      //
  }

  /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function show($id)
  {
      //
  }

  /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function edit($id)
  {
      //
  }

  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, $id)
  {
      //
  }

  public function destroyMain(Request $request, $id)
  {
    $item = ForumThreadMainComplain::find($id);
    $item->isProcessed = true;
    $item->memo = $request['memo'];
    $item->supervisorId = $this->viewBag['currentUser']->id;      
    $item->save();

    ForumThreadMainComplain::destroy($id);

    return $this->jumpToUnProcessedList();
  }

  public function destroyReply(Request $request, $id)
  {
    $item = ForumThreadReplyComplain::find($id);
    $item->isProcessed = true;
    $item->memo = $request['memo'];
    $item->supervisorId = $this->viewBag['currentUser']->id;       
    $item->save();

    ForumThreadReplyComplain::destroy($id);

    return $this->jumpToUnProcessedList();
  }

  /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function destroy($id)
  {
      //
  }

  private function synchronizeComplainWithMain(&$complain)
  {
    if(!isset($complain->forumThreadMain))
    {
      $complain->memo = "原帖已被删除";
      $complain->save();
      ForumThreadMainComplain::destroy($complain->id);
      return true;
    }
    return false;
  }

  private function synchronizeComplainWithReply(&$complain)
  {
    if(!isset($complain->forumThreadReply))
    {
      $complain->memo = "原帖已被删除";
      $complain->save();        
      ForumThreadReplyComplain::destroy($complain->id);
      return true;
    }
    return false;
  }

  private function jumpToUnProcessedList(){
    return redirect()->action('ForumThreadComplainController@unProcessed');
  }    
}
