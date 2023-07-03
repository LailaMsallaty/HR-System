<?php
use Spatie\Permission\Models\Permission;

?>


@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('employees-trans.list_Resign') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('employees-trans.list_Resign')}}</h4>  <i class="fa fa-user-resign"></i>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('resigned.create')}}">{{trans('employees-trans.list_Resign')}}</a></li>
               </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('employees-trans.list_Resign') }}
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-danger">
                                            <th>#</th>
                                            <th>{{ trans('employees-trans.Photo') }}</th>
                                            <th>{{ trans('employees-trans.Name') }}</th>
                                            <th>{{ trans('employees-trans.Code') }}</th>
                                            <th>{{ trans('employees-trans.Nationality') }}</th>
                                            <th>{{ trans('employees-trans.Email') }}</th>
                                            <th>{{ trans('employees-trans.Location') }}</th>
                                            <th>{{ trans('employees-trans.employee_department') }}</th>
                                            <th>{{ trans('employees-trans.Manager') }}</th>
                                            <th>{{ trans('employees-trans.Deleted_at') }}</th>
                                            <th>{{trans('employees-trans.Processes')}}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                  <?php $i = 0; ?>
                                        @foreach($employees as $Employee)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>@if (file_exists('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName))
                                                    <img src='{{ URL::asset('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName) }}' height="80" width="80" alt="" />

                                                 </td>

                                                    @else
                                                    <img src='{{ URL::asset('assets/images/385-3856300_no-avatar-png.png') }}' height="80" width="80"  id ="imagepreview" alt="Image Preview" />


                                                 </td>

                                                @endif
                                                <td>{{ $Employee->FName }} {{ $Employee->LName }}</td>
                                                <td>{{ $Employee->Code }}</td>
                                                <td>{{ $Employee->Nationality->Name }}</td>
                                                <td>{{ $Employee->email }}</td>
                                                <td>{{ $Employee->location->Address }}</td>
                                                <td>{{ $Employee->department->Name }}</td>

                                                <td>
                                                    @if ($Employee->Manager === 1)
                                                        <label
                                                            class="badge badge-success" style="background-color: #8b008b">{{ trans('employees-trans.Is_Manager') }}
                                                        </label>
                                                    @else
                                                        <label
                                                            class="badge badge-primary">{{ trans('employees-trans.Employee') }}</label>
                                                    @endif

                                                </td>
                                                <td>
                                                    {{ $Employee->deleted_at }}
                                                </td>

                                                <td>
                                                    @can(Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_الموظفين_المستقيلين')->first())

                                                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#Return_Employee{{ $Employee->id }}" title="{{ trans('employees-trans.Return_Employee') }}">{{ trans('employees-trans.Return_Employee') }}</button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#Delete_Employee{{ $Employee->id }}" title="{{ trans('employees-trans.Delete_Employee') }}">{{ trans('employees-trans.Delete_Employee') }}</button>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @include('pages.Resigned.return')
                                        @include('pages.Resigned.Delete')
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
