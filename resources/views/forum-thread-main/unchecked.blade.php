@extends('layouts.master')
<style>
.content-cell img{
  max-width: 480px;
}
</style>

<script language="JavaScript"> 
function autoRefresh() 
{ 
  window.location.reload(); 
} 
setTimeout('autoRefresh()',300000); //指定5分钟刷新一次 
</script> 

@section('content')
<h4>待审核主贴列表 
  <span class="label label-danger" style="padding-right: .6em;padding-left: .6em; border-radius: 10rem;">
  {{$uncheckedMains->count()}}
  </span>
</h4> 
<table class="table table-condensed table-hover">
  <tr>
    <td>标题</td>
    <td>内容</td>
    <td>日期</td>
    <td>操作</td>
  </tr>
  @forelse ($uncheckedMains as $item)
    <tr>
      <td>{{ $item->name }}</td>
      <td style='max-width: 500px;' class="content-cell">{!! strlen($item['content'])>0? $item['content'] : '【无内容】' !!}</td>
      <td>{{ $item->created_at->toDateString() }}</td>
      <td>
        {{ Form::open(['method' => 'DELETE', 'route' => ['Forum.destroy', $item->id ],'style'=>"display: inline-block;"]) }}
          {{ Form::hidden('id', $item->id) }}
          {{ Form::submit('删除', ['class' => 'btn btn-danger btn-xs']) }}
        {{ Form::close() }}

        {{link_to_action('ForumThreadMainController@checkMain', $title = '审核通过', $parameters = [$item->id], $attributes = ['class'=>"btn btn-success btn-xs"])}}
      </td>
    </tr>
  @empty
      <tr><td colspan=4>无数据</td></tr>
  @endforelse
</table>

<h4>待审核回贴列表 
  <span class="label label-danger" style="padding-right: .6em;padding-left: .6em; border-radius: 10rem;">
  {{$uncheckedReplies->count()}}
  </span>
</h4> 
<table class="table table-condensed table-hover">
  <tr>
    <td>内容</td>
    <td>日期</td>
    <td>操作</td>
  </tr>
  @forelse ($uncheckedReplies as $item)
    <tr>
      <td style='max-width: 500px;'>{!! strlen($item['content'])>0? $item['content'] : '【无内容】' !!}</td>
      <td>{{ $item->created_at->toDateString() }}</td>
      <td>
        {{ Form::open(['method' => 'DELETE', 'route' => ['Forum.destroyReply', $item->id ],'style'=>"display: inline-block;"]) }}
          {{ Form::hidden('id', $item->id) }}
          {{ Form::submit('删除', ['class' => 'btn btn-danger btn-xs']) }}
        {{ Form::close() }}

        {{link_to_action('ForumThreadMainController@checkReply', $title = '审核通过', $parameters = [$item->id], $attributes = ['class'=>"btn btn-success btn-xs"])}}
      </td>
    </tr>
  @empty
      <tr><td colspan=3>无数据</td></tr>
  @endforelse
</table>

@endsection