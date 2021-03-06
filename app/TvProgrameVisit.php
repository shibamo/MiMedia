<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TvProgrameVisit extends Model
{
  use SoftDeletes;
  
  protected $guarded = [];

  public function visitor(){
    return $this->belongsTo('App\User','userId','id');
  }
}
