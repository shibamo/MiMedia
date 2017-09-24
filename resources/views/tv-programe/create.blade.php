@extends('layouts.master')

@section('content')
<h2>创建电视节目</h2>
{{Form::open(['action' => 'TvProgrameController@store', 'files' => true, 'autocomplete' => 'off',])}}
  <div class="form-horizontal">
    <hr />

    <div class="form-group{{ $errors->has('tvChannelId') ? ' has-error' : '' }}">
      {{Form::label('tvChannelId', '* 频道', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('tvChannelId', ['1' => '新闻', '2' => '娱乐', '3' => '汽车人'], null, ['placeholder' => '选择频道...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {{Form::label('name', '* 标题', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('name', null, ['placeholder' => '输入标题...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>    

    <div class="form-group{{ $errors->has('shortContent') ? ' has-error' : '' }}">
      {{Form::label('shortContent', '* 简介', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('shortContent', null, ['placeholder' => '输入简介...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>    

    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
      {{Form::label('content', '* 文本内容', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::textarea('content', null, ['placeholder' => '输入文本内容...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
      {{Form::label('date', '* 显示日期', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('date',  (new \Carbon\Carbon())->toDateString(), ['placeholder' => '输入显示日期 (格式为2017-01-31)...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      {{Form::label('image', '* 封面图片', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::file('image', null, ['placeholder' => '选择封面图片...', 'class' => 'form-control','required' =>"true", 'id'=>'image'])}}
      </div>
    </div>


    <div class="form-group{{ $errors->has('tv') ? ' has-error' : '' }}">
      {{Form::label('tv', '* 视频内容(mp4)', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::file('tv', null, ['placeholder' => '选择节目视频...', 'class' => 'form-control','required' =>"true", 'id'=>'tv'])}}
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-offset-2 col-md-10">
        <input type="submit" id="submit" value="创建" class="btn btn-primary" />
      </div>
    </div>
  </div>

{{Form::close()}}

@section('jq_scripts')
  <script type="text/javascript">
  $(document).ready(function() {
    $("form").submit(function(e){
      var continueInvoke = true;

      var imgVal = $('#image').val(); 
      if(imgVal=='') 
      { 
          alert("需要封面图片"); 
          continueInvoke = false; 
      } 

      var tvVal = $('#tv').val(); 
      if(tvVal=='') 
      { 
          alert("需要节目视频"); 
          continueInvoke = false; 
      } 
      
      if(continueInvoke == false){
          e.preventDefault(); 
      }
    });
  });
  </script> 
@endsection

<div>
  {{link_to_action('TvProgrameController@index', $title = '返回', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

