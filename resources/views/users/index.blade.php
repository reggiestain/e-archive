@extends('layouts.app')
@section('title','Users List')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8" style="margin-bottom:20px">
                    <div class="page-header-title">
                        <i class="fa fa-tags bg-blue"></i>
                        <div class="d-inline">
                            <h5>Users</h5>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <h1 class="pull-right">
                                @can('create users')
                                <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
                                   href="{!! route('users.create') !!}">
                                    <i class="fa fa-plus"></i>
                                    Add New
                                </a>
                            @endcan
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
    <div class="content">
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                @include('users.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection

