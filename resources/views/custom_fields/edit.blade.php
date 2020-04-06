@extends('layouts.app')
@section('title','Edit Custom Field')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-12" style="margin-bottom:20px">
                    <div class="page-header-title">
                        <i class="fa fa-edit bg-blue"></i>
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
    <section class="content-header">
        <h1>
            Custom Field
        </h1>
   </section>
   <div class="content">
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($customField, ['route' => ['customFields.update', $customField->id], 'method' => 'patch']) !!}

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
</div>
@endsection
