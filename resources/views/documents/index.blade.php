@extends('layouts.app')
@section('title',ucfirst(config('settings.document_label_plural'))." List")
@section('css')
    <style type="text/css">
        .bg-folder-shaper {
            width: 100%;
            height: 115px;
            border-radius: 0px 15px 15px 15px !Important;
        }

        .folder-shape-top {
            width: 57px;
            height: 17px;
            border-radius: 20px 37px 0px 0px;
            position: absolute;
            top: -16px;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .widget-user-2 .widget-user-username, .widget-user-2 .widget-user-desc {
            margin-left: 10px;
            font-weight: 400;
            font-size: 17px;
        }

        .widget-user-username {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .m-t-20 {
            margin-top: 20px;
        }

        .dropdown-menu {
            min-width: 100%;
        }

        .doc-box.box {
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0.0) !important;
        }

        .bg-folder-shaper:hover {
            background-color: yellow;
        }

        .select2-container {
            width: 100% !important;
        }

        #filterForm.in, filterForm.collapsing {
            display: block !important;
        }
        .widget-user-2 .widget-user-header {
          padding: 20px;
          border-top-right-radius: 3px;
          border-top-left-radius: 3px;
        }
        .bg-folder-shaper {
          width: 100%;
          height: 115px;
          border-radius: 0px 15px 15px 15px !Important;
        }
        .no-padding {
          padding: 0 !important;
        }
        .bg-gray {
          color: #000;
          background-color: #d2d6de !important;
        }
        .box-header {
          color: #444;
          display: block;
          padding: 10px;
          position: relative;
        }
        .user-desc {
          margin-left: 10px;
          font-weight: 400;
          font-size: 17px;
        }
        .widget-user-2 .widget-user-username, .widget-user-2 .widget-user-desc {
          margin-left: 10px;
          font-weight: 400;
          font-size: 17px;
          margin-top: 5px;
          margin-bottom: 5px;
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
        }
        .bg-folder-shaper {
          width: 100%;
          height: 115px;
          border-radius: 0px 15px 15px 15px !Important;
        }
        .folder-shape-top {
          width: 57px;
          height: 17px;
          border-radius: 20px 37px 0px 0px;
          position: absolute;
          top: -16px;
          left: 0;
          right: 0;
          bottom: 0;
        }
        .box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 3px 0 rgba(0,0,0,0.1), 0 1px 2px 0 rgba(0,0,0,0.06);
}
.box-header>.box-tools {
    float: right;
    margin-top: -5px;
    margin-bottom: -5px;
}
.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}

    </style>
@stop
@section('scripts')
    <script>

    </script>
@stop
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-menu bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ucfirst(config('settings.document_label_plural'))}}</h5>
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
                                @can('create',\App\Document::class)
                                    <a href="{{route('documents.create')}}"
                                       class="btn btn-primary">
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
            <div class="card-header" style="padding:25px 25px">
            <div class="card-header-left">
                <div class="form-group hidden visible-xs">
                    <button type="button" class="btn btn-default btn-block" data-toggle="collapse"
                            data-target="#filterForm"><i class="fa fa-filter"></i> Filter
                    </button>
                </div>
                {!! Form::model(request()->all(), ['method'=>'get','class'=>'form-inline visible hidden-xs','id'=>'filterForm']) !!}
                <div class="form-group">
                    <label for="search" class="sr-only">Search</label>
                    {!! Form::text('search',null,['class'=>'form-control input-sm','placeholder'=>'Search...']) !!}
                </div>
                <div class="form-group">
                    <label for="tags" class="sr-only">{{config('settings.tags_label_singular')}}:</label>
                    <select class="form-control select2 input-sm" name="tags[]" id="tags"
                            data-placeholder="Choose {{config('settings.tags_label_singular')}}" multiple>
                        @foreach($tags as $tag)
                            @canany(['read documents','read documents in tag '.$tag->id])
                                <option
                                    value="{{$tag->id}}" {{in_array($tag->id,request('tags',[]))?'selected':''}}>{{$tag->name}}</option>
                            @endcanany
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status" class="sr-only">{{config('settings.tags_label_singular')}}:</label>
                    {!! Form::select('status',['0'=>"ALL",config('constants.STATUS.PENDING')=>config('constants.STATUS.PENDING'),config('constants.STATUS.APPROVED')=>config('constants.STATUS.APPROVED'),config('constants.STATUS.REJECT')=>config('constants.STATUS.REJECT')],null,['class'=>'form-control input-sm']) !!}
                </div>
                <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-filter"></i> Filter</button>
                {!! Form::close() !!} 
            </div>
        </div>
        <div class="card-body">
            <div class="row">   
                <div class="col-lg-12">  
                    @include('flash::message')
                </div>  
            </div> 
            <div class="row align-items-center">
                            
                    @foreach ($documents as $document)
                        @cannot('view',$document)
                            @continue
                        @endcannot
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 m-t-20" style="cursor:pointer;">
                            <div class="doc-box box box-widget widget-user-2">
                                <div class="widget-user-header bg-gray bg-folder-shaper no-padding">
                                    <div class="folder-shape-top bg-gray"></div>
                                    <div class="box-header">
                                        <a href="{{route('documents.show',$document->id)}}" style="color: black;">
                                            <h3 class="box-title"><i class="fa fa-folder text-yellow"></i></h3>
                                        </a>

                                        <div class="box-tools pull-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-flat dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"
                                                        style="    background: transparent;border: none;">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                                    <li><a href="{{route('documents.show',$document->id)}}">Show</a>
                                                    </li>
                                                    @can('edit',$document)
                                                        <li><a href="{{route('documents.edit',$document->id)}}">Edit</a>
                                                        </li>
                                                    @endcan
                                                    @can('delete',$document)
                                                        <li>
                                                            {!! Form::open(['route' => ['documents.destroy', $document->id], 'method' => 'delete']) !!}
                                                            {!! Form::button('Delete', [
                                                                        'type' => 'submit',
                                                                        'class' => 'btn btn-link',
                                                                        'onclick' => "return conformDel(this,event)"
                                                                    ]) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                    @endcan

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <a href="{{route('documents.show',$document->id)}}" style="color: black;">
                                    <span style="max-lines: 1; white-space: nowrap;margin-left: 3px;">
                                    @foreach ($document->tags as $tag)
                                            <small class="label"
                                                   style="background-color: {{$tag->color}};font-size: 0.93rem;">{{$tag->name}}</small>
                                        @endforeach
                                    </span>
                                        <h5 class="widget-user-username" title="{{$document->name}}"
                                            data-toggle="tooltip">{{$document->name}}</h5>
                                        <h5 class="widget-user-desc" style="font-size: 12px"><span data-toggle="tooltip"
                                                                                                   title="{{formatDateTime($document->updated_at)}}">{{formatDate($document->updated_at)}}</span>
                                            <span
                                                class="pull-right" style="margin-right: 15px;">
                                            {!! $document->isVerified ? '<i title="Verified" data-toggle="tooltip" class="fa fa-check-circle" style="color: #388E3C;"></i>':'<i title="Unverified" data-toggle="tooltip" class="fa fa-remove" style="color: #f44336;"></i>' !!}
                                        </span></h5>
                                    </a>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
            <div class="box-footer">
                {!! $documents->appends(request()->all())->render() !!}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
