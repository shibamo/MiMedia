@extends('layouts.master')

@section('content')
<h2>Update Ad Image - {{$data->caption}}</h2>
{{Form::open(['action' => ['AdSettingController@update', $data['id']], 
'files' => true, 'method'=>'PUT', 'autocomplete' => 'off',])}}
  <div class="form-horizontal">
    <hr />

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {{Form::label('name', '* Location', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('name', ['tv-programe-list' => 'TV', 'radio-station-list' => 'Radio', 'forum-board-list' => 'Forum'], $data->name, ['placeholder' => 'Choose location...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('customerId') ? ' has-error' : '' }}">
      {{Form::label('customerId', '* Ad client account', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('customerId', $adCustomers, $data->customerId, ['placeholder' => 'Choose Ad client account..'...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      {{Form::label('image', 'Ad image', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        <strong>Old Ad image(No need upload if want to reserve):</strong>
        <img src='{{ $resourceUrlPrefix . $data->imageUrl }}' style='max-width: 300px; border: rgb(128, 128, 128) dotted;'>
        {{Form::file('image', null, ['class' => 'form-control','id'=>'image'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('displayOrder') ? ' has-error' : '' }}">
      {{Form::label('displayOrder', '* Display order', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('displayOrder', $data->displayOrder, ['placeholder' => 'Display order,need be number...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('startFrom') ? ' has-error' : '' }}">
      {{Form::label('startFrom', '* Start from', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('startFrom',  $data->startFrom->toDateString(), ['placeholder' => 'Start from (format: 2017-01-31)...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('endTo') ? ' has-error' : '' }}">
      {{Form::label('endTo', 'End date', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('endTo', ($data->endTo ? $data->endTo->toDateString() : ''), ['placeholder' => 'End date (format: 2017-11-31)...', 'class' => 'form-control'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
      {{Form::label('caption', 'Subject', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('caption', $data->caption, ['placeholder' => 'Enter subject...', 'class' => 'form-control'])}}
      </div>
    </div>    

    <div class="form-group{{ $errors->has('contentUrl') ? ' has-error' : '' }}">
      {{Form::label('contentUrl', 'Ad page link', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('contentUrl', $data->contentUrl, ['placeholder' => 'Enter Ad page link...', 'class' => 'form-control'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('memo') ? ' has-error' : '' }}">
      {{Form::label('memo', 'Memo', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::textarea('memo', $data->memo, ['placeholder' => 'Enter memo...', 'class' => 'form-control'])}}
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-offset-2 col-md-10">
        <input type="submit" id="submit" value="Submit" class="btn btn-primary" />
      </div>
    </div>
  </div>

{{Form::close()}}

<div>
  {{link_to_action('AdSettingController@index', $title = 'Back', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

