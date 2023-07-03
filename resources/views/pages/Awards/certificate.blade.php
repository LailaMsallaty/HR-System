@extends('layouts.master')
@section('css')

@section('title')
{{trans('awards-trans.Give_Award')}}
@stop
@endsection
@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;color: #8b008b">{{trans('awards-trans.Show_Award')}} /  {{$employee->FName}} {{$employee->LName}} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item "><a href="{{route('Give_Award.index')}}">{{trans('awards-trans.Give_Award')}}</a></li>
                <li class="breadcrumb-item active">
                    <a href="{{route('Give_Award.show',$EmployeeAward->id)}}">{{trans('awards-trans.Show_Award')}}</a>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row justify-content-center">

        <div class="card card-statistics">
            <div class="card-body text-center " >

                <form action="{{ route('Award_Generate_PDF') }}" method="POST">
                    @csrf
                <input type="hidden" name="emp_id" value="{{ $employee->EmployeeID }}">
                <input type="hidden" name="award_id" value="{{ $award->AwardID }}">
                <input type="hidden" name="emp_award_id" value="{{ $EmployeeAward->id }}">
                <button class="mt-4 btn  btn-small" type="submit" name='pdf'><strong> {{ trans('awards-trans.Generate_PDF') }}</strong> &nbsp; <img class="icon" src="{{ URL::asset('assets/images/file-icon/PDF.png') }}" width="50" height="50" alt=""> </button>
               </form>
                <br><br>

                    <div style="  font-family: freeserif ;font-feature-settings: ss07; width:800px; height:660px; padding:20px; text-align:center; border: 10px solid #008080;">
                        <div style="width:750px; height:610px; padding:20px; text-align:center; border: 5px solid #008080">
                               <span style="font-size:50px; font-weight:bold">{{ trans('awards-trans.Certificate') }}</span>
                               <br><br>
                               {{-- <i class="fa fa-certificate" style="font-size:80px ;color:#8b008b"></i> --}}
                               <img src="{{URL::asset('assets/images/PngItem_1329806.png')}}" width="80" height="80" alt="">

                               <br><br>
                               <span style="font-size:25px"><i>{{ trans('awards-trans.Certify_That') }}</i></span>
                               <br><br>
                               <span style="font-size:30px"><b> {{$employee->FName}} {{$employee->LName}}</b></span><br/><br/>
                               <span style="font-size:25px;color:#8b008b"><i>{{ trans('awards-trans.Deserve_Award') }}</i></span> <br/><br/>
                               <span style="font-size:30px">({{ $award->Name }})</span> <br/><br/>
                               <span style="font-size:25px"><i>{{ trans('awards-trans.Date') }}</i></span><br>
                               <span style="font-size:30px">  {{ $EmployeeAward->created_at }}</span><br/><br/>
                               <span style="font-size:20px; color: #8b008b">  LLJ Company </span><br/><br/>
                        </div>
                        </div>

            </div>
        </div>

</div>
<br><br>
<!-- row closed -->
@endsection
@section('js')

@endsection


