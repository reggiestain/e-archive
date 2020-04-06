@section('css')
    @include('layouts.datatables_css')
@endsection
<div class="table-responsive">
    {!! $dataTable->table(['width' => '100%', 'style'=>'margin:5px','class' => 'table table-striped table-bordered table-mini']) !!}
</div>
@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection
