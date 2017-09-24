<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;

use App\AdSetting;

class AdSettingController extends ApiController
{
  public function index()
  {
    return response()->json(
      AdSetting::all()->map(
        function($item){
          return collect($item)->only(['id','name','imageUrl','contentUrl',]);}), 
      Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }
}