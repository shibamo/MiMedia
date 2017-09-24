<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>D*亚洲传媒</title>
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
  <link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">
</head>
<body>
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <div class="navbar-brand">D*亚洲传媒</div>
      </div>
      <div class="navbar-collapse collapse navbar-right">
        <ul class="nav navbar-nav">
          <li><a href="#">帮助</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container body-content">
      @yield('content')
    <hr />
    <footer>
      <p class="text-center">&copy; {{ Carbon\Carbon::now()->year }} - D*亚洲传媒</p>
    </footer>
  </div>
</body>
</html>