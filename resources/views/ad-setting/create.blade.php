@extends('layouts.master')

@section('content')
<h2>创建广告</h2>
{{Form::open(['action' => 'AdSettingController@store', 'files' => true, 'autocomplete' => 'off',])}}
  <div class="form-horizontal">
    <hr />

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {{Form::label('name', '* 位置', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('name', ['tv-programe-list' => '电视', 'radio-station-list' => '电台', 'forum-board-list' => '论坛'], null, ['placeholder' => '选择位置...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('customerId') ? ' has-error' : '' }}">
      {{Form::label('customerId', '* 广告客户账户', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('customerId', $adCustomers, null, ['placeholder' => '选择广告客户账户...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      {{Form::label('image', '* 广告图片', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::file('image', null, ['placeholder' => '上传广告图片...', 'class' => 'form-control','required' =>"true", 'id'=>'image'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('displayOrder') ? ' has-error' : '' }}">
      {{Form::label('displayOrder', '* 显示序号', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('displayOrder', null, ['placeholder' => '输入显示序号,必须为整数数字...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('startFrom') ? ' has-error' : '' }}">
      {{Form::label('startFrom', '* 开始日期', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('startFrom', null, ['placeholder' => '输入开始日期 (格式为2017-01-31)...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('endTo') ? ' has-error' : '' }}">
      {{Form::label('endTo', '结束日期', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('endTo', null, ['placeholder' => '输入结束日期 (格式为2017-11-31)...', 'class' => 'form-control'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
      {{Form::label('caption', '标题', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('caption', null, ['placeholder' => '输入标题...', 'class' => 'form-control'])}}
      </div>
    </div>    

    <div class="form-group{{ $errors->has('contentUrl') ? ' has-error' : '' }}">
      {{Form::label('contentUrl', '内容页链接', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('contentUrl', null, ['placeholder' => '输入内容页链接...', 'class' => 'form-control'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('memo') ? ' has-error' : '' }}">
      {{Form::label('memo', '备注', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::textarea('memo', null, ['placeholder' => '输入备注...', 'class' => 'form-control'])}}
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
    //$('#submit').bind("click",function(){
    $("form").submit(function(e){
      var continueInvoke = true;

      var imgVal = $('#image').val(); 
      if(imgVal=='') 
      { 
        alert("需要广告图片"); 
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
  {{link_to_action('AdSettingController@index', $title = '返回', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

