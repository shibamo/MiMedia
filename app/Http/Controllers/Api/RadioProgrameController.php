<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;

use App\RadioChannel;
use App\RadioPrograme;

class RadioProgrameController extends ApiController
{
  public function index()
  {
    $grouped = RadioPrograme::orderBy('date', 'desc')->get()->groupBy(function ($item, $key) {
      return  RadioChannel::find($item['radioChannelId'])->name;
    });

    return response()->json($grouped->toArray(), Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }

  public function channels()
  {
    $channels = RadioChannel::all()->makeHidden(['created_at', 'updated_at', 'deleted_at']);
    $channels->each(function ($item, $key) {
      $item['lastPrograme'] =  RadioChannel::find($item->id)//这里不能直接用$item,否则输出的数组会带上programes的内容
        ->radioProgrames->last()->makeHidden([
          'radioChannelId', 'isChecked', 'isPublished', 'created_at', 'updated_at', 'deleted_at']);
    });

    return response()->json($channels, Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);    
  }
}