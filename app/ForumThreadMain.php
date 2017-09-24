<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\ForumBoard;
use App\User;

class ForumThreadMain extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

  protected $guarded = [];

  public function forumBoard(){
    return $this->belongsTo('App\ForumBoard','forumBoardId','id');
  }

  public static function fromForumBoardName(string $name){
    return ForumBoard::where('name',$name)->first()->forumThreadMains()->get();
  }

  public function forumThreadReplies(){
    return $this->hasMany('App\ForumThreadReply','forumThreadId');
  }

  public function author(){
    return $this->belongsTo('App\User','authorId','id');
  }

  public function dto(){
    $user = User::find($this->authorId);
    return [
      "id"=> $this->id,
      "guid" => $this->guid,
      "name" => $this->name,
      "content" => $this->content,
      "images" => [],
      "date" => $this->created_at->toDateString(),
      "guid" => $this->guid,
      "authorId" => $user->id,
      "authorName" => $user->name,
      "avatar" => $user->avatar,
      "replies" => $this->forumThreadReplies()
        ->where('isPublished', 1)->get()->map(function ($item) {
          return $item->dto();
      }),
    ];
  }

  protected static function boot() {
    parent::boot();

    static::deleting(function(ForumThreadMain $main) {
        $main->forumThreadReplies()->delete();
    });
  }  
}
