<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class ForumThreadReply extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

  protected $guarded = [];

  public function forumThreadMain(){
    return $this->belongsTo('App\ForumThreadMain','forumThreadId','id');
  }

  public function author(){
    return $this->belongsTo('App\User','authorId','id');
  }
  
  public function dto(){
    $user = User::find($this->authorId);
    return [
      "id"=> $this->id,
      "guid" => $this->guid,
      "content" => $this->content,
      "date" => $this->created_at->toDateString(),
      "authorId" => $user->id,
      "authorName" => $user->name,
      "avatar" => $user->avatar,
    ];
  }
}
