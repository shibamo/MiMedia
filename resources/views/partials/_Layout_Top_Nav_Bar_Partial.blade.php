<div class="navbar-header">
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-expanded="false">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>
  <a class="navbar-brand" href="/" style="padding-top: 5px;">
    <img alt="Brand" src="{{ asset('image/brand.png') }}" 
      style="height: 40px;">
  </a>
</div>

<div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
  <ul class="nav navbar-nav">
    @if($viewBag['currentUser']->canUseFunction('tv'))
      <li class="{{ $currentFunction=='TvPrograme' ? 'active' : ''}}">
        <a href="/TvPrograme">电视节目</a>
      </li>
    @endif

    @if($viewBag['currentUser']->canUseFunction('radio'))
      <li class="{{ $currentFunction=='RadioPrograme' ? 'active' : ''}}">
        <a href="/RadioPrograme">电台节目</a>
      </li>
    @endif

    @if($viewBag['currentUser']->canUseFunction('forum'))
      <li class="dropdown {{ substr($currentFunction, 0, strlen('Forum'))=='Forum' ? 'active' : ''}}">
        <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >论坛管理 <span class="caret"></span></a>
        <ul class="dropdown-menu">    
          <li class="{{ $currentFunction=='Forum.Check' ? 'active' : ''}}">
            {{link_to_action('ForumThreadMainController@unchecked', $title = '待审核列表')}}
          </li>
          <li class="{{ $currentFunction=='Forum' ? 'active' : ''}}">
            <a href="/Forum">论坛列表</a>
          </li> 
        </ul>
      </li>
    @endif

    @if($viewBag['currentUser']->canUseFunction('ad'))
      <li class="{{ $currentFunction=='AdSetting' ? 'active' : ''}}">
        <a href="/AdSetting">广告设置</a>
      </li>
    @endif

    <li><a href="#">统计数据(暂无)</a></li>

    @if($viewBag['currentUser']->canUseFunction('manage'))
      <li class="dropdown {{ substr($currentFunction, 0, strlen('User'))=='User' ? 'active' : ''}}">
        <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >系统管理 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="{{ $currentFunction=='User.All' ? 'active' : ''}}"><a href="/User/all">所有用户</a></li>
          <li class="{{ $currentFunction=='User.AdClient' ? 'active' : ''}}"><a href="/User/adClient">广告客户</a></li>
          <li role="separator" class="divider"></li>
          <li class="{{ $currentFunction=='User.Editor' ? 'active' : ''}}"><a href="/User/editor">编辑人员</a></li>
          <li class="{{ $currentFunction=='User.Auditor' ? 'active' : ''}}"><a href="/User/auditor">论坛审核人员</a></li>
          <li role="separator" class="divider"></li>
          <li class="{{ $currentFunction=='User.ADManager' ? 'active' : ''}}"><a href="/User/adManager">广告管理人员</a></li>        
          <li class="{{ $currentFunction=='User.SystemManager' ? 'active' : ''}}"><a href="/User/systemManager">系统管理人员</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">敏感词(暂无)</a></li>
        </ul>
      </li>
    @endif
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <li class="dropdown {{ $currentFunction=='Profile' ? 'active' : ''}}">
      <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" > 账户({{$viewBag['currentUser']->name}}) <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="/User/logout">退出登录</a></li>
        <li class="{{ $currentFunction=='Profile' ? 'active' : ''}}"><a href="/User/profile">个人设置</a></li>
      </ul>
    </li>
  </ul>
</div>