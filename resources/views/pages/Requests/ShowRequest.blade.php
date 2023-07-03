@extends('layouts.master')
@section('css')

@section('title')
{{trans('requests-trans.Show_Request')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;color: #8b008b">{{trans('requests-trans.Show_Request')}}
               / {{$employeename}} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item "><a href="{{route('Send_Request.index')}}">{{trans('requests-trans.Employee_Requests')}}</a></li>
                <li class="breadcrumb-item active">
                    <a href="{{url('showRequest')}}/{{ $employeename }}/{{$filename}}/{{$Employee_Request->id}}">{{trans('requests-trans.Show_Request')}}</a>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="text-center">
                <br>
                <a class=" btn btn-outline-info "
                href="{{url('Download_Statement')}}/{{ $employeename }}/{{$filename}}"
                role="button"><i class="fa fa-download"></i>&nbsp; {{trans('employees-trans.Download')}}</a>
                </div>
                <br>
            <div class="card-body text-center">
                <iframe src="{{url('attachments/employeeRequests/'.$employeename.'/'.$filename)}}" frameborder="0" style="width: 800px; height:600px"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
