<?php

use Spatie\Permission\Models\Permission;

 ?>
@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('employees-trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('employees-trans.Company_Employees')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('employee.index')}}">{{trans('employees-trans.title_page')}}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('employees-trans.title_page') }}
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

            <form action="{{ route('Filter_Employees') }}"  method="POST">
                {{ csrf_field() }}
        <div class="form-row align-items-center">
             <div class="col-auto my-1">
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="Department_id" required
                        onchange="this.form.submit()">
                    <option value="" selected disabled>{{ trans('employees-trans.Search_By_Department') }}</option>
                    @foreach ($Departments as $Department)
                        <option value="{{ $Department->id }}">{{ $Department->Name }}</option>
                    @endforeach
                </select>
              </div>
        </div>
            </form>
<br>
            <a class=" btn-success btn-sm mr-2 " href="{{ url('export_employees') }}"
            style="color:white"><i class="fa fa-upload"></i>&nbsp; {{ trans('employees-trans.Export_Excel') }}</a>

            <a href="{{ url('pdf_employees') }}" value="report" class="btn  btn-small"><img class="icon" src="{{ URL::asset('assets/images/file-icon/PDF.png') }}" width="50" height="50" alt=""></a>

            <br>

            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0 " style="text-align: center">
                        <thead>
                        <tr>
                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                            <th>#</th>
                            <th>{{ trans('employees-trans.Photo') }}</th>
                            <th>{{ trans('employees-trans.Name') }}</th>
                            <th>{{ trans('employees-trans.Email') }}</th>
                            <th>{{ trans('employees-trans.Code') }}</th>
                            <th>{{ trans('employees-trans.HireDate') }}</th>
                            <th>{{ trans('employees-trans.Location') }}</th>
                            <th>{{ trans('employees-trans.employee_department') }}</th>
                            <th>{{ trans('employees-trans.Manager') }}</th>
                            <th>{{trans('employees-trans.Processes')}}</th>



                            </tr>
                    </thead>
                    <tbody>

                        @if (isset($details))

                        <?php $List_Employees = $details; ?>

                       @else

                        <?php $List_Employees = $Employees; ?>
                       @endif

                        <?php $i = 0; ?>
                        @foreach ($List_Employees as $Employee)
                            <tr>
                                <?php $i++; ?>
                                <td><input type="checkbox"  value="{{ $Employee->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>@if (file_exists('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName))
                                    <img src='{{ URL::asset('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName) }}' height="80" width="80" alt="" />

                                 </td>

                                    @else
                                    <img src='{{ URL::asset('assets/images/385-3856300_no-avatar-png.png') }}' height="80" width="80"  id ="imagepreview" alt="Image Preview" />


                                 </td>

                                @endif
                                <td>{{ $Employee->FName }} {{ $Employee->LName }}</td>
                                <td>{{ $Employee->email }}</td>
                                <td>{{ $Employee->Code }}</td>
                                <td>{{ $Employee->HireDate }}</td>
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

                                    <div class="dropdown show">
                                        <a class="btn btn-secondary btn-sm dropdown-toggle" style="color: #ffffff" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('employees-trans.Processes')}}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{route('employee.show',$Employee->id)}}"><i style="color: #ffc107" class="fa fa-eye "></i>&nbsp; &nbsp;   {{trans('employees-trans.Show_Employee')}}</a>
                                            <a class="dropdown-item" href="{{route('employee.edit',$Employee->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp; &nbsp;  {{trans('employees-trans.edit_Employee')}}</a>

                                            @can(Permission::select("name->".\App::getLocale())->where('name->ar','دفع_سلفة')->first())

                                            <a class="dropdown-item" href="{{route('Show_Pay_Advance',$Employee->id)}}"><i style="color: #0000cc" class="fa fa-money"></i>&nbsp; &nbsp;  {{trans('salaries-trans.Pay_Advance')}}&nbsp;</a>

                                            @endcan
                                            <a class="dropdown-item"  class="btn btn-outline-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#delete{{ $Employee->id }}" role="button"><i style="color: red" class="fa fa-trash"></i>&nbsp; &nbsp;  {{trans('employees-trans.delete_Employee')}}</a>
                                        </div>
                                    </div>
                                 {{-- <div class="row ml-1">

                                    <a href="{{route('employee.edit',$Employee->id)}}"
                                       class="btn btn-outline-info btn-sm" role="button"><i class="fa fa-edit"></i></a>

                                    <a href="#"
                                       class="btn btn-outline-danger btn-sm"
                                       data-toggle="modal"
                                       data-target="#delete{{ $Employee->id }}" role="button"><i class="fa fa-trash"></i></a>

                                    <a href="{{route('employee.show',$Employee->id)}}" class="btn btn-outline-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>
                                  </div> --}}

                                </td>
                            </tr>
            <!-- delete_modal_Employee -->
            <div class="modal fade" id="delete{{ $Employee->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                               id="exampleModalLabel">
                               {{ trans('employees-trans.Delete') }}
                           </h5>
                           <button type="button" class="close" data-dismiss="modal"
                                   aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">
                           <form action="{{ route('employee.destroy','test') }}" method="POST">
                            {{ method_field('Delete') }}
                            @csrf
                               {{ trans('employees-trans.Warning_Employee') }}
                               <input id="id" type="hidden" name="id" class="form-control"
                                      value="{{ $Employee->id }}">
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


</tbody>

</table>

<button type="button" class="btn x-small  btn-danger " id="btn_delete_all">
{{ trans('employees-trans.delete_checkbox') }}
</button>
<br><br>
<br><br>
</div>
</div>
</div>
</div>


<!--delete_Group_Of_Employees -->
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

          <form action="{{ route('delete_all') }}" method="POST">
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
</script>
@endsection
