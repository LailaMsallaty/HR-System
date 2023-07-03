@extends('layouts.master')
@section('css')
<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />


@endsection

@section('title')
  {{ trans('system-trans.Add_Role') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('system-trans.Roles') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> &nbsp;  /  &nbsp; {{ trans('system-trans.Add_Role') }}</span>
        </div>
    </div>
    <br>
</div>
<!-- breadcrumb -->
@endsection

@section('PageTitle')
{{ trans('system-trans.Add_Role') }}
@stop
@section('content')

@if (count($errors) > 0)
<div class="alert alert-danger">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ trans('system-trans.Error') }}</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif




{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    @if (App::getLocale() == 'en')
                        <div class="pull-right">
                            <a class="btn btn-info" href="{{ route('roles.index') }}"> {{ trans('system-trans.Back') }}</a>
                        </div>
                        @else
                        <div class="pull-left">
                            <a class="btn btn-info" href="{{ route('roles.index') }}"> {{ trans('system-trans.Back') }}</a>
                        </div>
                        @endif
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="Name_ar"
                               class="mr-sm-2">{{ trans('system-trans.Role_Name_ar') }}
                            : <span class="text-danger">*</span></label>
                        <input id="Name_ar" type="text" name="Name_role_ar"
                               class="form-control"
                               required>
                    </div>
                    <div class="col">
                        <label for="Name_en"
                               class="mr-sm-2">{{ trans('system-trans.Role_Name_en') }}
                            : <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"
                               name="Name_role_en" required>
                    </div>
                    {{-- <div class="col-xs-7 col-sm-7 col-md-7">
                        <div class="form-group">
                            <p>{{ trans('system-trans.Role_Name') }} :</p>
                            <br>
                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
                        </div>
                    </div> --}}
                </div>
                <div class="row">
                    <!-- col -->
                    <div class="col-lg-4">
                        <ul id="treeview1">
                            <li><a href="#" class="ml-3">{{ trans('system-trans.Permissions') }} :</a>
                                <ul>
                            </li>
                            @foreach($permission as $value)
                            <label
                                style="font-size: 16px;">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                {{ $value->name }}</label>
                          <br />
                            @endforeach
                            </li>

                        </ul>
                        </li>
                        </ul>
                    </div>
                    <!-- /col -->
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-info pd-x-20" type="submit">{{ trans('locations-trans.Submit') }}</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- row closed -->

<!-- main-content closed -->

{!! Form::close() !!}
@endsection
@section('js')
<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
@endsection
