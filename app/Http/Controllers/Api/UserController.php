<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ApiController;

use JWTAuth;
use UUID;
use App\User;
use App\ResourceLocation;

class UserController extends ApiController
{
  const maxFailCount = 5; //失败次数上限
  protected $avatarImagesSubFolderName = 'avatar';

  public function index()
  {
  }

  public function setAvatar(Request $request)
  {
    $user = JWTAuth::parseToken()->authenticate();

    #region用户的头像图上传保存, 图片以base64字符串的形式(而不是raw文件)上传, 因为此方式容易导致android客户端app闪退, 暂时放弃
      // $imageFile = $request->image;
      // $newImageFileName = UUID::generate()->string . '.jpeg';
      // $relativePathName = $this->avatarImagesSubFolderName . '/' . $newImageFileName;
      //   //保存到S3, 这里使用put方法,因为putFileAs方法不支持直接写入文件内容的调用参数
      //   if(Storage::disk('s3')->put($relativePathName, base64_decode($imageFile), 'public'))
      //   {
      //     $user->avatar = $relativePathName;
      //     $user->save();
      //     return $this->generateUserObjectToFront($user);
      //   }else{
      //     return $this->generateErrorObjectToFront('无法更改头像图片');
      //   }
    #endregion

    //用户的头像图上传保存
    $imageFile = $request->file('file');
    $newImageFileName = UUID::generate()->string . '.' . $imageFile->extension();
    $relativePathName = $this->avatarImagesSubFolderName . '/' . $newImageFileName;
    #region 保存到S3
      if(Storage::disk('s3')->putFileAs($this->avatarImagesSubFolderName, $imageFile, $newImageFileName, 'public'))
      {
        $user->avatar = $relativePathName;
        $user->save();
        return $this->generateUserObjectToFront($user);
      }else{
        return $this->generateErrorObjectToFront('无法更改头像图片');
      }
    #endregion
  }

  public function jwtLogin(Request $request)
  {
    try {
      if (! $user = JWTAuth::parseToken()->authenticate()) {
        return response()->json(['user_not_found'], 404);
      }
    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
      return response()->json(['token_expired'], $e->getStatusCode());
    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
      return response()->json(['token_invalid'], $e->getStatusCode());
    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
      return response()->json(['token_absent'], $e->getStatusCode());
    }

    // the token is valid and we have found the user via the sub claim
    // return [
    //   'user' =>[
    //     'id' => $user->id,
    //     'name' => $user->name,
    //     'email' => $user->email,
    //     'JWT_Token' => JWTAuth::fromUser($user),
    //   ],
    //   'status' => 'success',
    // ];    
    return response()->json(compact('user'));
  }

  public function register(Request $request)
  {
    $credentials = $request->only('email', 'name', 'password','question','answer');
    $credentials['email'] = strtolower($credentials['email']);
    $credentials['password'] = bcrypt($credentials['password']);
    $credentials['guid'] = UUID::generate()->string;
    $credentials['avatar'] = 'avatar/avatar.png';

    if(User::where('name', $credentials['name'])->count()){
      return $this->generateErrorObjectToFront('该用户名已存在');
    }

    if(User::where('email', $credentials['email'])->count()){
      return $this->generateErrorObjectToFront('Email邮箱账户已存在');
    }

    if(empty($credentials['question']) || empty($credentials['question'])){
      return $this->generateErrorObjectToFront('问题和回答都不能为空');
    }

    $user = User::create($credentials);

    return $this->generateUserObjectToFront($user);
  }

  public function login(Request $request)
  {
    if (Auth::attempt(['email' => strtolower($request->email), 
        'password' => $request->password])) 
    {
      $user = Auth::user();
      return $this->generateUserObjectToFront($user);
    }else{
      return $this->generateErrorObjectToFront('Email邮箱账户或密码错误');
    }
  }

  // 使用邮件地址和旧密码来更新密码, 需要是用户在已经登录状态下
  public function changePassword(Request $request)
  {
    $user = JWTAuth::parseToken()->authenticate(); //需要是用户在已经登录状态下
    
    $oldPassword = $request->oldPassword;
    $newPassword = $request->newPassword;

    //还是需要先验证用户输入的旧密码
    if (Auth::attempt(['email' => strtolower($user->email), 'password' => $oldPassword])) {
      $user->password = bcrypt($newPassword);
      $user->save();
      return $this->generateUserObjectToFront($user);
    } else {
      return $this->generateErrorObjectToFront('Email邮箱账户或原密码错误');
    }
  }

  // 使用邮件地址获取密码问题, 不需要用户在已经登录状态下
  public function getQuestionFromEmail(Request $request){
    $email = strtolower($request->email);

    if(User::where('email', $email)->count()){
      $user = User::where('email', $email)->first();
      return response()->json(
        [
          "question" => $user->question,
        ], 
        Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
    }else {
      return $this->generateErrorObjectToFront('该Email对应的账户不存在');
    }
  }

  // 使用邮件地址和密码答案来更新密码, 不需要用户在已经登录状态下
  public function resetPassword(Request $request)
  {
    $email = strtolower($request->email);
    $answer = $request->answer;
    $newPassword = $request->newPassword;

    if(User::where('email', $email)->where('answer',$answer)->count()){
      $user = User::where('email', $email)->first();
      $user->password = bcrypt($newPassword);
      $user->save();
      return $this->generateUserObjectToFront($user);
    }else {
      return $this->generateErrorObjectToFront('Email邮箱账户或答案错误');
    }
  }

  private function generateUserObjectToFront(User $user)
  {
    return response()->json([
      'user' =>[
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'avatar' => $user->avatar,
        'JWT_Token' => JWTAuth::fromUser($user),
      ],
      'status' => 'success',
    ], Response::HTTP_OK, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }

  private function generateErrorObjectToFront(string $message, 
    int $status_code = Response::HTTP_FORBIDDEN)
  {
    return response()->json([
      'data' => [
        'message' => $message,
        'status_code' => $status_code
      ]
    ], $status_code, $this->jsonHeader, JSON_UNESCAPED_UNICODE);
  }
}
