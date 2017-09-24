<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RadioChannel extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

  protected $guarded = [];

  public function radioProgrames(){
    return $this->hasMany('App\RadioPrograme','radioChannelId');
  }
}