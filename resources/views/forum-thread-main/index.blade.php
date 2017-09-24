@extends('layouts.master')
@section('content')
  <h4>论坛列表</h4> 
  <div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      @foreach ($boards as $board)
        <li role="presentation" class="{{ $board->id == $activeBoardId ? 'active' : '' }}">
          <a href="#{{$board->name}}" aria-controls="{{$board->name}}" role="tab" data-toggle="tab">
            {{$board->caption}}
          </a>
        </li>
      @endforeach
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      @foreach ($boards as $board)
        <div role="tabpanel" class="tab-pane {{ $board->id == $activeBoardId ? 'active' : '' }}" id="{{$board->name}}"> 
          @include('forum-thread-main._thread_list', ['data' => $board->forumThreadMains->sortByDesc('created_at')->take(100)])
        </div>
      @endforeach
    </div>

  </div>  
@endsection