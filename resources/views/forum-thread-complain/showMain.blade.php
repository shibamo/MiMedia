@extends('layouts.master')

@section('extend-style')
<style>
  .content-cell img{
    max-width: 480px;
  }
</style>
@endsection

@section('content')
<h2>投诉处理 - {{ $item->forumThreadMain->name }}</h2>

{{Form::open(['action' => ['ForumThreadComplainController@processMain', $item['id']], 
'method'=>'PUT', 'autocomplete' => 'off',])}}
  <div class="form-horizontal">
    <hr />
    <div>
      {{Form::label('content', '原帖内容', ['class' => 'col-md-2 control-label'])}}
      <div class="col-md-10">
        {!! $item->forumThreadMain->content !!}
      </div>
    </div>

    <div class="form-group{{ $errors->has('complainContent') ? ' has-error' : '' }}">
      {{Form::label('complainContent', '投诉意见', ['class' => 'col-md-2 control-label'])}}
      <div class="col-md-10" style='color: red;'>
        {{ $item->complainContent }}
      </div>
    </div>  

    <div class="form-group{{ $errors->has('memo') ? ' has-error' : '' }}">
      {{Form::label('memo', '* 处理意见', ['class' => 'col-md-2 control-label'])}}
      <div class="col-md-10">
        {{Form::textarea('memo', $item->memo, ['placeholder' => '输入处理意见...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>  

    <div class="form-group">
      <div class="col-md-offset-2 col-md-10">
        <input type="submit" id="submit" value="提交并删除原帖" class="btn btn-danger" />
      </div>
    </div>
  </div>

{{Form::close()}}

{{link_to_action('ForumThreadComplainController@unProcessed', $title = '待处理投诉列表')}}<br>
@endsection