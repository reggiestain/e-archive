@extends('layouts.app')
@section('title','Edit User')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-12" style="margin-bottom:20px">
                    <div class="page-header-title">
                        <h1>
                            User
                        </h1> 
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
            <div class="col-lg-12 col-md-12">
                <div class="card">      
            <div class="card-body">
    <div class="content">
        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

        @include('users.fields')

        {!! Form::close() !!}
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection
