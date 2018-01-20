@extends('layouts.master')
@section('content')
  <h4>电台节目列表 / Radio Program List
    {{link_to_action('RadioProgrameController@create', $title = 'Create', $parameters = [], $attributes = ['class'=>"btn btn-primary btn-sm"])}}
  </h4> 
  <div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="{{ $viewBag['currentChannel']==1 ? 'active' : ''}}">
        <a href="#morningItems" aria-controls="morningItems" role="tab" data-toggle="tab">早安密西根/Morning michigan</a>
      </li>
      <li role="presentation"  class="{{ $viewBag['currentChannel']==2 ? 'active' : ''}}">
        <a href="#livingItems" aria-controls="livingItems" role="tab" data-toggle="tab">密西根生活/Michigan life</a>
      </li>
      <li role="presentation"  class="{{ $viewBag['currentChannel']==3 ? 'active' : ''}}">
        <a href="#musicItems" aria-controls="musicItems" role="tab" data-toggle="tab">音乐台/Music</a>
      </li>
      <li role="presentation"  class="{{ $viewBag['currentChannel']==4 ? 'active' : ''}}">
        <a href="#automanItems" aria-controls="automanItems" role="tab" data-toggle="tab">汽车人/Auto Man</a>
      </li>      
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane {{ $viewBag['currentChannel']==1 ? 'active' : ''}}" id="morningItems"> 
        @include('radio-programe._radio_programe_list', ['data' => $morningItems])
      </div>
      <div role="tabpanel" class="tab-pane {{ $viewBag['currentChannel']==2 ? 'active' : ''}}" id="livingItems">         @include('radio-programe._radio_programe_list', ['data' => $livingItems])
      </div>
      <div role="tabpanel" class="tab-pane {{ $viewBag['currentChannel']==3 ? 'active' : ''}}" id="musicItems"> 
        @include('radio-programe._radio_programe_list', ['data' => $musicItems])
      </div>
      <div role="tabpanel" class="tab-pane {{ $viewBag['currentChannel']==4 ? 'active' : ''}}" id="automanItems"> 
        @include('radio-programe._radio_programe_list', ['data' => $automanItems])
      </div>            
    </div>

  </div>  
@endsection