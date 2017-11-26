<!DOCTYPE html>
<html>
<head>
  {{-- 用于在web页面里显示公开内容页,目前用于微信分享 --}}
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="@yield('meta-description')" />
  <title>D亚洲传媒-@yield('item-title')</title>
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
  <link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">
</head>
<body>
  <div class="container body-content">
      @yield('content')
    <hr />
    <footer>
      <p class="text-center">&copy; {{ Carbon\Carbon::now()->year }} - D*亚洲传媒</p>
    </footer>
  </div>
</body>
</html>