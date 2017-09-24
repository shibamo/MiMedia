@extends('layouts.master-login')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        @if(Session::has('fail'))
        <div class="alert alert-danger">
          {{\Illuminate\Support\Facades\Session::get('fail')}}
        </div>
        @endif
        <div class="panel panel-default">
          <div class="panel-heading">登录系统</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('doLogin') }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">输入邮箱</label>

                <div class="col-md-6">
                  <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required
                         autofocus>

                  @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">输入密码</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" autocomplete = 'new-password' required>

                  @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 保持登录
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    登录
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
