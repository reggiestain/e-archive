{!! Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('users.show', $id) }}" class='btn btn-default btn-xs' data-toggle="tooltip" title="Show">
        <i class="fa fa-eye"></i>
    </a>
    @can('update users')
        <a href="{{ route('users.edit', $id) }}" class='btn btn-default btn-xs' title="Edit">
            <i class="fa fa-edit"></i>
        </a>
        <a href="{{ route('users.blockUnblock', $id) }}" class='btn btn-default btn-xs' title="Block/Unblock">
            <i class="fa fa-ban"></i>
        </a>
    @endcan
    @can('delete users')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'title' => 'Delete',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return conformDel(this,event)"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
