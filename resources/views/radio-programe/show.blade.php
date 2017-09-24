@extends('layouts.master')

@section('content')
<h2>电台节目 - {{ $item->name }}</h2>
  <div class="form-horizontal">
    <hr />
    <div class="form-group{{ $errors->has('radioChannelId') ? ' has-error' : '' }}">
      {{Form::label('radioChannelId', '* 频道', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('radioChannelId', ['1' => '早安密西根', '2' => '密西根生活', '3' => '密西根小喇叭', '4' => '音乐台', '5' => '汽车人'], $item->radioChannelId, ['placeholder' => '选择频道...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {{Form::label('name', '* 标题', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('name', $item->name, ['placeholder' => '输入标题...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div> 

    <div class="form-group{{ $errors->has('shortContent') ? ' has-error' : '' }}">
      {{Form::label('shortContent', '* 简介', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('shortContent', $item->shortContent, ['placeholder' => '输入简介...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>    

    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
      {{Form::label('content', '* 文本内容', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::textarea('content', $item->content, ['placeholder' => '输入文本内容...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
      {{Form::label('date', '* 显示日期', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('date', $item->date, ['placeholder' => '输入显示日期 (格式为2017-01-31)...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      {{Form::label('image', '* 封面图片', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        <img src="{{ $resourceUrlPrefix . $item->image}}">
      </div>
    </div>


    <div class="form-group{{ $errors->has('radio') ? ' has-error' : '' }}">
      {{Form::label('radio', '* 音频内容', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        <audio controls="controls" width="100%" autoplay 
          src="{{ $resourceUrlPrefix . $item->url }}" ></audio>
      </div>
    </div>

  </div>

<div>
  {{link_to_action('RadioProgrameController@index', $title = '返回', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

