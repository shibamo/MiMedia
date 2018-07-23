<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use UUID;

use App\RadioPrograme;
use App\ResourceLocation;

class RadioProgrameController extends Controller
{
  public function index(Request $request)
  {
    // 当前显示的频道
    if ($request->session()->has('currentChannel')) {
      $this->viewBag['currentChannel'] = $request->session()->get('currentChannel', 1);
      ;
    }else{
      $this->viewBag['currentChannel'] = 1;
    }

    return view('radio-programe.index',[
      'viewBag' => $this->viewBag,
      'morningItems' => RadioPrograme::fromChannelName('morningItems')
        ->sortByDesc('date')->take($this->recordCountPerPage),
      'livingItems' => RadioPrograme::fromChannelName('livingItems')
        ->sortByDesc('date')->take($this->recordCountPerPage),
      'musicItems' => RadioPrograme::fromChannelName('musicItems')
        ->sortByDesc('date')->take($this->recordCountPerPage),
      'automanItems' => RadioPrograme::fromChannelName('automanItems')
        ->sortByDesc('date')->take($this->recordCountPerPage),        
      'currentFunction' => 'RadioPrograme',
    ]);
  }

  public function create()
  {
    return view('radio-programe.create',
      ['viewBag' => $this->viewBag, 
      'currentFunction' => 'RadioPrograme',]);
  }

  public function store(Request $request)
  {
    $radioFile = $request->file('radio');
    $newRadioFileName = UUID::generate()->string . '.' . $radioFile->getClientOriginalExtension();

    #region 保存到S3
    Storage::disk('s3')->putFileAs($this->radioSubFolderName, $radioFile, $newRadioFileName, 'public');
    #endregion

    $imageFile = $request->file('image');
    $newImageFileName = UUID::generate()->string . '.' . $imageFile->getClientOriginalExtension();

    #region 保存到S3
    Storage::disk('s3')->putFileAs($this->coverImagesSubFolderName, $imageFile, $newImageFileName, 'public');
    #endregion

    $programe = RadioPrograme::create([
      'radioChannelId'=>$request->radioChannelId,
      'guid'=> UUID::generate()->string,
      'name' => $request->name, 
      'shortContent' => $request->shortContent, 
      'content' => $request->content,
      'image' => $this->coverImagesSubFolderName . "/" . $newImageFileName,
      "url" => $this->radioSubFolderName . "/" . $newRadioFileName,
      "date" => $request->date,
      "isChecked" => true,
      "isPublished" => true,
    ]);

    // 暂存本次操作的频道名, 用于显示返回显示列表时定位到最近操作的频道
    $request->session()->flash('currentChannel', $request->radioChannelId);

    return redirect()->action('RadioProgrameController@index');
  }

  public function show(Request $request, $id)
  {
    // 暂存本次操作的频道名, 用于显示返回显示列表时定位到最近操作的频道
    $request->session()->flash('currentChannel', RadioPrograme::find($id)->radioChannel->id);

    return view('radio-programe.show',
    [
      'viewBag' => $this->viewBag,
      'item'=>RadioPrograme::find($id), 
      'currentFunction' => 'RadioPrograme',
      'resourceUrlPrefix' => $this->generalAwsResourceUrlPrefix,
      ]);
  }

  public function webview($id)
  {
    return view('radio-programe.webview',
    [
      'viewBag' => $this->viewBag,
      'item'=>RadioPrograme::find($id), 
      'currentFunction' => 'RadioPrograme',
      'resourceUrlPrefix' => $this->generalAwsResourceUrlPrefix,
      ]);
  }

  public function edit($id)
  {
      //
  }

  public function update(Request $request, $id)
  {
      //
  }

  public function destroy(Request $request, $id)
  {
    // 暂存本次操作的频道名, 用于显示返回显示列表时定位到最近操作的频道
    $request->session()->flash('currentChannel', RadioPrograme::find($id)->radioChannel->id);

    RadioPrograme::destroy($id);
    return redirect()->action('RadioProgrameController@index');
  }
}
