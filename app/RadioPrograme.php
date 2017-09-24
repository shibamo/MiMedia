<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\RadioChannel;

class RadioPrograme extends Model
{
  use SoftDeletes;
	protected $dates = ['deleted_at'];

  protected $guarded = [];
  protected $touches = ['radioChannel'];

	public function radioChannel(){
		return $this->belongsTo('App\RadioChannel', 'radioChannelId', 'id');
	}

  public static function fromChannelName(string $name){
    return RadioChannel::where('name',$name)->first()->radioProgrames()->get();
  }
}
