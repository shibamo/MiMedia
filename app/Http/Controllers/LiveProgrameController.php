<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use UUID;

use App\LivePrograme;
use App\LiveChannel;
use App\ResourceLocation;

class LiveProgrameController extends Controller
{
  public function index(Request $request)
  {
    // 目前暂时不在页面逻辑中实现多个直播频道,直接取第一个默认频道
    return view('live-programe.index',[
      'viewBag' => $this->viewBag,
      'liveItems' => LivePrograme::fromChannelId(1)
        ->sortByDesc('date')->take($this->recordCountPerPage),
      'currentFunction' => 'LivePrograme',
    ]);
  }

  public function create()
  {
    return view('live-programe.create',
      ['viewBag' => $this->viewBag, 
      'currentFunction' => 'LivePrograme',]);
  }

  public function store(Request $request)
  {
    $url = "";

    if(isset($request->youtubeLink) && $this->isYoutubeLink($request->youtubeLink))
    {
      $url = $request->youtubeLink;
    }
    
    // 视频封面图上传保存
    $imageFile = $request->file('image');
    $newImageFileName = UUID::generate()->string . '.' . $imageFile->getClientOriginalExtension();
    #region 保存到本地
      //$imageFile->move(public_path(). '/' . $this->coverImagesSubFolderName,$newImageFileName);
    #endregion

    #region 封面图片保存到S3
      Storage::disk('s3')->putFileAs($this->coverImagesSubFolderName, $imageFile, $newImageFileName, 'public');
    #endregion

    // 数据记录保存
    $programe = LivePrograme::create([
      'liveChannelId'=> 1, //目前暂时不在页面逻辑中实现多个直播频道,直接取第一个默认频道 $request->liveChannelId,
      'guid'=> UUID::generate()->string,
      'name' => $request->name, 
      'image' => $this->coverImagesSubFolderName . "/" . $newImageFileName,
      "url" => $url,
      "date" => $request->date,
      "isChecked" => true,
      "isPublished" => true,
    ]);

    return redirect()->action('LiveProgrameController@index');
  }

  public function show($id)
  {
    $item = LivePrograme::find($id);
    $youtubeLink = "";
    if($this->isYoutubeLink($item->url))
    {
      $youtubeLink = "https://www.youtube.com/embed/" .  str_replace("https://www.youtube.com/watch?v=", "", $item->url) .  "?autoplay=1&rel=0";
    }

    return view('live-programe.show',
    ['viewBag' => $this->viewBag,
    'item'=>$item, 
    'isYoutubeLink' => $this->isYoutubeLink($item->url),
    'youtubeLink' => $youtubeLink, 
    'currentFunction' => 'LivePrograme',
    'resourceUrlPrefix' => $this->generalAwsResourceUrlPrefix,
    ]);
  }

  public function edit($id)
  {
    // 暂未实现
  }

  public function update(Request $request, $id)
  {
    // 暂未实现
  }

  public function destroy($id)
  {
    LivePrograme::destroy($id);
    return redirect()->action('LiveProgrameController@index');
  }
}
