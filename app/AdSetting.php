<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdSetting extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at', 'startFrom', 'endTo'];

  protected $guarded = [];
  
}
