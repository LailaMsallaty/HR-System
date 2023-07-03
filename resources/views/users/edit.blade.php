@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />

@endsection

@section('title')
{{ trans('system-trans.Edit_User') }}
@stop



@section('PageTitle')
{{ trans('system-trans.Edit_User') }}
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('system-trans.Users') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> &nbsp;  /  &nbsp; {{ trans('system-trans.Edit_User') }}
            </span>
        </div>
        <br>
    </div>
</div>
<!-- breadcrumb -->
@endsection
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
                        <a class="btn btn-info btn-sm" href="{{ route('users.index') }}">{{ trans('system-trans.Back') }}</a>
                    </div>
                </div>
                <br>
                <br>


                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}


                    <div class="row mb-20">
                        <div class="parsley-input col " id="fnWrapper">
                            <label>{{ trans('system-trans.User_Name') }} : <span class="text-danger">*</span></label>
                            {!! Form::text('name', null, array('class' => 'form-control','required')) !!}
                        </div>

                        <div class="parsley-input col " id="fnWrapper">
                            <label>{{ trans('system-trans.Email') }} : <span class="text-danger">*</span></label>
                            {!! Form::text('email', null, array('class' => 'form-control','required')) !!}
                        </div>


                </div>

                <div class="row mb-20">
                    <div class="parsley-input col " id="lnWrapper">
                        <label>{{ trans('system-trans.Password') }} : <span class="text-danger">*</span></label>
                        {!! Form::password('password', array('class' => 'form-control','required')) !!}
                    </div>

                    <div class="parsley-input col " id="lnWrapper">
                        <label> {{ trans('system-trans.Confirm_Password') }} : <span class="text-danger">*</span></label>
                        {!! Form::password('confirm-password', array('class' => 'form-control','required')) !!}
                    </div>
                    <div class=" pull-right">
                        <div class=" parsley-input col" id="fnWrapper">
                        <label class="parsley-input form-label">{{ trans('system-trans.User_Status') }} : <span class="text-danger">*</span></label>
                        <br>
                        <select required name="Status" id="select-beast" class="pr-30 pl-30 form-control form-control-lg  nice-select  custom-select">

                            <option  @if ($user->Status == 1) selected value="{{ $user->Status }}" @else value="1"  @endif >{{ trans('system-trans.Active') }}</option>
                            <option  @if ($user->Status == 0 ) value="{{ $user->Status }}" selected  @else value="0" @endif >{{ trans('system-trans.Not_Active') }}</option>

                        </select>
                    </div>
                    </div>


                </div>

                <br>


                <div class="row mb-20">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        {{-- <div class="form-group">
                            <label>{{ trans('system-trans.User_Type') }} :</label>
                            {!! Form::select('roles_name[]', $roles,$userRole, array('class' => 'form-control','multiple','required'))
                            !!}
                        </div> --}}
                        <select multiple name="roles_name[]" class="form-control custom-select" id="exampleFormControlSelect2">

                            @foreach( $roles as $user_role)

                                 <option  value="{{ $user_role->id}}"
                                    @if($user->roles->containsStrict('id', $user_role->id))
                                     selected
                                       @endif
                                    >{{$user_role->name}}</option>

                            @endforeach
                            {{-- @foreach($list_Position->employees as $employee)
                                <option  value="{{$employee->id}}" selected>{{$employee->FName}}</option>
                            @endforeach --}}

                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button class="btn btn-info pd-x-20" type="submit">{{ trans('locations-trans.Submit') }}</button>
                </div>
                {!! Form::close() !!}
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
<!-- Internal Nice-select js-->

@endsection
