@extends('layouts.app')
@section('title',"Add ".ucfirst(config('settings.document_label_singular')))
@section('css')
<style type="text/css">
.btn-default {
    background-color: #f4f4f4;
    color: #444;
    border-color: #ddd;
}
</style>
@stop
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-header-title">
                        <i class="fa fa-folder bg-red"></i>
                        <div class="d-inline">
                            <h5>{{ucfirst(config('settings.document_label_singular'))}}</h5>
                            <span></span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-lg-12 col-md-12">
                        <div class="card">  
                            <div class="card-body">
                                <div class="row"> 
                                             
                    {!! Form::open(['route' => 'documents.store']) !!}
                        @include('documents.fields',['document'=>null])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
