@extends('layouts.master-webview')

<style>
  .content-cell img{
    max-width: 480px;
  }
</style>

@section('item-title'){{ $item->name }}@endsection
@section('meta-description'){{ $item->name }}@endsection

@section('content')
<h2>D Asian Media电视节目 - {{ $item->name }}</h2>
  <div class="form-horizontal">
    <hr />
    <div class="form-group{{ $errors->has('tv') ? ' has-error' : '' }}">
      <div class="col-md-12">
        <video controls="controls" width="100%" autoplay 
          src="{{ $resourceUrlPrefix . $item->url }}" ></audio>
      </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      <div class="col-md-12 content-cell">
        <img src="{{ $resourceUrlPrefix . $item->image}}">
      </div>
    </div>

    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
      <div class="col-md-12">
        {{$item->content}}
      </div>
    </div>

  </div>

@endsection

