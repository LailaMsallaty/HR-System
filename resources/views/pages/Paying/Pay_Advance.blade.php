@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('salaries-trans.Pay_Advance') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;color: #008080"> {{trans('salaries-trans.Pay_Advance_To')}} {{ $Employee->FName }}  {{ $Employee->LName }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item "><a href="{{route('employee.index')}}">{{trans('employees-trans.title_page')}}</a></li>
                <li class="breadcrumb-item active">
                    <a href="{{route('Show_Pay_Advance',$Employee->id)}}">{{trans('salaries-trans.Pay_Advance')}}</a>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('salaries-trans.Pay_Advance') }}
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="col-xs-12">
                <div class="col-md-12">
                    <br>
                    <form action="{{ route('Pay_Advance') }}" method="POST">
                        @csrf
                         <div class="row">
                             <div class="col">
                                <label for="loan"
                                       class="mr-sm-2">{{ trans('salaries-trans.Amount') }}
                                    : <span class="text-danger">*</span></label>
                                <input id="Advance" type="number" name="advance"
                                       class="form-control"
                                       required>
                                <input id="id" type="hidden" name="id" class="form-control"
                                value="{{$Employee->id}}"  >
                                <input id="id" type="hidden" name="previous_salary" class="form-control"
                                value="{{$Employee->Salary}}"  >
                             </div>
                         </div>
                         <div class="row">
                             <div class="col">
                                <label for="statement"
                                       class="mr-sm-2">{{ trans('salaries-trans.Statement') }}
                                    : <span class="text-danger">*</span></label>
                                <textarea id="statement" type="text" class="form-control"
                                       name="statement" required> </textarea>

                             </div>

                         </div>

                         <div class="modal-footer">
                            <button type="submit"
                                     class="btn btn-success">{{ trans('employees-trans.Submit') }}</button></div>

                         <br>

              </form>

            </div>
        </div>
    </div>
</div>
</div>
</div>

   <!-- row closed -->
   @endsection
   @section('js')
       @toastr_js
       @toastr_render

   @endsection

