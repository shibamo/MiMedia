@extends('layouts.master-webview')

<style>
  .content-cell img{
    max-width: 480px;
  }
</style>

@section('item-title'){{ $main['name'] }}@endsection
@section('meta-description'){{ $main['name'] }}@endsection

@section('content')
 标题: {{ $main['name'] }}
<table class="table table-condensed">
  <tr>
    <td>内容</td>
    <td style='width: 90px;'>日期</td>
    <td style='width: 100px;'>发帖人</td>
  </tr>
  <tr>
    <td class="content-cell">
    {{--  @foreach (explode("\n",$main['content']) as $content)  --}}
      {!! strlen($main['content'])>0? $main['content'] : '【无内容】' !!}
    {{--  @endforeach  --}}
    </td>
    <td>{{ $main['date'] }}</td>
    <td>{{ $main['authorName'] }}</td>
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
    </tr>
  @endforeach
</table>
@endsection