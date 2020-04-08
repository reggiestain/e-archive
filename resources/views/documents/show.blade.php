@extends('layouts.app')
@section('title',"Show ".ucfirst(config('settings.document_label_singular')))
@section('css')
    <style>
        .box.custom-box {
            border: 1px solid #3c8dbc;
            box-shadow: 0 1px 2px 1px rgba(0, 0, 0, 0.08)
        }

        .box.custom-box .box-header {
            background-color: #3c8dbc;
            color: #fff;
            padding: 3px 5px;
        }

        .custom-box .user-block > .username, .custom-box .user-block > .description {
            margin-left: 0;
        }

        .custom-box .box-body img {
            height: 145px;
            object-fit: contain;
            width: 100%;
            border-radius: 3px;
        }

        object.obj-file-box {
            height: 80vh;
            object-fit: contain;
            width: 100%;
            border: 1px solid rgba(0, 40, 100, 0.2);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .img-d-select .icheckbox_square-blue{
            position: absolute;
            right: 0;
            top: 0;
        }

        #sticky_footer {
            position: fixed;
            bottom: -4px;
            right: 10px;
        }
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
@stop
@section('scripts')
    <script src="https://cdn.scaleflex.it/plugins/filerobot-image-editor/3/filerobot-image-editor.min.js"></script>
    <script id="file-modal-template" type="text/x-handlebars-template">
        <div id="fileModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">@{{name}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-3">
                            <div class="form-group">
                                <a href="{{\Illuminate\Support\Str::finish(route('files.showfile',['dir'=>'original']),"/")}}@{{file}}?force=true"
                                   download class="btn btn-primary"><i
                                        class="fa fa-download"></i> Download original
                                </a>
                            </div>
                            <div class="form-group">
                                <label>{{ucfirst(config('settings.file_label_singular'))." Type"}}</label>
                                <p>@{{file_type.name}}</p>
                            </div>
                            <div class="form-group">
                                <label>Uploaded By:</label>
                                <p>
                                    @{{created_by.name}}
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Uploaded On:</label>
                                <p>@{{formatDate created_at}}</p>
                            </div>
                            @{{#each custom_fields}}
                            <div class="form-group">
                                <label>@{{titleize @key}}</label>
                                <p>@{{this}}</p>
                            </div>
                            @{{/each}}
                        </div>
                        <div class="col-md-9">
                            <div class="file-modal-preview">
                                <object class="obj-file-box" classid=""
                                        data="{{\Illuminate\Support\Str::finish(route('files.showfile',['dir'=>'original']),"/")}}@{{file}}">
                                </object>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>
                            Close
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </script>
    <script>
        const ImageEditor = new FilerobotImageEditor();

        function showFileModal(data) {
            var template = Handlebars.compile($("#file-modal-template").html());
            var html = template(data);
            $("#modal-space").html(html);
            $("#fileModal").modal('show');

        }

        function submitPdfForm(varient){
            $("input[name='images_varient']").val(varient);
            $("#frm_image2pdf").submit();
        }

        $(function () {
            $("input[name='topdf_check[]']").on('ifToggled', function(event){
                var selectedValues = $("input[name='topdf_check[]']:checked").map(function(){
                    return $(this).val();
                }).toArray();
                if(selectedValues.length>0){
                    $("#sticky_footer").show();
                }else{
                    $("#sticky_footer").hide();
                }
                $("input[name='images']").val(selectedValues.join());
            });
            $("input[name='topdf_check[]']").trigger('ifToggled');
        });
    </script>
@stop
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-6">
                    <div class="page-header-title">
                        <i class="fa fa-folder bg-red"></i>
                        <div class="d-inline">                            
                            <h5>{{ucfirst(config('settings.document_label_singular'))}}</h5>
                            <span><small>{{$document->name}}</small></span>
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
                            <h1 class="pull-right" style="margin-bottom: 5px;">
                                <div class="dropdown" style="display: inline-block">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i
                                            class="fa fa-download"></i> Download Zip
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{route('files.downloadZip',['dir'=>'all','id'=>$document->id])}}">All</a>
                                        </li>
                                        <li>
                                            <a href="{{route('files.downloadZip',['dir'=>'original','id'=>$document->id])}}">Original</a>
                                        </li>
                                        @foreach (explode(",",config('settings.image_files_resize')) as $varient)
                                            <li>
                                                <a href="{{route('files.downloadZip',['dir'=>$varient,'id'=>$document->id])}}">{{$varient}}w
                                                    (Images Only)
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @can('edit', $document)
                                    <a href="{{route('documents.edit', $document->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i>
                                        Edit
                                    </a>
                                @endcan
                                @can('delete', $document)
                                    {!! Form::open(['route' => ['documents.destroy', $document->id], 'method' => 'delete', 'style'=>'display:inline;']) !!}
                                    <button class="btn btn-danger" onclick="conformDel(this,event)" type="submit"><i
                                            class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                    {!! Form::close() !!}
                                @endcan
                            </h1>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
            
    <div id="modal-space">
    </div>
        @include('flash::message')

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-sm-3">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{ucfirst(config('settings.document_label_singular'))}} Name:</label>
                            <p>{{$document->name}}</p>
                        </div>
                        <div class="form-group">
                            {{--<label>{{ucfirst(config('settings.tags_label_plural'))}}:</label>--}}
                            <label>Region:</label>
                            <p>
                                @foreach ($document->tags as $tag)
                                    <small class="label"
                                           style="background-color: {{$tag->color}};">{{$tag->name}}</small>
                                @endforeach
                            </p>
                        </div>
                        @foreach ($document->custom_fields??[] as $custom_field_name=>$custom_field_value)
                            <div class="form-group">
                                {!! Form::label($custom_field_name, Str::title(str_replace('_',' ',$custom_field_name)).":") !!}
                                <p>{{ $custom_field_value }}</p>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label>Description:</label>
                            <p>{!! $document->description !!}</p>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            @if ($document->status==config('constants.STATUS.PENDING'))
                                <span class="label label-warning">{{$document->status}}</span>
                            @elseif($document->status==config('constants.STATUS.APPROVED'))
                                <span class="label label-success">{{$document->status}}</span>
                            @else
                                <span class="label label-danger">{{$document->status}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Created By:</label> {{$document->createdBy->name}}
                        </div>
                        <div class="form-group">
                            <label>Created At:</label>
                            <p>{!! formatDateTime($document->created_at) !!} <br>
                                ({{\Carbon\Carbon::parse($document->created_at)->diffForHumans()}})
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Last Updated:</label>
                            <p>{!! formatDateTime($document->updated_at) !!} <br>
                                ({{\Carbon\Carbon::parse($document->updated_at)->diffForHumans()}})
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_files" data-toggle="tab"
                                              aria-expanded="true">{{ucfirst(config('settings.file_label_plural'))}}</a>
                        </li>
                        @can('verify', $document)
                            <li class=""><a href="#tab_verification" data-toggle="tab"
                                            aria-expanded="false">Verification</a></li>
                        @endcan
                        <li class=""><a href="#tab_activity" data-toggle="tab" aria-expanded="false">Activity</a></li>
                        @can('user manage permission')
                            <li class=""><a href="#tab_permissions" data-toggle="tab"
                                            aria-expanded="false">Permission</a>
                            </li>
                        @endcan
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_files">
                            @if (config('settings.show_missing_files_errors')=='true' && $document->status!=config('constants.STATUS.APPROVED') && count($missigDocMsgs)!=0) 
                                <div class="alert alert-danger fade in alert-dismissible">
                                    <button class="close" data-dismiss="alert" aria-label="close" title="close">
                                        &times;
                                    </button>
                                    <strong>The Following {{ucfirst(config('settings.file_label_plural'))}} Are
                                        Missing:</strong>
                                    <ul style="padding-inline-start: 20px;">
                                        @foreach ($missigDocMsgs as $msg)
                                            <li>{{$msg}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                @foreach ($document->files->sortBy('file_type_id') as $file)
                                    <div class="col-xs-6 col-md-6 col-lg-4">
                                        <div class="box custom-box">
                                            <div class="box-body">
                                                @if (checkIsFileIsImage($file->file))
                                                    <span class="img-d-select">
                                                    <input type="checkbox" value="{{$file->file}}" name="topdf_check[]" class="iCheck-helper"/>
                                                </span>
                                                @endif
                                                <img onclick="showFileModal({{json_encode($file)}})"
                                                     style="cursor:pointer;"
                                                     src="{{buildPreviewUrl($file->file)}}"
                                                     alt="">
                                            </div>
                                            <div class="box-header">
                                                <div class="user-block">
                                                    <span class="label label-default">{{$file->fileType->name}}</span>
                                                    <span class="username" style="cursor:pointer;"
                                                          onclick="showFileModal({{json_encode($file)}})">{{$file->name}}</span>
                                                    <small class="description text-gray"><b
                                                            title="{{formatDateTime($file->created_at)}}"
                                                            data-toggle="tooltip">{{\Carbon\Carbon::parse($file->created_at)->diffForHumans()}}</b>
                                                        by <b>{{$file->createdBy->name}}</b></small>
                                                </div>
                                                <div class="pull-right box-tools">
                                                    <button type="button"
                                                            class="btn btn-default btn-flat dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"
                                                            style="    background: transparent;border: none;">
                                                        <i class="fa fa-ellipsis-v" style="color: #fff;"></i>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="javascript:void(0);"
                                                               onclick="showFileModal({{json_encode($file)}})">Show
                                                                Detail</a></li>
                                                        <li>
                                                            <a href="{{route('files.showfile',['dir'=>'original','file'=>$file->file])}}?force=true"
                                                               download>Download
                                                                original</a>
                                                        </li>
                                                        @if (checkIsFileIsImage($file->file))
                                                            @foreach (explode(",",config('settings.image_files_resize')) as $varient)
                                                                <li>
                                                                    <a href="{{route('files.showfile',['dir'=>$varient,'file'=>$file->file])}}?force=true"
                                                                       download>Download {{$varient}}w</a></li>
                                                            @endforeach
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                   onclick="javascript:ImageEditor.open('{{route('files.showfile',['dir'=>'original','file'=>$file->file])}}')">
                                                                    Edit Image
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            {!! Form::open(['route' => ['documents.files.destroy', $file->id], 'method' => 'delete', 'style'=>'display:inline;']) !!}
                                                            <button class="btn btn-link"
                                                                    onclick="conformDel(this,event)" type="submit">
                                                                Delete
                                                            </button>
                                                            {!! Form::close() !!}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @can('update', [$document, $document->tags->pluck('id')])
                                <a href="{{route('documents.files.create',$document->id)}}"
                                   class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                    Add {{ucfirst(config('settings.file_label_plural'))}}</a>
                            @endcan
                        </div>
                        @can('verify', $document)
                            <div class="tab-pane" id="tab_verification">
                               @if ($document->status!=config('constants.STATUS.APPROVED'))
                                    {!! Form::open(['route' => ['documents.verify', $document->id], 'method' => 'post']) !!}
                                    <div class="form-group text-center">
                                    <textarea class="form-control" name="vcomment" id="vcomment" rows="4"
                                              placeholder="Enter Comment to verify with comment(optional)"></textarea>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-success" type="submit" name="action" value="approve"><i
                                                class="fa fa-check"></i> Approve
                                        </button>
                                        <button class="btn btn-danger" type="submit" name="action" value="reject"><i
                                                class="fa fa-close"></i> Reject
                                        </button>
                                    </div>
                                    {!! Form::close() !!}
                                   @else 
                                    <div class="form-group">
                                        <span class="label label-success">{{$document->verified_at}}</span>
                                    </div>
                                    <div class="form-group">
                                        Verifier: <b>{{$document->verifiedBy->name}}</b>
                                    </div>
                                    <div class="form-gorup">
                                        Verified At: <b>{{formatDateTime($document->verified_at)}}</b>
                                        ({{\Carbon\Carbon::parse($document->verified_at)->diffForHumans()}})
                                    </div>
                               @endif
                            </div>
                        @endcan
                        <div class="tab-pane" id="tab_activity">
                            <div class="card-body">
                                <div class="profiletimeline mt-0">
                                    @foreach ($document->activities as $activity)
                                    <div class="sl-item">
                                        <div class="sl-left"> <img src="{{ asset('/img/users/profile.png') }}" alt="user" class="rounded-circle" /> </div>
                                        <div class="sl-right">
                                            <div><a href="javascript:void(0)" class="link">{{$activity->createdBy->name}}</a> <span class="sl-date">{{\Carbon\Carbon::parse($activity->created_at)->diffForHumans()}}</span>
                                                <p>{!! $activity->activity !!} <a href="javascript:void(0)"> </a></p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @can('user manage permission')
                            <div class="tab-pane" id="tab_permissions">
                                <div>
                                    <div class="modal fade" id="modal-permission">
                                        {{Form::open(['route' => ['documents.store-permission',request('document')]])}}
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Give Permission</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="user_id" required>
                                                                <option value="">- Select User -</option>
                                                                @foreach($users as $usr)
                                                                    <option value="{{$usr->id}}">{{$usr->name}}({{$usr->username}})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @foreach (config('constants.DOCUMENT_LEVEL_PERMISSIONS')  as $perm)
                                                            <div class="col-sm-6" style="margin-top: 20px;">
                                                                <label>
                                                                    <input name="document_permissions[{{$perm}}]"
                                                                           type="checkbox" class="iCheck-helper"
                                                                           value="1"> {{ucfirst($perm)}}
                                                                    this {{config('settings.document_label_singular')}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save Permission</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{Form::close()}}
                                    </div>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th colspan="3" style="font-size: 1.8rem;">
                                                Direct Permissions
                                                <button type="button" style="float:right" class="btn btn-primary btn-xs pull-right" data-toggle="modal"
                                                        data-target="#modal-permission">
                                                    <i class="fa fa-plus"></i> New Permission
                                                </button>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>User</th>
                                            <th>Permissions</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (count($thisDocPermissionUsers)==0)
                                            <tr>
                                                <td colspan="2">No record found</td>
                                            </tr>
                                        @endif
                                        @foreach($thisDocPermissionUsers as $perm)
                                            <tr>
                                                <td>{{$perm['user']->name}}</td>
                                                <td>
                                                    @foreach($perm['permissions'] as $item)
                                                        <label class="label label-default">{{$item}}</label>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{Form::open(['route' => ['documents.delete-permission',request('document'),$perm['user']->id]])}}
                                                    <button type="submit" class="btn btn-danger btn-xs"
                                                            onclick="return conformDel(this,event)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    {{Form::close()}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th colspan="3" style="font-size: 1.8rem;">Permissions inherited
                                                by {{config('settings.tags_label_plural')}}</th>
                                        </tr>
                                        <tr>
                                            <th>{{ucfirst(config('settings.tags_label_singular'))}}</th>
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
                                                <td>{{$perm['tag']->name}}</td>
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
                                            <th colspan="3" style="font-size: 1.8rem;">Global Permission of {{config('settings.document_label_plural')}}</th>
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
                                        @foreach ($globalPermissionUsers as $perm)
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
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div id="sticky_footer">
        <form id="frm_image2pdf" action="{{route('files.downloadPdf')}}" method="post" style="display: inline">
            @csrf
            <input type="hidden" name="images">
            <input type="hidden" name="images_varient">
            <div class="dropup">
                <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-file-pdf-o"></i>  Convert PDF
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0);" onclick="submitPdfForm('original')">Original</a></li>
                    @foreach (explode(',',config('settings.image_files_resize')) as $varient)
                        <li><a href="javascript:void(0);" onclick="submitPdfForm('{{$varient}}')">{{$varient}}w</a></li>
                    @endforeach
                </ul>
            </div>
        </form>
    </div>

@endsection
