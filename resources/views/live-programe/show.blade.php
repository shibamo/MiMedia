@extends('layouts.master')

@section('content')
<h2>直播节目 / Live program - {{ $item->name }}</h2>
  <div class="form-horizontal">
    <hr />

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {{Form::label('name', 'Subject', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('name', $item->name, ['placeholder' => 'Enter subject...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div> 

    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
      {{Form::label('date', 'Display date', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('date', $item->date, ['placeholder' => 'Enter display date (format: 2017-01-31)...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      {{Form::label('image', 'Cover image', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        <img src="{{ $resourceUrlPrefix . $item->image}}">
      </div>
    </div>

    <div class="form-group{{ $errors->has('live') ? ' has-error' : '' }}">
      {{Form::label('live', 'video preview', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
          @if($isYoutubeLink)
            <iframe width="100%" height="300px" src="{{$youtubeLink}}" allow="autoplay" allowfullscreen frameborder="0" >
            </iframe>
          @else 
            <video controls="controls" width="100%" autoplay 
              src="{{ $resourceUrlPrefix . $item->url }}" ></video>          
          @endif
      </div>
    </div>

  </div>

<div>
  {{link_to_action('LiveProgrameController@index', $title = 'Back', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

