@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('system-trans.Users') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">&nbsp;  /  &nbsp; {{ trans('system-trans.Add_User') }}
            </span>
        </div>
        <br>
    </div>
</div>
<!-- breadcrumb -->
@endsection


@section('PageTitle')
{{ trans('system-trans.Add_User') }}
@stop

@section('content')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">

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

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-info btn-sm" href="{{ route('users.index') }}">{{ trans('system-trans.Back') }}
                        </a>
                    </div>
                </div> <br>
                <br>

                <form class="parsley-style-1 " id="selectForm2" autocomplete="off" name="selectForm2"
                    action="{{route('users.store','test')}}" method="post" data-parsley-validate>
                    {{csrf_field()}}

                        <div class="row">
                            <div class="parsley-input col" id="fnWrapper">
                                <label>{{ trans('system-trans.User_Name') }}
                                    : <span class="text-danger">*</span></label>
                                <input class="form-control form-control-lg "
                                    data-parsley-class-handler="#fnWrapper" name="name" required="" type="text">
                            </div>
                            <div class="parsley-input col" id="lnWrapper">
                                <label>{{ trans('system-trans.Email') }}
                                    : <span class="text-danger">*</span></label>
                                <input class="form-control form-control-lg "
                                    data-parsley-class-handler="#lnWrapper" name="email" required="" type="email">
                            </div>
                            <br>

                        </div>

                       <br>

                    <div class="row">
                        <div class="parsley-input col" id="fnWrapper">
                            <label>{{ trans('system-trans.Password') }}
                                : <span class="text-danger">*</span></label>
                            <input class="form-control form-control-lg mg-b-20"
                             data-parsley-class-handler="#fnWrapper"
                                name="password" required="" type="password">
                        </div>

                        <div class="parsley-input col" id="snWrapper">
                            <label> {{ trans('system-trans.Confirm_Password') }}
                                : <span class="text-danger">*</span></label>
                            <input class="form-control form-control-lg mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="confirm-password" required="" type="password">
                        </div>
                        <div class=" pull-right">
                            <div class=" parsley-input col" id="fnWrapper">
                                <label class="parsley-input form-label">{{ trans('system-trans.User_Status') }}  : <span class="text-danger">*</span>
                                </label>
                                <br>
                                <select required name="Status" id="select-beast" class=" pr-30 pl-30  form-control form-control-lg   nice-select  custom-select" data-parsley-class-handler="#fnWrapper">
                                    <option value="1">{{ trans('system-trans.Active') }}</option>
                                    <option value="0">{{ trans('system-trans.Not_Active') }}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label"> {{ trans('system-trans.User_Permissions') }}  : <span class="text-danger">*</span></label>
                                {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple','required')) !!}
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-info pd-x-20" type="submit">{{ trans('locations-trans.Submit') }}</button>
                    </div>
                </form>
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
<!-- main-content closed -->
@endsection
@section('js')



<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>

@endsection
