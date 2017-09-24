<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumBoard extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

  protected $guarded = [];
  protected $hidden = ['created_at','deleted_at','updated_at'];

  public function forumThreadMains(){
    return $this->hasMany('App\ForumThreadMain','forumBoardId');
  }

}
