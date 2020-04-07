@extends('layouts.app')
@section('title','Show '.ucfirst(config('settings.tags_label_singular')))
@section('css')
<style>
       .box-body {
          border-top-left-radius: 0;
          border-top-right-radius: 0;
          border-bottom-right-radius: 3px;
          border-bottom-left-radius: 3px;
          padding: 10px;
        }
        .nav-tabs-custom>.tab-content {
    background: #fff;
    padding: 10px;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
}
.nav-tabs-custom>.nav-tabs>li:first-of-type.active>a {
    border-left-color: transparent;
}
.nav-tabs-custom>.nav-tabs>li.active>a {
    border-top-color: transparent;
    border-left-color: #f4f4f4;
    border-right-color: #f4f4f4;
}
.nav-tabs-custom>.nav-tabs>li.active>a, .nav-tabs-custom>.nav-tabs>li.active:hover>a {
    background-color: #fff;
    color: #444;
}
.nav-tabs-custom>.nav-tabs>li>a, .nav-tabs-custom>.nav-tabs>li>a:hover {
    background: transparent;
    margin: 0;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
}
.nav>li>a {
    position: relative;
    display: block;
    padding: 10px 15px;
}
a:hover, a:active, a:focus {
    outline: none;
    text-decoration: none;
    color: #8bc8f9;
}
.nav-tabs-custom>.nav-tabs>li:first-of-type {
    margin-left: 0;
}
.nav-tabs-custom>.nav-tabs>li.active {
    border-top-color: #42a5f5;
}
.nav-tabs-custom>.nav-tabs>li {
    border-top: 3px solid transparent;
    margin-bottom: -2px;
    margin-right: 5px;
}
.nav>li {
    position: relative;
    display: block;
}
.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 3px 0 rgba(0,0,0,0.1), 0 1px 2px 0 rgba(0,0,0,0.06);
}
.box.custom-box .box-header {
    background-color: #3c8dbc;
    color: #fff;
    padding: 3px 5px;
}
.table>thead>tr>th {
    border-bottom: 2px solid #f4f4f4;
    background-color: #fff;
    color:#000;
    font-weight: 500;
}
</style>    
   
@endsection
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-6" style="margin-bottom:20px">
                    <div class="page-header-title">
                        <i class="fa fa-tags bg-red"></i>
                        <div class="d-inline">
                            {{--<h5>{{ucfirst(config('settings.tags_label_plural'))}}</h5>--}}
                            <h5>Regions</h5>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <!--<li class="breadcrumb-item">
                                <a href="../index.html"><i class="ik ik-home"></i></a>
                            </li>-->
                            <!--<li class="breadcrumb-item active" aria-current="page">Navbar</li>-->
                            <h1 class="pull-right">
                                <a href="{{ route('tags.index') }}" class="btn btn-default">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
                                </a>
                                <a href="{{ route('tags.edit',$tag->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                </a>
                                {!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'delete','style'=>'display:inline']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i> Delete', [
                                    'type' => 'submit',
                                    'title' => 'Delete',
                                    'class' => 'btn btn-danger',
                                    'onclick' => "return conformDel(this,event)",
                                    ]) !!}
                                    {!! Form::close() !!}
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
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tag" data-toggle="tab"
                                      aria-expanded="true">{{ucfirst(config('settings.tags_label_singular'))}}</a>
                </li>
                @can('user manage permission')
                    <li class=""><a href="#tab_permissions" data-toggle="tab"
                                    aria-expanded="false">Permission</a>
                    </li>
                @endcan
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tag">
                    @include('tags.show_fields')
                </div>
                @can('user manage permission')
                    <div class="tab-pane" id="tab_permissions">
                        <div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="3" style="font-size: 1.8rem;">{{ucfirst(config('settings.document_label_plural'))}} permissions in this {{config('settings.tags_label_singular')}}</th>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <th>Permissions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($tagWisePermList)==0)
                                    <tr>
                                        <td colspan="3">No record found</td>
                                    </tr>
                                @endif
                                @foreach ($tagWisePermList as $perm)
                                    <tr>
                                        <td>{{$perm['user']->name}}</td>
                                        <td>
                                            @foreach ($perm['permissions'] as $p)
                                                <label class="label label-default">{{$p}}</label>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="3" style="font-size: 1.8rem;">Permission inherited from global {{config('settings.document_label_plural')}}</th>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <th>Permissions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($globalPermissionUsers)==0)
                                    <tr>
                                        <td colspan="2">No record found</td>
                                    </tr>
                                @endif
                                @foreach ($globalPermissionUsers as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>
                                            @foreach(config('constants.GLOBAL_PERMISSIONS.DOCUMENTS') as $perm_key=>$value)
                                                @if ($user->can($perm_key))
                                                    <label class="label label-default">{{$value}}</label>
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endcan
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
