@extends('layouts.master')

@section('content')
<h2>Create TV program</h2>
{{Form::open(['action' => 'TvProgrameController@store', 'files' => true, 'autocomplete' => 'off',])}}
  <div class="form-horizontal">
    <hr />

    <div class="form-group{{ $errors->has('tvChannelId') ? ' has-error' : '' }}">
      {{Form::label('tvChannelId', '* Channel', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::select('tvChannelId', ['1' => '新闻/News', '2' => '娱乐/Entertainment', '3' => '汽车人/Auto Man'], null, ['placeholder' => 'Choose channel...', 'class' => 'form-control','required' =>"true"])}}
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
        {{Form::text('date',  (new \Carbon\Carbon())->toDateString(), ['placeholder' => 'Enter display date (format: 2017-01-31)...', 'class' => 'form-control','required' =>"true"])}}
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      {{Form::label('image', '* Cover image', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::file('image', null, ['placeholder' => 'Enter cover image...', 'class' => 'form-control','required' =>"true", 'id'=>'image'])}}
      </div>
    </div>


    <div class="form-group{{ $errors->has('tv') ? ' has-error' : '' }}">
      {{Form::label('tv', '* video(mp4)', ['class' => 'col-md-2 control-label'])}}

      <div class="col-md-10">
        {{Form::file('tv', null, ['placeholder' => 'Choose ...', 'class' => 'form-control','required' =>"true", 'id'=>'tv'])}}
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

      var tvVal = $('#tv').val(); 
      if(tvVal=='') 
      { 
          alert("Need video"); 
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
  {{link_to_action('TvProgrameController@index', $title = 'Back', $parameters = [], $attributes = ['class'=>"btn btn-link"])}}
</div>
@endsection

