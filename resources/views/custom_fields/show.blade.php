@extends('layouts.app')
@section('title','Show Custom Field')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-4" style="margin-bottom:20px">
                    <div class="page-header-title">
                        <i class="fa fa-eye bg-blue"></i>
                        <div class="d-inline">
                            <h5>Custom Field</h5>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <!--<li class="breadcrumb-item">
                                <a href="../index.html"><i class="ik ik-home"></i></a>
                            </li>-->
                            <!--<li class="breadcrumb-item active" aria-current="page">Navbar</li>-->
                            <h1 class="pull-right">                               
            <span class="pull-right">
                <a href="{{ route('customFields.index') }}" class="btn btn-default">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
                </a>
                <a href="{{ route('customFields.edit',$customField->id) }}" class="btn btn-primary">
                    <i class="fa fa-edit" aria-hidden="true"></i> Edit
                </a>
                {!! Form::open(['route' => ['customFields.destroy', $customField->id], 'method' => 'delete','style'=>'display:inline']) !!}
                {!! Form::button('<i class="fa fa-trash"></i> Delete', [
                'type' => 'submit',
                'title' => 'Delete',
                'class' => 'btn btn-danger',
                'onclick' => "return conformDel(this,event)",
                ]) !!}
                {!! Form::close() !!}
            </span>
                            </h1>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
            <div class="card-body">
    <section class="content-header">
        <h1>
            
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('custom_fields.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
