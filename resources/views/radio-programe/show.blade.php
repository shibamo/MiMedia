@extends('layouts.master')

@section('content')
<h2>电台节目 / Radio program - {{ $item->name }}</h2>

<div class="form-horizontal">
  <hr />
  <div class="form-group{{ $errors->has('radioChannelId') ? ' has-error' : '' }}">
    {{Form::label('radioChannelId', '* 频道', ['class' => 'col-md-2 control-label'])}}

    <div class="col-md-10">
      {{Form::select('radioChannelId', ['1' => '早安密西根/Morning michigan', '2' => '密西根生活/Michigan life', '3' => '音乐台/Music', '4' => '汽车人/Auto Man'], $item->radioChannelId, ['placeholder' => 'Choose...', 'class' => 'form-control','required' =>"true"])}}
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


  <div class="form-group{{ $errors->has('radio') ? ' has-error' : '' }}">
    {{Form::label('radio', '* radio(mp3)', ['class' => 'col-md-2 control-label'])}}

    <div class="col-md-10">
      <audio controls="controls" width="100%" autoplay 
        src="{{ $resourceUrlPrefix . $item->url }}" ></audio>
    </div>
  </div>

</div>

<div>
  {{link_to_action('RadioProgrameController@index', $title = 'Back', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

