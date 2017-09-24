@extends('layouts.master')

@section('content')
<h2>修改广告图片 - {{$data->caption}}</h2>
{{Form::open(['action' => ['AdSettingController@update', $data['id']], 
'files' => true, 'method'=>'PUT', 'autocomplete' => 'off',])}}
  <div class="form-horizontal">
    <hr />

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {{Form::label('name', '* 位置', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('name', ['tv-programe-list' => '电视', 'radio-station-list' => '电台', 'forum-board-list' => '论坛'], $data->name, ['placeholder' => '选择位置...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('customerId') ? ' has-error' : '' }}">
      {{Form::label('customerId', '* 广告客户账户', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('customerId', $adCustomers, $data->customerId, ['placeholder' => '选择广告客户账户...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      {{Form::label('image', '广告图片', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        <strong>原广告图片(如需保留该图片则不需要再次上传):</strong>
        <img src='{{ $resourceUrlPrefix . $data->imageUrl }}' style='max-width: 300px; border: rgb(128, 128, 128) dotted;'>
        {{Form::file('image', null, ['class' => 'form-control','id'=>'image'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('displayOrder') ? ' has-error' : '' }}">
      {{Form::label('displayOrder', '* 显示序号', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('displayOrder', $data->displayOrder, ['placeholder' => '输入显示序号,必须为整数数字...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('startFrom') ? ' has-error' : '' }}">
      {{Form::label('startFrom', '* 开始日期', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('startFrom',  $data->startFrom->toDateString(), ['placeholder' => '输入开始日期 (格式为2017-01-31)...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('endTo') ? ' has-error' : '' }}">
      {{Form::label('endTo', '结束日期', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('endTo', ($data->endTo ? $data->endTo->toDateString() : ''), ['placeholder' => '输入结束日期 (格式为2017-11-31)...', 'class' => 'form-control'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
      {{Form::label('caption', '标题', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('caption', $data->caption, ['placeholder' => '输入标题...', 'class' => 'form-control'])}}
      </div>
    </div>    

    <div class="form-group{{ $errors->has('contentUrl') ? ' has-error' : '' }}">
      {{Form::label('contentUrl', '内容页链接', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('contentUrl', $data->contentUrl, ['placeholder' => '输入内容页链接...', 'class' => 'form-control'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('memo') ? ' has-error' : '' }}">
      {{Form::label('memo', '备注', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::textarea('memo', $data->memo, ['placeholder' => '输入备注...', 'class' => 'form-control'])}}
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-offset-2 col-md-10">
        <input type="submit" id="submit" value="提交" class="btn btn-primary" />
      </div>
    </div>
  </div>

{{Form::close()}}

<div>
  {{link_to_action('AdSettingController@index', $title = '返回', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

