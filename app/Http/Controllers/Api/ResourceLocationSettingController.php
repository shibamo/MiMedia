<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;

use App\ResourceLocation;

class ResourceLocationSettingController extends ApiController
{
  public function index()
  {
    $generalAwsResourceUrlPrefix = ResourceLocation::generalAwsResourceUrlPrefix();
    $generalWebviewUrlPrefix = ResourceLocation::generalWebviewUrlPrefix();

    return response()->json(
      [
        'avatarImageUrlPrefix' => $generalAwsResourceUrlPrefix,
        'forumImageUrlPrefix' => $generalAwsResourceUrlPrefix,
        'tvVideoUrlPrefix' => $generalAwsResourceUrlPrefix,
        'tvImageUrlPrefix' => $generalAwsResourceUrlPrefix,
        'liveImageUrlPrefix' => $generalAwsResourceUrlPrefix,
        'radioAudioUrlPrefix' => $generalAwsResourceUrlPrefix,
        'radioImageUrlPrefix' => $generalAwsResourceUrlPrefix,
        'boardImageUrlPrefix' => $generalAwsResourceUrlPrefix,
        'adImageUrlPrefix' => $generalAwsResourceUrlPrefix,
        'generalWebviewUrlPrefix' => $generalWebviewUrlPrefix,
      ],
      Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE
    );
  }
}