<table class="table table-condensed">
  <tr>
    <td>Subject</td>
    <td>Date</td>
    <td>Checked?</td>             
    <td>Published?</td>
    <td>Operations</td>
  </tr>
  @forelse ($data as $item)
    <tr>
      <td>{{ $item->name }}</td>
      <td>{{ $item->date }}</td>
      <td>{{ $item->isChecked ? 'Y' : 'N' }}</td>
      <td>{{ $item->isPublished ? 'Y' : 'N' }}</td>
      <td>
        {{link_to_action('TvProgrameController@show', $title = 'Show', $parameters = [$item->id], $attributes = ['class'=>"btn btn-primary btn-xs"])}}
        
        {{ Form::open(['method' => 'DELETE', 'route' => ['TvPrograme.destroy',$item->id],'style'=>"display: inline-block;"]) }}
          {{ Form::hidden('id', $item->id) }}
          {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) }}
        {{ Form::close() }}
      </td>
    </tr>
  @empty
      <tr><td colspan=5>No Data</td></tr>
  @endforelse

</table>