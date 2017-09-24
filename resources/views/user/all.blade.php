@extends('layouts.master')
@section('content')
  <h4>所有用户列表</h4> 
<table class="table table-condensed table-striped table-bordered">
  <tr>
    <th>编号</th>
    <th>用户名</th>
    <th>邮箱</th>
    <th>管理员?</th>
    <th>编辑?</th>
    <th>审核?</th>
    <th>广告管理?</th>
    <th class="text-primary">广告客户?</th>          
    <th>创建时间</th>
    <th>操作</th>
  </tr>

  @foreach ($users as $item)
    <tr>
      <td>
        {{$item->id}}
      </td>
      <td>
        {{$item->name}}
      </td>
      <td>
        {{$item->email}}
      </td>
      <td>
        {{$item->isSystemManager ? 'X' : ''}}
      </td>
      <td>
        {{$item->isEditor ? 'X' : ''}}
      </td>
      <td>
        {{$item->isAuditor ? 'X' : ''}}
      </td>
      <td>
        {{$item->isADManager ? 'X' : ''}}
      </td>     
      <td>
        {{$item->isADClient ? 'X' : ''}}
      </td>              
      <td>
        {{$item->created_at->toDateString()}}
      </td>
      <td>
        {{ link_to_route('User.adjustType', $title = '调整类型', 
        $parameters = ['id'=> $item->id]) }}
      </td>
    </tr>
  @endforeach
</table>

{{ $users->links() }}
@endsection