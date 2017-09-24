<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>D Asian Media (D亚洲传媒)</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body style="overflow-y:scroll;">

  <div id="app">
    <div class="container">
      <div class="row" >
        <div class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            {{-- 顶部导航栏 --}}
            @include("partials._Layout_Top_Nav_Bar_Partial")
          </div>
        </div>
      </div>
      
      <div class="row" style="margin-top: 50px;">
        <div class="body-content">
          @yield('content')
          <hr />
          <footer>
            <p class="text-center">
              &copy; {{ Carbon\Carbon::now()->year }} - D*亚洲传媒 | 技术问题请联系: <span class='text-danger'>qinchao@hotmail.com</span> <span class='text-info'> 微信号: shbamo</span>
            </p>
          </footer>
        </div>
      </div>
      
    </div>
  </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield("jq_scripts", '')
    {{-- @include('partials.header')
    <div class="container">
        @yield('content')
    </div> --}}
  </body>
</html>
