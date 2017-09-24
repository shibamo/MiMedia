<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\AdSetting;
use App\User;
use Carbon\Carbon;

use UUID;
class AdSettingController extends Controller
{
  public function index()
  {
    return view('ad-setting.index',[
      'viewBag' => $this->viewBag,
      'data' => AdSetting::orderBy('name','desc')->orderBy('displayOrder','asc')->get(),
      'currentFunction' => 'AdSetting',
      'resourceUrlPrefix' => $this->generalAwsResourceUrlPrefix,
    ]);
  }

  public function edit($id)
  {
    return view('ad-setting.edit',[
      'viewBag' => $this->viewBag,
      'data' => AdSetting::find($id),
      'adCustomers' => User::where('isADClient', 1)->get()->keyBy('id')->map(
        function($item){return $item->id . ' | ' . $item->name . ' | ' . $item->email;}),
      'currentFunction' => 'AdSetting',
      'resourceUrlPrefix' => $this->generalAwsResourceUrlPrefix,
    ]);
  }

  public function update(Request $request, $id)
  {
    $adSetting = AdSetting::find($id);
    $newImageFileName = "";

    $imageFile = $request->file('image');
    if($imageFile){ //如果更改上传了广告图片
      $newImageFileName = UUID::generate()->string . '.' . $imageFile->extension();
        Storage::disk('s3')->putFileAs($this->adSubFolderName, $imageFile, $newImageFileName, 'public');
    }

    $adSetting->name = $request->name;
    $adSetting->caption = $request->caption;
    $adSetting->startFrom = Carbon::parse($request->startFrom);
    $adSetting->endTo = $request->endTo ? Carbon::parse($request->endTo) : null;
    $adSetting->maintainerId = Auth::user()->id;
    $adSetting->customerId = $request->customerId;
    $adSetting->displayOrder = $request->displayOrder;
    if($newImageFileName){ //如果更改上传了广告图片
      $adSetting->imageUrl = $this->adSubFolderName . "/" . $newImageFileName;
    }
    $adSetting->contentUrl = $request->contentUrl;
    $adSetting->memo = $request->memo;
    $adSetting->save();

    return redirect()->action('AdSettingController@index');
  }

  public function create()
  {
    return view('ad-setting.create',
      ['viewBag' => $this->viewBag,
      'adCustomers' => User::where('isADClient', 1)->get()->keyBy('id')->map(
        function($item){return $item->id . ' | ' . $item->name . ' | ' . $item->email;}),
      'currentFunction' => 'AdSetting',
      ]
    );
  }

  public function store(Request $request)
  {
    // 广告图上传保存
    $imageFile = $request->file('image');
    $newImageFileName = UUID::generate()->string . '.' . $imageFile->extension();

    #region 保存到S3
      Storage::disk('s3')->putFileAs($this->adSubFolderName, $imageFile, $newImageFileName, 'public');
    #endregion

    // 记录保存
    $programe = AdSetting::create([
      'name' => $request->name, 
      'caption' => $request->caption,
      'startFrom' => Carbon::parse($request->startFrom),
      'endTo' => $request->endTo ? Carbon::parse($request->endTo) : null,
      'maintainerId' => Auth::user()->id,
      'customerId' => $request->customerId,
      'displayOrder' => $request->displayOrder,
      'imageUrl' => $this->adSubFolderName . "/" . $newImageFileName,
      "contentUrl" => $request->contentUrl,
      "memo" => $request->memo,
    ]);

    return redirect()->action('AdSettingController@index');
  }

  public function show($id)
  {
      //
  }

  public function destroy($id)
  {
    AdSetting::destroy($id);
    return redirect()->action('AdSettingController@index');
  }
}
