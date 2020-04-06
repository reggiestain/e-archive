@extends('layouts.app')
@section('title','New Custom Field')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-12" style="margin-bottom:20px">
                    <div class="page-header-title">
                        <i class="ik ik-menu bg-blue"></i>
                        <div class="d-inline">
                            <h5>Custom Field</h5>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-left">
                            <h5>
                                Custom Field
                            </h5>
                        </div>
                    </div>            
            <div class="card-body">
    <div class="content">
        <div class="box box-primary">

            <div class="box-body">
               
                    {!! Form::open(['route' => 'customFields.store']) !!}

                        @include('custom_fields.fields')

                    {!! Form::close() !!}
                </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
