@extends('layouts.app')
@section('title','List '.ucfirst(config('settings.tags_label_plural')))
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8" style="margin-bottom:20px">
                    <div class="page-header-title">
                        <i class="fa fa-tags bg-red"></i>
                        <div class="d-inline">
                            {{--<h5>{{ucfirst(config('settings.tags_label_plural'))}}</h5>--}}
                            <h5>Tags</h5>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <!--<li class="breadcrumb-item">
                                <a href="../index.html"><i class="ik ik-home"></i></a>
                            </li>-->
                            <!--<li class="breadcrumb-item active" aria-current="page">Navbar</li>-->
                            <h1 class="pull-right">
                            @can('create tags')
                               <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
                               href="{!! route('tags.create') !!}">
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
            <div class="col-lg-12 col-md-12 file-row file-row-@{{index}}">
                <div class="card">
            <div class="card-body">
                <div class="row">   
                    <div class="col-lg-12">  
                        @include('flash::message')
                    </div>  
                </div> 
                <div class="row align-items-center">
                 @include('flash::message')
                @include('tags.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection

