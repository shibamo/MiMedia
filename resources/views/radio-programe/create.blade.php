@extends('layouts.master')

@section('content')
<h2>Create radio program</h2>
{{Form::open(['action' => 'RadioProgrameController@store', 'files' => true, 'autocomplete' => 'off',])}}
  <div class="form-horizontal">
    <hr />

    <div class="form-group{{ $errors->has('radioChannelId') ? ' has-error' : '' }}">
      {{Form::label('radioChannelId', '* Channel', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('radioChannelId', ['1' => '早安密西根/Morning Michigan', '2' => '密西根生活/Michigan Life', '3' => '音乐台/Music', '4' => '汽车人/Auto Man'], null, ['placeholder' => 'Choose channel...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {{Form::label('name', '* Subject', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('name', null, ['placeholder' => 'Enter subject...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>    

    <div class="form-group{{ $errors->has('shortContent') ? ' has-error' : '' }}">
      {{Form::label('shortContent', '* Summary', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('shortContent', null, ['placeholder' => 'Enter summary...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>    

    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
      {{Form::label('content', '* Content', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::textarea('content', null, ['placeholder' => 'Enter content...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
      {{Form::label('date', '* Display date', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('date', (new \Carbon\Carbon())->toDateString(), ['placeholder' => 'Enter display date (format: 2017-01-31)...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      {{Form::label('image', '* Cover image', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::file('image', null, ['placeholder' => 'Enter cover image...', 'class' => 'form-control','required' =>"true", 'id'=>'image'])}}
      </div>
    </div>


    <div class="form-group{{ $errors->has('radio') ? ' has-error' : '' }}">
      {{Form::label('radio', '* radio(mp3)', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::file('radio', null, ['placeholder' => 'Choose ...', 'class' => 'form-control','required' =>"true", 'id'=>'radio'])}}
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
      if(imgVal == '') 
      { 
        alert("Need cover image"); 
        continueInvoke = false; 
      } 

      var radioVal = $('#radio').val(); 
      if(radioVal == '') 
      { 
        alert("Need radio"); 
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
  {{link_to_action('RadioProgrameController@index', $title = 'Back', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

