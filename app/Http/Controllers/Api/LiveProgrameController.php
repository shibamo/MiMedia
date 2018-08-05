<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\ApiController;

use App\LiveChannel;
use App\LivePrograme;

class LiveProgrameController extends ApiController
{
  public function index()
  {
    $lives = LivePrograme::orderBy('date', 'desc')->get()->makeHidden([
      'isChecked', 'isPublished', 'created_at', 'updated_at', 'deleted_at']);

    return response()->json($lives, Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }

}