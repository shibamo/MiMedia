@extends('layouts.master')
@section('content')
  <h4>直播节目列表 / Live Program List
    {{link_to_action('LiveProgrameController@create', $title = 'Create', $parameters = [], $attributes = ['class'=>"btn btn-primary btn-sm"])}}
  </h4> 
  <div>
    @include('live-programe._live_programe_list', ['data' => $liveItems])

  </div>  
@endsection