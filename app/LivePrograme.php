<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\LiveChannel;

class LivePrograme extends Model
{
  use SoftDeletes;
	protected $dates = ['deleted_at'];

  protected $guarded = [];
  protected $touches = ['liveChannel'];

	public function liveChannel(){
		return $this->belongsTo('App\LiveChannel', 'liveChannelId', 'id');
	}

  public static function fromChannelName(string $name){
    return LiveChannel::where('name',$name)->first()->liveProgrames()->get();
  }

  public static function fromChannelId(int $id){
    return LiveChannel::find($id)->liveProgrames()->get();
  }
}
