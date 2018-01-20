@extends('layouts.master')

@section('content')
<h2>电视节目 / TV program - {{ $item->name }}</h2>
  <div class="form-horizontal">
    <hr />
    <div class="form-group{{ $errors->has('tvChannelId') ? ' has-error' : '' }}">
      {{Form::label('tvChannelId', '* Channel', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('tvChannelId', ['1' => '新闻/News', '2' => '娱乐/Entertainment', '3' => '汽车人/Auto Man'], $item->tvChannelId, ['placeholder' => 'Choose channel...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {{Form::label('name', '* Subject', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('name', $item->name, ['placeholder' => 'Enter subject...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div> 

    <div class="form-group{{ $errors->has('shortContent') ? ' has-error' : '' }}">
      {{Form::label('shortContent', '* Summary', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('shortContent', $item->shortContent, ['placeholder' => 'Enter summary...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>    

    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
      {{Form::label('content', '* Content', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::textarea('content', $item->content, ['placeholder' => 'Enter content...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
      {{Form::label('date', '* Display date', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('date', $item->date, ['placeholder' => 'Enter display date (format: 2017-01-31)...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      {{Form::label('image', '* Cover image', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        <img src="{{ $resourceUrlPrefix . $item->image}}">
      </div>
    </div>


    <div class="form-group{{ $errors->has('tv') ? ' has-error' : '' }}">
      {{Form::label('tv', '* video(mp4)', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        <video controls="controls" width="100%" autoplay 
          src="{{ $resourceUrlPrefix . $item->url }}" ></video>
      </div>
    </div>

  </div>

<div>
  {{link_to_action('TvProgrameController@index', $title = 'Back', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

