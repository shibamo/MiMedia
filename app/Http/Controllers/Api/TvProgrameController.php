<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\ApiController;

use App\TvChannel;
use App\TvPrograme;

class TvProgrameController extends ApiController
{
  public function index()
  {
    $tvGrouped = Cache::remember('tv-grouped',5, function(){
      $grouped = TvPrograme::orderBy('date', 'desc')->get()->makeHidden([
        'isChecked', 'isPublished', 'created_at', 'updated_at', 'deleted_at'])
        ->groupBy(function ($item, $key) {
          return  TvChannel::find($item['tvChannelId'])->name;
      });
      return $grouped->toArray();
    });

    return response()->json($tvGrouped, Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }

  public function channels()
  {
    $tvChannels = Cache::remember('tv-channels',5, function(){
      $channels = TvChannel::all()->makeHidden(['created_at', 'updated_at', 'deleted_at']);
      $channels->each(function ($item, $key) {
        $item['lastPrograme'] =  TvChannel::find($item->id)//这里不能直接用$item,否则输出的数组会带上tvProgrames的内容
          ->tvProgrames->last()->makeHidden([
            'tvChannelId', 'isChecked', 'isPublished', 'created_at', 'updated_at', 'deleted_at']);
      });
      return $channels;
    });

    return response()->json($tvChannels, Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }
}