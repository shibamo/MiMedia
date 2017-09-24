<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use UUID;

use App\RadioPrograme;
use App\ResourceLocation;

class RadioProgrameController extends Controller
{
  public function index()
  {
    return view('radio-programe.index',[
      'viewBag' => $this->viewBag,
      'morningItems' => RadioPrograme::fromChannelName('morningItems')
        ->sortByDesc('date'),
      'livingItems' => RadioPrograme::fromChannelName('livingItems')
        ->sortByDesc('date'),
      'musicItems' => RadioPrograme::fromChannelName('musicItems')
        ->sortByDesc('date'),
      'automanItems' => RadioPrograme::fromChannelName('automanItems')
        ->sortByDesc('date'),        
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
    $newRadioFileName = UUID::generate()->string . '.' . $radioFile->extension();

    #region 保存到S3
    Storage::disk('s3')->putFileAs($this->radioSubFolderName, $radioFile, $newRadioFileName, 'public');
    #endregion

    $imageFile = $request->file('image');
    $newImageFileName = UUID::generate()->string . '.' . $imageFile->extension();

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

    return redirect()->action('RadioProgrameController@index');
  }

  public function show($id)
  {
    return view('radio-programe.show',
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

  public function destroy($id)
  {
    RadioPrograme::destroy($id);
    return redirect()->action('RadioProgrameController@index');
  }
}
