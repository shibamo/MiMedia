<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use UUID;

use App\TvPrograme;
use App\ResourceLocation;

class TvProgrameController extends Controller
{
  /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
  public function index(Request $request)
  {
    // 当前显示的频道
    if ($request->session()->has('currentChannel')) {
      $this->viewBag['currentChannel'] = $request->session()->get('currentChannel', 1);
      ;
    }else{
      $this->viewBag['currentChannel'] = 1;
    }

    return view('tv-programe.index',[
      'viewBag' => $this->viewBag,
      'newsItems' => TvPrograme::fromChannelName('newsItems')
        ->sortByDesc('date')->take($this->recordCountPerPage),
      'entertainItems' => TvPrograme::fromChannelName('entertainItems')
        ->sortByDesc('date')->take($this->recordCountPerPage),
      'automanItems' => TvPrograme::fromChannelName('automanItems')
        ->sortByDesc('date')->take($this->recordCountPerPage),
      'currentFunction' => 'TvPrograme',
      'resourceUrlPrefix' => $this->generalAwsResourceUrlPrefix,
    ]);
  }

  /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
  public function create()
  {
    return view('tv-programe.create',['viewBag' => $this->viewBag,'currentFunction' => 'TvPrograme',]);
  }

  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function store(Request $request)
  {
    // 视频上传保存
    $tvFile = $request->file('tv');
    $newTvFileName = UUID::generate()->string . '.' . $tvFile->extension();

    #region 保存到本地
      // $tvFile->move(public_path(). '/' . $this->tvSubFolderName, $newTvFileName);
    #endregion

    #region 视频保存到S3
      Storage::disk('s3')->putFileAs($this->tvSubFolderName, $tvFile, $newTvFileName, 'public');
    #endregion

    // 视频封面图上传保存
    $imageFile = $request->file('image');
    $newImageFileName = UUID::generate()->string . '.' . $imageFile->extension();
    #region 保存到本地
      //$imageFile->move(public_path(). '/' . $this->coverImagesSubFolderName,$newImageFileName);
    #endregion

    #region 封面图片保存到S3
      Storage::disk('s3')->putFileAs($this->coverImagesSubFolderName, $imageFile, $newImageFileName, 'public');
    #endregion

    // 视频数据记录保存
    $programe = TvPrograme::create([
      'tvChannelId'=>$request->tvChannelId,
      'guid'=> UUID::generate()->string,
      'name' => $request->name, 
      'shortContent' => $request->shortContent,
      'content' => $request->content,
      'image' => $this->coverImagesSubFolderName . "/" . $newImageFileName,
      "url" => $this->tvSubFolderName . "/" . $newTvFileName,
      "date" => $request->date,
      "isChecked" => true,
      "isPublished" => true,
    ]);

    // 暂存本次操作的频道名, 用于显示返回显示列表时定位到最近操作的频道
    $request->session()->flash('currentChannel', $request->tvChannelId);

    return redirect()->action('TvProgrameController@index');
  }

  /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function show(Request $request, $id)
  {
    // 暂存本次操作的频道名, 用于显示返回显示列表时定位到最近操作的频道
    $request->session()->flash('currentChannel', TvPrograme::find($id)->tvChannel->id);

    return view('tv-programe.show',
    ['viewBag' => $this->viewBag,
    'item'=>TvPrograme::find($id), 
    'currentFunction' => 'TvPrograme',
    'resourceUrlPrefix' => $this->generalAwsResourceUrlPrefix,
    ]);
  }

  public function webview($id)
  {
    return view('tv-programe.webview',
    [
      'viewBag' => $this->viewBag,
      'item'=>TvPrograme::find($id), 
      'currentFunction' => 'TvPrograme',
      'resourceUrlPrefix' => $this->generalAwsResourceUrlPrefix,
    ]);
  }

  /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function edit($id)
  {
      //
  }

  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, $id)
  {
      //
  }

  /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function destroy(Request $request,$id)
  {
    // 暂存本次操作的频道名, 用于显示返回显示列表时定位到最近操作的频道
    $request->session()->flash('currentChannel', TvPrograme::find($id)->tvChannel->id);
    
    TvPrograme::destroy($id);
    return redirect()->action('TvProgrameController@index');
  }
}
