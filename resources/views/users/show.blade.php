@extends('layouts.master')

@section('title')
{{ trans('system-trans.Show_User') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('system-trans.Users') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">&nbsp;  /  &nbsp; {{ trans('system-trans.Show_User') }}
            </span>
        </div>
        <br>
    </div>
</div>
<!-- breadcrumb -->
@endsection


@section('PageTitle')
{{ trans('system-trans.Show_User') }}
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="">
            <h2 style="color: #8b008b"> {{ trans('system-trans.Show_User') }}</h2>
        </div>
        <br>
        @if (App::getLocale() == 'en')
        <div class="pull-right">
            <a class="btn btn-info" href="{{ route('users.index') }}"> {{ trans('system-trans.Back') }}</a>
        </div>
        @else
        <div class="pull-left">
            <a class="btn btn-info" href="{{ route('users.index') }}"> {{ trans('system-trans.Back') }}</a>
        </div>
        @endif
    </div>
</div>
<br>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ trans('system-trans.User_Name') }} : &nbsp;</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ trans('system-trans.Email') }} : &nbsp;</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>{{ trans('system-trans.User_Roles') }} : &nbsp;</strong>
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}</label>
            @endforeach
            @endif
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
@endsection

@section('js')



@endsection
