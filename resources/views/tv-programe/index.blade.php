@extends('layouts.master')
@section('content')
  <h4>电视节目列表
    {{link_to_action('TvProgrameController@create', $title = '新建', $parameters = [], $attributes = ['class'=>"btn btn-primary btn-sm"])}}
  </h4> 
  <div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
        <a href="#newsItems" aria-controls="newsItems" role="tab" data-toggle="tab">新闻</a>
      </li>
      <li role="presentation">
        <a href="#entertainItems" aria-controls="entertainItems" role="tab" data-toggle="tab">娱乐</a>
      </li>
      <li role="presentation">
        <a href="#automanItems" aria-controls="automanItems" role="tab" data-toggle="tab">汽车人</a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="newsItems"> 
        @include('tv-programe._tv_programe_list', ['data' => $newsItems])
      </div>
      <div role="tabpanel" class="tab-pane" id="entertainItems">         @include('tv-programe._tv_programe_list', ['data' => $entertainItems])
      </div>
      <div role="tabpanel" class="tab-pane" id="automanItems"> 
        @include('tv-programe._tv_programe_list', ['data' => $automanItems])
      </div>
    </div>

  </div>  
@endsection