@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{trans('attendance-trans.List_Attendance')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{trans('attendance-trans.List_Attendance')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('status') }}</li>
            </ul>
        </div>
    @endif



    <h5 style="font-family: 'Cairo', sans-serif;color: red"> {{trans('attendance-trans.Today_Date')}} : {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{ route('employeeattendance.store') }}">

        @csrf
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr class="alert-success">
                <th>#</th>
                            <th>{{ trans('employees-trans.Name') }}</th>
                            <th>{{ trans('employees-trans.Code') }}</th>
                            <th>{{ trans('employees-trans.Email') }}</th>
                            <th>{{ trans('employees-trans.Location') }}</th>
                            <th>{{ trans('employees-trans.employee_department') }}</th>
                            <th>{{ trans('employees-trans.Manager') }}</th>
                            <th>{{trans('employees-trans.Processes')}}</th>
            </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach ($Employees as $Employee)
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>{{ $Employee->FName }} {{ $Employee->LName }}</td>
                    <td>{{ $Employee->Code }}</td>
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
                                class="badge badge-info">{{ trans('employees-trans.Employee') }}</label>
                        @endif

                    </td>
                    <td>
                        @if(isset($Employee->attendances()->where('attendance_date',date('Y-m-d'))->first()->Employee_Id))

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendances[{{ $Employee->id }}]" disabled
                                       {{ $Employee->attendances()->orderBy('created_at', 'desc')->first()->attendance_status == 1 ? 'checked' : '' }}
                                       class="leading-tight" type="radio" value="presence">
                                <span class="text-success"> {{trans('attendance-trans.Present')}}</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendances[{{ $Employee->id }}]" disabled
                                       {{ $Employee->attendances()->orderBy('created_at', 'desc')->first()->attendance_status == 0 ? 'checked' : '' }}
                                       class="leading-tight" type="radio" value="absent">
                                <span style="color:#8b008b"> {{trans('attendance-trans.Absent')}}</span>
                            </label>

                        @else

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendances[{{ $Employee->id }}]" class="leading-tight" type="radio"
                                       value="presence">
                                <span class="text-success"> {{trans('attendance-trans.Present')}}</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendances[{{ $Employee->id }}]" class="leading-tight" type="radio"
                                       value="absent">
                                <span style="color:#8b008b">{{trans('attendance-trans.Absent')}}</span>
                            </label>

                        @endif

                        <input type="hidden" name="employee_id[]" value="{{ $Employee->id }}">


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <P>
            <button class="btn btn-success" type="submit">{{ trans('employees-trans.Submit') }}</button>
        </P>
    </form><br>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
