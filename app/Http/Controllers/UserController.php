<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;



use App\User;

class UserController extends Controller
{
  //use AuthenticatesUsers;

  public function index()
  {
    return view('user.index');
  }

  public function create()
  {
    return view('user.create'); 
  }

  public function store(Request $request)
  {
    $input = $request->only(['name','logonName', 'email','displayName']);
    
    $input['password'] = bcrypt($request['logonPassword']);

    DB::transaction(function() use($input,$request){
      $newUser = User::create($input);
    });

    return redirect()->action('UserController@index');
  }

  public function show($id)
  {
      //
  }

  public function edit($id)
  {
    return view('user.edit',[
      'item' => User::find($id),
    ]); 
  }

  public function update(Request $request, int $id)
  {
    $user = User::find($id);
    $input = $request->only(['name','logonName', 'email',]);
    
    if($request['logonPassword']){
      $input['password'] = bcrypt($request['logonPassword']);
    }

    DB::transaction(function() use($input,$request,$user){
      $user->update($input);
    });

    return redirect()->action('UserController@index');    
  }

  public function destroy($id)
  {
      //
  }

  public function login()
  {
    return view('user.login');
  }

  public function doLogin(Request $request)
  {
    if (Auth::attempt(['email' => $request->email, 
        'password' => $request->password], $request->remember) || 
      Auth::attempt(['name' => $request->email, 
        'password' => $request->password], $request->remember)) {
      // Authentication passed...

      $user = Auth::user();

      if($user->isSystemManager || $user->isAuditor || $user->isEditor){
        return redirect()->action('UserController@profile');
      } else {
        Auth::logout(); //不允许一般用户使用本系统
      }
    }

    return view('user.login');
  }

  public function logout()
  {
    Auth::logout();

    return view('user.login');
  }

  public function selfEdit()
  {
    $this->viewBag['currentMenuIndex']='MY-ACCOUNT';
    return view('user.selfedit',[
      'viewBag' => $this->viewBag,
      'item' => Auth::user(),
      'departmentList'=> $this->masterListSvc->getList('Department'),
      'userPositionList'=> $this->masterListSvc->getList('UserPosition'),
    ]); 
  }

  public function selfUpdate()
  {
    return redirect()->intended('/');
  }

  public function all(){
    $users = User::simplePaginate($this->recordCountPerPage);
    return view("user.all",[
      'viewBag' => $this->viewBag,
      'users'=> $users,
      'currentFunction' => 'User.All',
    ]);
  }

  public function adClient(){
    $users = User::where('isADClient', 1)->get();
    return view("user.adClient",[
      'viewBag' => $this->viewBag,
      'users'=> $users,
      'currentFunction' => 'User.AdClient',
    ]);
  }

  public function editor(){
    $users = User::where('isEditor', 1)->get();
    return view("user.editor",[
      'viewBag' => $this->viewBag,
      'users'=> $users,
      'currentFunction' => 'User.Editor',
    ]);
  }

  public function auditor(){
    $users = User::where('isAuditor', 1)->get();
    return view("user.auditor",[
      'viewBag' => $this->viewBag,
      'users'=> $users,
      'currentFunction' => 'User.Auditor',
    ]);
  }

  public function adManager(){
    $users = User::where('isADManager', 1)->get();
    return view("user.adManager",[
      'viewBag' => $this->viewBag,
      'users'=> $users,
      'currentFunction' => 'User.ADManager',
    ]);
  }

  public function systemManager(){
    $users = User::where('isSystemManager', 1)->get();
    return view("user.systemManager",[
      'viewBag' => $this->viewBag,
      'users'=> $users,
      'currentFunction' => 'User.SystemManager',
    ]);
  }

  public function adjustType($id)
  {
    $user = User::find($id);
    return view("user.adjustType",[
      'viewBag' => $this->viewBag,
      'item'=> $user,
      'currentFunction' => 'User.AdjustType',
    ]);
  }

  public function modifyType(Request $request)
  {
    $user = User::find($request->id);

    if(!$request['isSystemManager'] && $user->isSystemManager && 
      User::where('isSystemManager',1)->count()>1)
    {//不能去掉系统中的最后一个系统管理员
      $user->isSystemManager = false;
    }
    if($request['isSystemManager']) $user->isSystemManager = true;

    $user->isAuditor = $request['isAuditor'] ? true : false;
    $user->isEditor = $request['isEditor'] ? true : false;
    $user->isADManager = $request['isADManager'] ? true : false;
    $user->isADClient = $request['isADClient'] ? true : false;
    $user->save();

    return redirect()->action('UserController@all'); 
  }  

  public function profile()
  {
    return view("user.profile",[
      'viewBag' => $this->viewBag,
      'currentFunction' => 'Profile',
    ]);
  }

  public function changePassword(Request $request){
    $validator = Validator::make($request->all(),[]);

    $user = Auth::user();
    if (!Auth::attempt(['email' => $user->email, 'password' => $request['oldPassword']])) {
      $validator->getMessageBag()->add('oldPassword', '原密码不正确');    
      return redirect()->action('UserController@profile')->withErrors($validator);
    }

    $user->password = bcrypt($request['newPassword']);
    $user->save();

    return redirect()->action('UserController@profile'); 
     
  }
}
