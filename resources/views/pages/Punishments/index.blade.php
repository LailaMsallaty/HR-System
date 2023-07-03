<?php
use Spatie\Permission\Models\Permission;

?>

@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('employees-trans.list_Punishments') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('employees-trans.list_Punishments')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('Employee_punishment.index')}}">{{trans('employees-trans.list_Punishments')}}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('employees-trans.list_Punishments') }}
@stop
@section('content')
<!-- row -->
<div class="row">

<div class="col-xl-12 mb-30">
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


            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0" style="text-align: center">
                        <thead>
                        <tr>
                            @can(Permission::select("name->".\App::getLocale())->where('name->ar','العمليات_على_الموظفين_المعاقبين')->first())

                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>

                            @endcan
                            <th>#</th>
                            <th>{{ trans('awards-trans.Employee') }}</th>
                            <th>{{ trans('employees-trans.Code') }}</th>
                            <th>{{ trans('employees-trans.Punishment_Name') }}</th>
                            <th>{{ trans('employees-trans.Punishment_Description') }}</th>
                            <th>{{ trans('employees-trans.Deducted_Amount') }}</th>
                            <th>{{ trans('employees-trans.Punishment_Statement') }}</th>
                            <th>{{ trans('employees-trans.Punishment_Date') }}</th>
                            <th>{{ trans('employees-trans.Processes') }}</th>

                            </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($Punishments as $Punishment)
                            <tr>
                                <?php $i++; ?>

                                <td>
                                    @can(Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_الموظفين_المعاقبين')->first())

                                    <input type="checkbox"  value="{{ $Punishment->id }}" class="box1" >

                                    @endcan

                                </td>

                                <td>{{ $i }}</td>
                                <td>{{ $Punishment->FName }} {{ $Punishment->LName }}</td>
                                <td>{{ $Punishment->Code }}</td>
                                <td>{{ $Punishment->Name }}</td>
                                <td>{{ $Punishment->Description }}</td>
                                <td>{{ $Punishment->Deducted_Amount }}</td>
                                <td>{{ $Punishment->Statement }}</td>
                                <td>{{ $Punishment->created_at }}</td>
                                <td>
                                    @can(Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_الموظفين_المعاقبين')->first())

                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $Punishment->id }}"
                                        title="{{ trans('employees-trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $Punishment->id }}"
                                        title="{{ trans('employees-trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                     @endcan
                                </td>
                            </tr>

                            <!-- edit_modal_Punishment -->
                            <div class="modal fade" id="edit{{ $Punishment->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('employees-trans.edit_Punishment') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- edit_form -->
                                            <form action="{{ route('Punishment_employee_update', 'test') }}" method="post">
                                                @csrf
                                                <div class="row">
                                                        <div class="col">
                                                            <label for=""
                                                            class="mr-sm-2">{{ trans('awards-trans.Location') }}
                                                         :  <span class="text-danger">*</span></label>

                                                         <select class="form-control  form-control-lg"
                                                         id="exampleFormControlSelect1" name="location_id" onclick="console.log($(this).val())">
                                                            @foreach ($locations as $Location)
                                                                <option value="{{ $Location->id }}" @if($Punishment->Location_Id == $Location->id)
                                                                    selected
                                                                @endif>
                                                                    {{ $Location->Address }}
                                                                </option>
                                                            @endforeach
                                                         </select>
                                                         <input type="hidden" name="id" value="{{ $Punishment->id }}">

                                                        </div>
                                                        <div class="col">
                                                            <label for=""
                                                            class="mr-sm-2">{{ trans('employees-trans.Department') }}
                                                         :  <span class="text-danger">*</span></label>
                                                            <select name="department_id"  class="form-control form-control-lg" class="custom-select" onclick="console.log($(this).val())" >


                                                                @foreach($Departments->where('id',$Punishment->DepartmentID) as $department)
                                                                <option  value="{{$department->id}}"
                                                                    @if($Punishment->DepartmentID == $department->id)
                                                                    selected
                                                                    @endif
                                                                   >{{$department->Name}}</option>

                                                           @endforeach
                                                            </select>
                                                        </div>



                                               </div>
                                               <br>
                                               <div class="row">
                                                <div class="col">
                                                    <label for=""
                                                    class="mr-sm-2">{{ trans('awards-trans.Employee') }}
                                                 :  <span class="text-danger">*</span></label>
                                                    <select name="employee"  class="form-control form-control-lg" class="custom-select" >

                                                        @foreach($Employees->where('Location_Id',$Punishment->Location_Id) as $employee)
                                                        <option  value="{{$employee->id}}"
                                                            @if($Punishment->EmployeeID == $employee->id)
                                                            selected
                                                            @endif
                                                           >{{$employee->FName}} {{$employee->LName}}</option>

                                                   @endforeach
                                                    </select>
                                                </div>

                                                    <div class="col">
                                                        <label class="control-label" for="award"
                                                        class="mr-sm-2">{{ trans('awards-trans.Award_type') }}
                                                        : <span class="text-danger">*</span></label>
                                                        <select class="form-control form-control-lg" name="punishment_id" id="">
                                                            @foreach($punishments as $punishment)
                                                            <option value="{{ $punishment->id }}" @if ($Punishment->Name == $punishment->Name)
                                                                selected
                                                            @endif >
                                                                {{ $punishment->Name }}
                                                            </option>
                                                            @endforeach

                                                         </select>

                                                     </div>
                                               </div>
                                                <br>
                                                <div class="row">
                                                 <div class="col">
                                                     <label for=""
                                                     class="mr-sm-2">{{ trans('employees-trans.Punishment_Statement') }}
                                                     :</label>
                                                     <textarea class="form-control" rows="2" name="statement" >{{ $Punishment->Statement }}</textarea>
                                                 </div>
                                                </div>

                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('employees-trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('employees-trans.Submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- delete_modal_Punishment -->
                            <div class="modal fade" id="delete{{ $Punishment->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('employees-trans.delete_Punishment') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Employee_punishment.destroy', 'test') }}"
                                                  method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('employees-trans.Warning_Delete') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $Punishment->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('employees-trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('employees-trans.Delete') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </table>
                @can(Permission::select("name->".\App::getLocale())->where('name->ar','عمليات_الموظفين_المعاقبين')->first())

                <button type="button" class="btn x-small  btn-danger " id="btn_delete_all">
                    {{ trans('employees-trans.delete_checkbox') }}
                    </button>
                @endcan
            </div>
        </div>
    </div>
</div>







<!--delete_Group_Of_employees -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-header">
           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
               {{ trans('employees-trans.Delete') }}
           </h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>

       <form action="{{ route('delete_all_Impose_Punishments') }}" method="POST">
           {{ csrf_field() }}
           <div class="modal-body">
               {{ trans('employees-trans.Warning_Delete') }}
               <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
           </div>

           <div class="modal-footer">
               <button type="button" class="btn btn-secondary"
                       data-dismiss="modal">{{ trans('employees-trans.Close') }}</button>
               <button type="submit" class="btn btn-danger">{{ trans('employees-trans.Delete') }}</button>
           </div>
         </form>
     </div>
 </div>
</div>


</div>


<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
    $(document).ready(function () {
        $('select[name="location_id"]').on('click', function () {
            var location_id = $(this).val();
            if (location_id) {
                $.ajax({
                    url: "{{ URL::to('Resign_departments') }}/" + location_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="department_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="department_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
        $('select[name="department_id"]').on('click', function () {
            var department_id = $(this).val();
            var location_id = $('select[name="location_id"]').val();
            if (department_id) {
                $.ajax({
                    url: "{{ URL::to('Resign_Department_Employees') }}/" + department_id + "/"+ location_id ,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="employee"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="employee"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });

</script>
@endsection
