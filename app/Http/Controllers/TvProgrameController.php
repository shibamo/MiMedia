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
  public function index()
  {
    return view('tv-programe.index',[
      'viewBag' => $this->viewBag,
      'newsItems' => TvPrograme::fromChannelName('newsItems')
        ->sortByDesc('date'),
      'entertainItems' => TvPrograme::fromChannelName('entertainItems')
        ->sortByDesc('date'),
      'automanItems' => TvPrograme::fromChannelName('automanItems')
        ->sortByDesc('date'),
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

    #region 保存到S3
      Storage::disk('s3')->putFileAs($this->tvSubFolderName, $tvFile, $newTvFileName, 'public');
    #endregion

    // 视频封面图上传保存
    $imageFile = $request->file('image');
    $newImageFileName = UUID::generate()->string . '.' . $imageFile->extension();
    #region 保存到本地
      //$imageFile->move(public_path(). '/' . $this->coverImagesSubFolderName,$newImageFileName);
    #endregion

    #region 保存到S3
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

    return redirect()->action('TvProgrameController@index');
  }

  /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function show($id)
  {
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
  public function destroy($id)
  {
    TvPrograme::destroy($id);
    return redirect()->action('TvProgrameController@index');
  }
}
