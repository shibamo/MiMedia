@extends('layouts.master')

@section('content')
<h2>Create Live program</h2>
{{Form::open(['action' => 'LiveProgrameController@store', 'files' => true, 'autocomplete' => 'off',])}}
  <div class="form-horizontal">
    <hr />

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {{Form::label('name', '* Subject', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('name', null, ['placeholder' => 'Enter subject...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>    

    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
      {{Form::label('date', '* Display date', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('date',  (new \Carbon\Carbon())->toDateString(), ['placeholder' => 'Enter display date (format: 2017-01-31)...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      {{Form::label('image', '* Cover image', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::file('image', null, ['placeholder' => 'Enter cover image...', 'class' => 'form-control','required' =>"true", 'id'=>'image'])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('youtube') ? ' has-error' : '' }}">
      {{Form::label('youtube', 'Youtube link', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::text('youtubeLink', null, ['placeholder' => 'Enter Youtube link (https://www.youtube.com/watch?v=******)...', 'class' => 'form-control','id'=>'youtubeLink'])}}
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
    $("form").submit(function(e){
      var continueInvoke = true;

      var imgVal = $('#image').val(); 
      if(imgVal=='') 
      { 
          alert("Need cover image"); 
          continueInvoke = false; 
      } 
      
      var youtubeLinkVal = $('#youtubeLink').val(); 
      var isYoutubeLinkValid = youtubeLinkVal.startsWith("https://www.youtube.com/watch?v=");

      if(!isYoutubeLinkValid) 
      { 
          alert("Need valid Youtube link(https://www.youtube.com/watch?v=******)"); 
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
  {{link_to_action('LiveProgrameController@index', $title = 'Back', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

