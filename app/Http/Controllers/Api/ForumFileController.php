<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Http\Controllers\ApiController;
use UUID;
use JWTAuth;
use Image;

use App\ForumBoard;
use App\ForumThreadMain;
use App\ForumThreadReply;
use App\ForumFile;

use App\ResourceLocation;

class ForumFileController extends ApiController
{
  protected $forumImagesSubFolderName = 'forum_images';

  public function postNewImage(Request $request)
  {
    //论坛的图上传保存
    $imageFile = $request->file('image');
    $extension = $imageFile->extension();
    $needDeleteTempFile = false;
    try{
      $newImageFile = UUID::generate()->string;
      $newImageFileName = $newImageFile . '.' . $extension;

      $content = $imageFile;
      if($imageFile->getClientSize() > 512*1024){//超过512KB的文件进行强行压缩
        $_file = Image::make($imageFile);
        $_file->resize(600, null, function ($constraint) {
          $constraint->aspectRatio();
        })->save($newImageFileName);//需要临时存入到磁盘
        $needDeleteTempFile = true;
        $content = new File($newImageFileName);
      }
      #region 保存到S3
        $subPath = $this->forumImagesSubFolderName . "/" . date("Ymd");
        Storage::disk('s3')->putFileAs($subPath, $content, $newImageFileName, 'public');
        //https://laracasts.com/discuss/channels/laravel/delete-uploaded-file-from-public-dir
        if($needDeleteTempFile) unlink(public_path($newImageFileName)); 
      #endregion

      return response()->json(
        [
          "link" => ResourceLocation::generalAwsResourceUrlPrefix() . $subPath . "/" . $newImageFileName,
        ], 
        Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);

    }
    catch(Exception $e){
      return response()->json([
        'data' => [
          'message' => $e->__toString(),
          'status_code' => Response::HTTP_FORBIDDEN
        ]
      ], Response::HTTP_FORBIDDEN, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
    }
  }
}