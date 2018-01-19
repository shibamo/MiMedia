@extends('layouts.master')

@section('content')
<h2>创建广告 / Create Ad</h2>
{{Form::open(['action' => 'AdSettingController@store', 'files' => true, 'autocomplete' => 'off',])}}
  <div class="form-horizontal">
    <hr />

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {{Form::label('name', '* Location', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('name', ['tv-programe-list' => 'TV', 'radio-station-list' => 'Radio', 'forum-board-list' => 'Forum'], null, ['placeholder' => 'Choose location...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('customerId') ? ' has-error' : '' }}">
      {{Form::label('customerId', '* Ad client account', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('customerId', $adCustomers, null, ['placeholder' => 'Choose Ad client account..', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      {{Form::label('image', '* Ad image', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::file('image', null, ['placeholder' => 'Upload Ad image...', 'class' => 'form-control','required' =>"true", 'id'=>'image'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('displayOrder') ? ' has-error' : '' }}">
      {{Form::label('displayOrder', '* Display order', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('displayOrder', null, ['placeholder' => 'Display order,need be number...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('startFrom') ? ' has-error' : '' }}">
      {{Form::label('startFrom', '* Start from', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('startFrom', null, ['placeholder' => 'Start from (format: 2017-01-31)...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('endTo') ? ' has-error' : '' }}">
      {{Form::label('endTo', 'End date', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('endTo', null, ['placeholder' => 'End date (format: 2017-11-31)...', 'class' => 'form-control'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
      {{Form::label('caption', 'Subject', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('caption', null, ['placeholder' => 'Enter subject...', 'class' => 'form-control'])}}
      </div>
    </div>    

    <div class="form-group{{ $errors->has('contentUrl') ? ' has-error' : '' }}">
      {{Form::label('contentUrl', 'Ad page link', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('contentUrl', null, ['placeholder' => 'Enter Ad page link...', 'class' => 'form-control'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('memo') ? ' has-error' : '' }}">
      {{Form::label('memo', 'Memo', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::textarea('memo', null, ['placeholder' => 'Enter memo...', 'class' => 'form-control'])}}
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-offset-2 col-md-10">
        <input type="submit" id="submit" value="Create" class="btn btn-primary" />
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
        alert("Need Ad image"); 
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
  {{link_to_action('AdSettingController@index', $title = 'Back', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

