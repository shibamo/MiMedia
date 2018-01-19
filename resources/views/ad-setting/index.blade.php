@extends('layouts.master')
@section('content')
{{link_to_route('AdSetting.create', $title = '新建广告 / Create Ad', $parameters = [], $attributes = ['class'=>"btn btn-primary btn-lg", 'style'=>"margin-top: 5px; margin-bottom: 5px;"])}}
<table class="table table-condensed">
  <tr>
    <td>Location</td>
    {{--  <td>名称</td>  --}}
    <td>Display order</td>
    <td>Image</td>
    <td>Ad page link</td>
    <td>Start-End</td>
    <td>Account No</td>
    {{--  <td>维护人</td>  --}}
    <td>Memo</td>
    <td style='width: 100px;'>Operations</td>
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
        {{link_to_action('AdSettingController@edit', $title = 'Update', $parameters = [$item->id], $attributes = ['class'=>"btn btn-primary btn-xs"])}} | 
        <form action="{{route('AdSetting.destroy', ['id' => $item->id])}}" method="POST" style='display: inline;'>
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type=submit class="btn btn-danger btn-xs">Delete</button>
        </form>
      </td>
    </tr>
  @empty
      <tr><td colspan=3>No data</td></tr>
  @endforelse

</table>
@endsection