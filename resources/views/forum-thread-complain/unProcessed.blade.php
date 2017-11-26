@extends('layouts.master')
<style>
.content-cell img{
  max-width: 480px;
}
</style>

<script language="JavaScript"> 
  {{--  指定5分钟刷新一次   --}}
  function autoRefresh() 
  { 
    window.location.reload(); 
  } 
  setTimeout('autoRefresh()',300000); 
</script>

@section('content')
<h4>主贴待处理被投诉列表 
  <span class="label label-danger" style="padding-right: .6em;padding-left: .6em; border-radius: 10rem;">
  {{$mainComplains->count()}}
  </span>
</h4> 
<table class="table table-condensed table-hover">
  <tr>
    <td>原帖标题</td>
    <td>原帖内容</td>
    <td>投诉内容</td>
    <td>投诉日期</td>
    <td>操作</td>
  </tr>
  @forelse ($mainComplains as $item)
    <tr>
      <td>{{ $item->forumThreadMain->name }}</td>
      <td style='max-width: 240px;' class="content-cell">{!! strlen($item->forumThreadMain['content'])>0? $item->forumThreadMain['content'] : '【无内容】' !!}</td>      
      <td style='max-width: 240px; color: red;' class="content-cell">{!! strlen($item['complainContent'])>0? $item['complainContent'] : '【无内容】' !!}</td>
      <td>{{ $item->created_at->toDateString() }}</td>
      <td>
        {{ Form::open(['method' => 'DELETE', 'route' => ['ForumComplain.destroyMain', $item->id ],'style'=>"display: inline-block;"]) }}
          {{ Form::hidden('id', $item->id) }}
          {{ Form::hidden('memo', "无效投诉") }}
          {{ Form::submit('无效投诉', ['class' => 'btn btn-danger btn-xs']) }}
        {{ Form::close() }}

        {{link_to_action('ForumThreadComplainController@showMain', $title = '处理投诉', $parameters = [$item->id], $attributes = ['class'=>"btn btn-success btn-xs"])}}
      </td>
    </tr>
  @empty
      <tr><td colspan=5 style='text-align: center;'>无数据</td></tr>
  @endforelse
</table>

<h4>回贴待处理被投诉列表
  <span class="label label-danger" style="padding-right: .6em;padding-left: .6em; border-radius: 10rem;">
  {{$replyComplains->count()}}
  </span>
</h4> 
<table class="table table-condensed table-hover">
  <tr>
    <td>原帖内容</td>
    <td>投诉内容</td>
    <td>投诉日期</td>
    <td>操作</td>
  </tr>
  @forelse ($replyComplains as $item)
    <tr>
      <td style='max-width: 240px;'>{!! strlen($item->forumThreadReply['content'])>0? $item->forumThreadReply['content'] : '【无内容】' !!}</td>
      <td style='max-width: 240px; color: red;' class="content-cell">{!! strlen($item['complainContent'])>0? $item['complainContent'] : '【无内容】' !!}</td>      
      <td>{{ $item->created_at->toDateString() }}</td>
      <td>
        {{ Form::open(['method' => 'DELETE', 'route' => ['ForumComplain.destroyReply', $item->id ],'style'=>"display: inline-block;"]) }}
          {{ Form::hidden('id', $item->id) }}
          {{ Form::hidden('memo', "无效投诉") }}
          {{ Form::submit('无效投诉', ['class' => 'btn btn-danger btn-xs']) }}
        {{ Form::close() }}

        {{link_to_action('ForumThreadComplainController@showReply', $title = '处理投诉', $parameters = [$item->id], $attributes = ['class'=>"btn btn-success btn-xs"])}}
      </td>
    </tr>
  @empty
      <tr><td colspan=4 style='text-align: center;'>无数据</td></tr>
  @endforelse
</table>

@endsection