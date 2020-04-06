@section('css')
    @include('layouts.datatables_css')
@endsection
<div class="col-lg-12">
{!! $dataTable->table(['width' => '100%','class' => 'table table-striped table-bordered table-mini','style'=>'margin:5px']) !!}
</div>
@section('scripts')
            @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection
