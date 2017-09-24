<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;

use App\TvChannel;
use App\TvPrograme;

class TvProgrameController extends ApiController
{
  public function index()
  {
    $grouped = TvPrograme::orderBy('date', 'desc')->get()->makeHidden([
      'isChecked', 'isPublished', 'created_at', 'updated_at', 'deleted_at'])
      ->groupBy(function ($item, $key) {
        return  TvChannel::find($item['tvChannelId'])->name;
    });

    return response()->json($grouped->toArray(), Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }

  public function channels()
  {
    $channels = TvChannel::all()->makeHidden(['created_at', 'updated_at', 'deleted_at']);
    $channels->each(function ($item, $key) {
      $item['lastPrograme'] =  TvChannel::find($item->id)//这里不能直接用$item,否则输出的数组会带上tvProgrames的内容
        ->tvProgrames->last()->makeHidden([
          'tvChannelId', 'isChecked', 'isPublished', 'created_at', 'updated_at', 'deleted_at']);
    });

    return response()->json($channels, Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }
}