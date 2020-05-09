@extends('layouts.app')
@section('title','Edit '.ucfirst(config('settings.tags_label_singular')))
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-12" style="margin-bottom:20px">
                    <div class="page-header-title">
                        <i class="fa fa-tags bg-red"></i>
                        <div class="d-inline">
                            {{--<h5>{{ucfirst(config('settings.tags_label_plural'))}}</h5>--}}
                            <h5>Tags</h5>
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
                            {{--<h5>{{ucfirst(config('settings.tags_label_plural'))}}</h5>--}}
                            <h5>Edit Tag</h5>
                        </div>
                    </div>            
            <div class="card-body">
   <div class="content">
       <div class="box box-primary">
           <div class="box-body">
               
                   {!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'patch']) !!}

                        @include('tags.fields')

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
