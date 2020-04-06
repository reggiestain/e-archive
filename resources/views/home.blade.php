@extends('layouts.app')
@section('title','Home')
@section('scripts')
    <script>
        function gotoUpload() {
            var docId = $("#document_id").val();
            var urlToUp = '{{route('documents.files.create',['id'=>''])}}'+'/'+docId;
            console.log(urlToUp);
            window.location.href = urlToUp;
            return false;
        }
        $(function () {
            $('#activityrange').daterangepicker(
                {
                    ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#activityrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    $('#activity_range').val(start.format('YYYY-MM-DD') + 'to' + end.format('YYYY-MM-DD'));
                }
            );
            @if(request()->has('activity_range'))
                var dates = '{{request('activity_range')}}'.split('to');
                var start = moment(dates[0]);
                var end = moment(dates[1]);
                $('#activityrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            @endif
        });
    </script>
@stop
@section('content')
<div class="main-content">
                    <div class="container-fluid">
                    <section class="content-header">
                    <h1 class="pull-left">Dashboard</h1>
                    </section>
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>{{ucfirst(config('settings.tags_label_plural'))}}</h6>
                                                <h2>{{$tagCounts}}</h2>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-tags"></i>
                                            </div>
                                        </div>
                                        <small class="text-small mt-10 d-block">Total {{ucfirst(config('settings.tags_label_plural'))}} in system</small>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                     
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>{{ucfirst(config('settings.document_label_plural'))}}</h6>
                                                <h2>{{$documentCounts}}</h2>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-folder"></i>
                                            </div>
                                        </div>
                                        <small class="text-small mt-10 d-block">Containing {{$filesCounts}} {{ucfirst(config('settings.file_label_plural'))}}</small>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                         <br>
                       
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Quick Upload</h3>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                                <li><i class="ik ik-minus minimize-card"></i></li>
                                                <li><i class="ik ik-x close-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-lg-12 col-md-12">
                                                        <form action="#" class="text-center"  onsubmit="return gotoUpload()">
                                                            <div class="form-group">
                                                                <label for="">Choose {{ucfirst(config('settings.document_label_singular'))}}</label>
                                                                <select name="document_id" id="document_id" class="form-control select2">
                                                                    @foreach ($documents as $document)
                                                                        @can('view',$document)
                                                                            <option value="{{$document->id}}">{{$document->name}}</option>
                                                                        @endcan
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <button class="btn btn-primary">Upload</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>

                            <div class="col-md-12">
                                <div class="card" style="min-height: 422px;">
                                    <div class="card-header">
                                        <h3>Activities</h3>
                                        <!--<div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                                <li><i class="ik ik-minus minimize-card"></i></li>
                                                <li><i class="ik ik-x close-card"></i></li>
                                            </ul>
                                        </div>-->
                                        <div class="card-header-right" style="float:right">
                                            {!! Form::open(['method' => 'get','style'=>'display:inline;']) !!}
                                                {!! Form::hidden('activity_range', '', ['id' => 'activity_range']) !!}
                                                <button type="button" id="activityrange" class="btn btn-default btn-sm">
                                                    <i class="fa fa-calendar"></i>&nbsp;
                                                    <span>Choose dates</span> <i class="fa fa-caret-down"></i>
                                                </button>
                                                {!! Form::button('<i class="fa fa-filter"></i>&nbsp;Filter', ['class' => 'btn btn-default btn-sm','type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                    class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body timeline">
                                        <div class="header bg-theme" style="background-image: url('img/placeholder/placeimg_400_200_nature.jpg')">
                                            <div class="color-overlay d-flex align-items-center">
                                                <div class="day-number">{{formatDate(optional($activities->first())->created_at,'d')}}</div>
                                                <div class="date-right">
                                                    <div class="day-name">{{formatDate(optional($activities->first())->created_at,'M')}}</div>
                                                    <div class="month">{{formatDate(optional($activities->first())->created_at,'d M Y')}}</div>
                                                </div>
                                            </div>                                
                                        </div>                                       
                                            <div class="profiletimeline mt-0">
                                            @foreach ($activities as $activity)
                                            @can('view',$activity->document)
                                            
                                                <div class="sl-item">
                                                    <div class="sl-left"> <img src="{{ asset('/img/users/profile.png') }}" alt="user" class="rounded-circle" /> </div>
                                                    <div class="sl-right">
                                                        <div><a href="javascript:void(0)" class="link">{{$activity->createdBy->name}}</a> <span class="sl-date">{{\Carbon\Carbon::parse($activity->created_at)->diffForHumans()}}</span>
                                                            <p>{!! $activity->activity !!} <a href="javascript:void(0)"> </a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                                                       
                                            @endcan
                                            @endforeach
                                        </div>
                                        <div class="text-center">
                                            {!! $activities->appends(request()->all())->render() !!}
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>            
@endsection
