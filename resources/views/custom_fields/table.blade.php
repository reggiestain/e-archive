@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['style'=>'margin:5px','width' => '100%', 'class' => 'table table-striped table-bordered table-mini']) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection