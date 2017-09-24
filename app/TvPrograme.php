<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\TvChannel;

class TvPrograme extends Model
{
  use SoftDeletes;
	protected $dates = ['deleted_at'];

  protected $guarded = [];
  protected $touches = ['tvChannel'];

	public function tvChannel(){
		return $this->belongsTo('App\TvChannel', 'tvChannelId', 'id');
	}

  public static function fromChannelName(string $name){
    return TvChannel::where('name',$name)->first()->tvProgrames()->get();
  }
}
