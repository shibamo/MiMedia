@extends('layouts.master')

@section('content')
  <h3>个人设置</h3> 
{{Form::open(['action' => 'UserController@changePassword', 'files' => true, 'autocomplete' => 'off', 'id' => 'formPassword'])}}
  {{ csrf_field() }}
  <div class="form-horizontal">
    <h4 class="text-center">更改密码 ({{$viewBag['currentUser']->name . " | ". $viewBag['currentUser']->email}})</h4>
    <h5>密码需有八位, 且含有至少一个数字,一个大写字母, 一个小写字母</h5>
    <hr />
    <div class="form-group{{ $errors->has('oldPassword') ? ' has-error' : '' }}">
      <label for="oldPassword" class="col-md-2 control-label">输入原密码</label>

      <div class="col-md-10">
        <input id="oldPassword" type="password" class="form-control" name="oldPassword" autocomplete = 'oldPasswordX' required>

        @if ($errors->has('oldPassword'))
          <span class="help-block">
              <strong>{{ $errors->first('oldPassword') }}</strong>
          </span>
        @endif
      </div>
    </div>

    <div class="form-group{{ $errors->has('newPassword') ? ' has-error' : '' }}">
      <label for="newPassword" class="col-md-2 control-label">输入新密码</label>

      <div class="col-md-10">
        <input id="newPassword" type="password" class="form-control" name="newPassword" autocomplete = 'newPassword' required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="密码需有八位, 且含有至少一个数字,一个大写字母, 一个小写字母">

        @if ($errors->has('newPassword'))
          <span class="help-block">
              <strong>{{ $errors->first('newPassword') }}</strong>
          </span>
        @endif
      </div>
    </div>

    <div class="form-group{{ $errors->has('newPassword1') ? ' has-error' : '' }}">
      <label for="newPassword1" class="col-md-2 control-label">再次输入新密码</label>

      <div class="col-md-10">
        <input id="newPassword1" type="password" class="form-control" name="newPassword1" autocomplete = 'newPassword1' required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="密码需有八位, 且含有至少一个数字,一个大写字母, 一个小写字母">

        @if ($errors->has('newPassword1'))
          <span class="help-block">
              <strong>{{ $errors->first('newPassword1') }}</strong>
          </span>
        @endif
      </div>
    </div>    

    <div class="form-group">
      <div class="col-md-offset-2 col-md-10">
        <input type="submit" id="submit" value="提交" class="btn btn-primary" />
      </div>
    </div>
  </div>

  @section('jq_scripts')
    <script type="text/javascript">
    $(document).ready(function() {
      $("#formPassword").submit(function(e){
        var continueInvoke = true;

        if($('#newPassword1').val() != $('#newPassword').val()) 
        { 
            alert("两个新密码不一致"); 
            continueInvoke = false; 
        } 
        
        if(continueInvoke == false){
            e.preventDefault(); 
        }
      });
    });
    </script> 
  @endsection

{{Form::close()}}
@endsection

