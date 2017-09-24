@extends('layouts.master')

@section('content')
<h2>修改用户类型 ( {{$item->email}} / {{$item->name}} )</h2>
{{Form::open(['route' => ['User.modifyType', $item->id],'method' => 'put'])}}
  <div class="form-horizontal">
    <hr />
    {{Form::hidden('id', $item->id)}}

    <div class="form-group">
      {{Form::label('isADClient', '广告客户?', ['class' => 'col-md-2 control-label text-danger'])}}

      <div class="col-md-4">
        {{Form::checkbox('isADClient', 1, $item->isADClient,['style' => 'margin-top: 14px;'])}}
      </div>
    </div>

    <hr />

    <div class="form-group">
      {{Form::label('isSystemManager', '管理员?', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-1">
        {{Form::checkbox('isSystemManager', 1, $item->isSystemManager,['style' => 'margin-top: 14px;'])}}
      </div>

      {{Form::label('isEditor', '编辑?', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-1">
        {{Form::checkbox('isEditor', 1, $item->isEditor,['style' => 'margin-top: 14px;'])}}
      </div>  

      {{Form::label('isAuditor', '审核?', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-1">
        {{Form::checkbox('isAuditor', 1, $item->isAuditor,['style' => 'margin-top: 14px;'])}}
      </div>

      {{Form::label('isADManager', '广告管理?', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-1">
        {{Form::checkbox('isADManager', 1, $item->isADManager,['style' => 'margin-top: 14px;'])}}
      </div>          
    </div>

    <div class="form-group">
      <div class="col-md-offset-1 col-md-11">
        <input type="submit" value="保存" class="btn btn-primary" />
      </div>
    </div>
  </div>

{{Form::close()}}

@endsection