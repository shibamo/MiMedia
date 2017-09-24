<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumFile extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

  protected $guarded = [];

  public function forumThreadMain(){
    return $this->belongsTo('App\ForumThreadMain','forumThreadMainId','id');
  }

  public function forumThreadReply(){
    return $this->belongsTo('App\ForumThreadReply','forumThreadReplyId','id');
  }



  
}
