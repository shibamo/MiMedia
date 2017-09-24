<table class="table table-condensed">
  <tr>
    <td>标题</td>
    <td>日期</td>
    <td>已审核?</td>             
    <td>已发布?</td>
    <td>操作</td>
  </tr>
  @forelse ($data as $item)
    <tr>
      <td>{{ $item->name }}</td>
      <td>{{ $item->date }}</td>
      <td>{{ $item->isChecked ? '是' : '否' }}</td>
      <td>{{ $item->isPublished ? '是' : '否' }}</td>
      <td>
        {{link_to_action('RadioProgrameController@show', $title = '查看', $parameters = [$item->id], $attributes = ['class'=>"btn btn-primary btn-xs"])}}
        
        {{ Form::open(['method' => 'DELETE', 'route' => ['RadioPrograme.destroy',$item->id],'style'=>"display: inline-block;"]) }}
          {{ Form::hidden('id', $item->id) }}
          {{ Form::submit('删除', ['class' => 'btn btn-danger btn-xs']) }}
        {{ Form::close() }}
      </td>
    </tr>
  @empty
      <tr><td colspan=5>无数据</td></tr>
  @endforelse

</table>