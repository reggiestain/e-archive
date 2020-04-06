{!! Form::open(['route' => ['customFields.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('customFields.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('customFields.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return conformDel(this,event)"
    ]) !!}
</div>
{!! Form::close() !!}
