@extends('layouts.master')
@section('css')

@section('title')
{{trans('employees-trans.Attachment')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;color: #8b008b">{{trans('employees-trans.Attachment')}}   {{$employeename}} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item "><a href="{{route('employee.index')}}">{{trans('employees-trans.title_page')}}</a></li>
                <li class="breadcrumb-item ">
                    <a href="{{route('employee.show',$Employee->id)}}">{{trans('employees-trans.E_Profile')}}</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{url('showAttachment')}}/{{ $employeename }}/{{$filename}}/{{$Employee->id}}">{{trans('employees-trans.Attachment')}}</a>
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
            <div class="card-body text-center">
                <iframe src="{{url('attachments/employees/'.$employeename.'/'.$filename)}}" frameborder="0" style="width: 800px; height:600px"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
