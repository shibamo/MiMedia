@extends('layouts.master')

<style>
  .content-cell img{
    max-width: 480px;
  }
</style>

@section('content')
 标题: {{ $main['name'] }}
<table class="table table-condensed">
  <tr>
    <td>内容</td>
    <td style='width: 90px;'>日期</td>
    <td style='width: 100px;'>发帖人</td>
    <td>操作</td>
  </tr>
  <tr>
    <td class="content-cell">
    {{--  @foreach (explode("\n",$main['content']) as $content)  --}}
      {!! strlen($main['content'])>0? $main['content'] : '【无内容】' !!}
    {{--  @endforeach  --}}
    </td>
    <td>{{ $main['date'] }}</td>
    <td>{{ $main['authorName'] }}</td>
    <td>
     
      {{ Form::open(['method' => 'DELETE', 'route' => ['Forum.destroy',$main['id']],'style'=>"display: inline-block;"]) }}
        {{ Form::hidden('id', $main['id']) }}
        {{ Form::submit('删除主贴', ['class' => 'btn btn-danger btn-xs']) }}
      {{ Form::close() }}
    </td>
  </tr>  
  @foreach ($replies as $item)
    <tr>
      <td class="content-cell">
      @foreach (explode("\n",$item['content']) as $content)
        <p> >> {{ $content }}</p>
      @endforeach
      </td>    
      <td>{{ $item['date'] }}</td>
      <td>{{ $item['authorName'] }}</td>
      <td>
       
        {{ Form::open(['method' => 'DELETE', 
        'route' => ['Forum.destroyReply','threadReplyid' => $item['id']],'style'=>"display: inline-block;"]) }}
          {{ Form::hidden('id', $item['id']) }}
          {{ Form::submit('删除回复', ['class' => 'btn btn-danger btn-xs']) }}
        {{ Form::close() }}
      </td>
    </tr>
  @endforeach
</table>
{{link_to_action('ForumThreadMainController@index', $title = '返回: '. $board->caption, 
  $parameters = ['id'=> $board->id])}}<br>
@endsection