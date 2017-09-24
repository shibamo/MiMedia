<table class="table table-condensed">
  <tr>
    <td>标题</td>
    <td>日期</td>
    <td>回帖数</td>    
    <td>已审核?</td>             
    <td>已发布?</td>
    <td>操作</td>
  </tr>
  @forelse ($data as $item)
    <tr>
      <td>{{ $item->name }}</td>
      <td>{{ $item->created_at->toDateString() }}</td>
      <td>{{ $item->forumThreadReplies->count() }}</td>      
      <td>
        <span class='{{ $item->isChecked ? '' : 'label label-danger' }}'>{{ $item->isChecked ? '是' : '否' }}</span>
      </td>
      <td>
        <span class='{{ $item->isPublished ? '' : 'label label-danger' }}'>{{ $item->isPublished ? '是' : '否' }}</span>
      </td>
      <td>
        {{link_to_action('ForumThreadMainController@show', $title = '查看', $parameters = [$item->id], $attributes = ['class'=>"btn btn-primary btn-xs"])}}
        
        {{ Form::open(['method' => 'DELETE', 'route' => ['Forum.destroy',$item->id],'style'=>"display: inline-block;"]) }}
          {{ Form::hidden('id', $item->id) }}
          {{ Form::submit('删除', ['class' => 'btn btn-danger btn-xs']) }}
        {{ Form::close() }}

        @if(!$item->isChecked)
        {{link_to_action('ForumThreadMainController@checkMain', $title = '审核通过', $parameters = [$item->id], $attributes = ['class'=>"btn btn-warning btn-xs", 'target'=>'_blank'])}}
        @endif
      </td>
    </tr>
  @empty
      <tr><td colspan=6>无数据</td></tr>
  @endforelse

</table>
