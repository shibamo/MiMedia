@extends('layouts.master')
@section('content')
{{link_to_route('AdSetting.create', $title = '新建广告', $parameters = [], $attributes = ['class'=>"btn btn-primary btn-lg", 'style'=>"margin-top: 5px; margin-bottom: 5px;"])}}
<table class="table table-condensed">
  <tr>
    <td>位置</td>
    {{--  <td>名称</td>  --}}
    <td>序号</td>
    <td>图片</td>
    <td>内容页地址</td>
    <td>起止日期</td>
    <td>客户号</td>
    {{--  <td>维护人</td>  --}}
    <td>备注</td>
    <td style='width: 100px;'>操作</td>
  </tr>
  @forelse ($data as $item)
    <tr>
      <td>{{ $item->name }}</td>
      {{--  <td>{{ $item->caption }}</td>  --}}
      <td><span class="badge progress-bar-danger">{{ $item->displayOrder }}</span></td>
      <td><img src='{{ $resourceUrlPrefix . $item->imageUrl }}' style='max-width: 300px; border: rgb(128, 128, 128) dotted;'> </td>
      <td>{{ $item->contentUrl }}</td>
      <td>
        {{ $item->startFrom->toDateString() }} : 
        <strong class="{{ $item->endTo && $item->endTo->lte(new \Carbon\Carbon()) ? 'text-danger' : 'text-success'  }} ">{{ $item->endTo ? $item->endTo->toDateString() : ''  }}</strong>
      </td>
      {{--  <td>{{ $item->maintainerId }}</td>  --}}
      <td>{{ $item->customerId }}</td>
      <td>{{ $item->memo }}</td>      
      <td>
        {{link_to_action('AdSettingController@edit', $title = '修改', $parameters = [$item->id], $attributes = ['class'=>"btn btn-primary btn-xs"])}} | 
        <form action="{{route('AdSetting.destroy', ['id' => $item->id])}}" method="POST" style='display: inline;'>
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type=submit class="btn btn-danger btn-xs">删除</button>
        </form>
      </td>
    </tr>
  @empty
      <tr><td colspan=3>无数据</td></tr>
  @endforelse

</table>
@endsection