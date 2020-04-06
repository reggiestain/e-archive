@extends('layouts.app')
@section('title',"Edit ".ucfirst(config('settings.document_label_singular')))
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-header-title">
                        <i class="fa fa-folder bg-blue"></i>
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
                               
                   {!! Form::model($document, ['route' => ['documents.update', $document->id], 'method' => 'patch']) !!}

                        @include('documents.fields')

                   {!! Form::close() !!}
               
            </div>
        </div>
    </div>
@endsection
