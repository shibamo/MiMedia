<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\ForumBoard;
use App\User;

class ForumThreadReplyComplain extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

  protected $guarded = [];

  public function forumThreadReply(){
    return $this->belongsTo('App\ForumThreadReply','forumThreadReplyId','id');
  }

  public function complainer(){
    return $this->belongsTo('App\User','complainerId','id');
  }

  public function supervisor(){
    return $this->belongsTo('App\User','supervisorId','id');
  }
}
