@extends('layouts.app')
@section('title','Show User')
section('css')
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
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-4" style="margin-bottom:20px">
                    <div class="page-header-title">
                        <h1>
                        Users
                        </h1>
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
                                <a href="{{ route('users.index') }}" class="btn btn-default">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
                                </a>
                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                </a>
                                <a href="{{ route('users.blockUnblock', $user->id) }}" class="btn btn-warning">
                                    <i class="fa fa-ban"></i> Block / Unblock
                                </a>
                                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete','style'=>'display:inline']) !!}
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
        <div class="row">
            <div class="col-sm-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#user" data-toggle="tab"
                                              aria-expanded="true">User</a>
                        </li>
                        @can('user manage permission')
                            <li class=""><a href="#tab_permissions" data-toggle="tab"
                                            aria-expanded="false">Permission</a>
                            </li>
                        @endcan
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="user">
                            @include('users.show_fields')
                        </div>
                        @can('user manage permission')
                            <div class="tab-pane" id="tab_permissions">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="3"
                                        style="font-size: 1.8rem;">Global Permissions
                                    </th>
                                </tr>
                                <tr>
                                    <th>Module</th>
                                    <th>Permissions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($user->hasAnyPermission(array_keys(config('constants.GLOBAL_PERMISSIONS.USERS'))) || $user->hasAnyPermission(array_keys(config('constants.GLOBAL_PERMISSIONS.TAGS'))) || $user->hasAnyPermission(array_keys(config('constants.GLOBAL_PERMISSIONS.DOCUMENTS'))))
                                    @foreach ($globalPermissions as $key=>$p)
                                        <tr>
                                            <td>
                                                {{$key}}
                                            </td>
                                            <td>
                                                @foreach ($p['permissions']??[] as $perm)
                                                    <label class="label label-default">{{$perm}}</label>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2">No record found</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="3"
                                        style="font-size: 1.8rem;">{{ucfirst(config('settings.document_label_plural'))}} {{config('settings.tags_label_singular')}}
                                        wise permissions
                                    </th>
                                </tr>
                                <tr>
                                    <th>{{ucfirst(config('settings.tags_label_singular'))}}</th>
                                    <th>Permissions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($tags)==0)
                                    <tr>
                                        <td colspan="2">No record found</td>
                                    </tr>
                                @endif
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>
                                            {{$tag->name}}
                                        </td>
                                        <td>
                                            @foreach(config('constants.TAG_LEVEL_PERMISSIONS') as $perm_key=>$perm)
                                                @if ($user->can($perm_key.$tag->id))
                                                    <label class="label label-default">{{$perm}}</label>
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="3"
                                        style="font-size: 1.8rem;">{{ucfirst(config('settings.document_label_singular'))}}
                                        wise permissions
                                    </th>
                                </tr>
                                <tr>
                                    <th>{{ucfirst(config('settings.document_label_singular'))}}</th>
                                    <th>Permissions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($documents)==0)
                                    <tr>
                                        <td colspan="2">No record found</td>
                                    </tr>
                                @endif
                                @foreach($documents as $document)
                                    <tr>
                                        <td>
                                            {{$document->name}}
                                        </td>
                                        <td>
                                            @foreach(config('constants.DOCUMENT_LEVEL_PERMISSIONS') as $perm_key=>$perm)
                                                @if ($user->can($perm_key.$document->id))
                                                    <label class="label label-default">{{$perm}}</label>
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
</div>
</div>
@endsection
