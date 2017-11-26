<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\User;
use App\ResourceLocation;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  protected $jsonHeader = array (
    'Content-Type' => 'application/json; charset=UTF-8',
    'charset' => 'utf-8'
  );

  public $viewBag = [];

  protected $currentFunction = "";
  protected $generalAwsResourceUrlPrefix = null;
  protected $tvSubFolderName = 'tv';
  protected $radioSubFolderName = 'radio';
  protected $coverImagesSubFolderName = 'cover_images';
  protected $avatarSubFolderName = 'avatar';
  protected $adSubFolderName = 'ad';
  protected $recordCountPerPage = 50;
  
	public function __construct(Request $request){
    $this->generalAwsResourceUrlPrefix = ResourceLocation::generalAwsResourceUrlPrefix();

    if(stristr($request->path(),'/login') == FALSE && 
    stristr($request->path(),'/webview/') == FALSE){
      // 需要使用middleware,否则在__construct取不到用户验证信息和session, 参考自 https://github.com/laravel/framework/issues/15072, https://github.com/laravel/docs/blob/5.3/upgrade.md#session-in-the-constructor
      //https://stackoverflow.com/questions/42267376/how-to-access-session-in-construct
      $self = $this;
      $this->middleware(function ($request, $next) use(&$self) {
          if(!Auth::check()) {
            Redirect::to('User/login')->send();
          } else {
            $self->viewBag['currentUser'] = Auth::user();
          }
          return $next($request);
      });
    }
	}  
}
