<?php

use Spatie\Permission\Models\Permission;



 ?>
@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('salaries-trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('salaries-trans.title_page')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('employeesalary.index')}}">{{trans('salaries-trans.title_page')}}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('salaries-trans.title_page') }}
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
            @can(Permission::select("name->".\App::getLocale())->where('name->ar','دفع_راتب')->first())

            <button type="button" class="button x-small " ><a href="{{route('employeesalary.create')}}" >
                {{ trans('salaries-trans.Pay_Salary') }}
            </a></button>

            @endcan

               <br><br><br>

            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0 ">
                        <thead>
                            <tr>
                                @can(Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_حذف_راتب')->first())

                                <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>

                                @endcan
                                <th>#</th>
                                <th>{{ trans('employees-trans.Name') }}</th>
                                <th>{{ trans('employees-trans.Code') }}</th>
                                <th>{{trans('salaries-trans.Initial_Salary')}}</th>
                                <th>{{trans('salaries-trans.Advance_Payments')}}</th>
                                <th>{{trans('salaries-trans.Taxes')}}</th>
                                <th>{{trans('salaries-trans.Insurance')}}</th>
                                <th>{{trans('salaries-trans.Bonus')}}</th>
                                <th>{{trans('salaries-trans.Total')}}</th>
                                <th>{{ trans('leaves-trans.Date_From') }}</th>
                                <th>{{ trans('leaves-trans.Date_To') }}</th>
                                <th>{{trans('salaries-trans.Date')}}</th>
                                <th>{{trans('employees-trans.Processes')}}</th>
                                <th>{{trans('salaries-trans.Print')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 0; ?>
                            @foreach($Salaries as $Salary)

                                <tr>
                                <?php $i++; ?>
                                @can(Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_حذف_راتب')->first())

                                <td><input type="checkbox"  value="{{ $Salary->id }}" class="box1" ></td>

                                @endcan
                                <td>{{ $i }}</td>
                                <td>{{$Salary->FName}}  {{$Salary->LName}}</td>
                                <td>{{$Salary->Code}}</td>
                                <td>{{$Salary->Salary}}</td>
                                <td>{{$Salary->Sum_Advances}}</td>
                                <td>{{$Salary->Taxes}} %</td>
                                <td>{{$Salary->Insurance}} %</td>
                                <td>{{$Salary->Bonus}} %</td>
                                <td>{{ number_format($Salary->Total,2) }}</td>
                                <td class="text-center">{{$Salary->Start_Date}}</td>
                                <td class="text-center">{{$Salary->End_Date}}</td>
                                <td>{{$Salary->created_at}}</td>

                                    <td>
                                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_حذف_راتب')->first())

                                            <div class="row ml-1">
                                                <a href="{{route('employeesalary.edit',$Salary->id)}}"
                                                class="btn btn-outline-info btn-sm" role="button"><i class="fa fa-edit"></i></a>

                                                <a href="#"
                                                class="btn btn-outline-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#delete{{ $Salary->id }}" role="button"><i class="fa fa-trash"></i></a>

                                            </div>
                                        @endcan
                                    </td>
                                    <td>    <a  class="btn btn-light btn-sm"  href="{{route('print_slip',$Salary->id)}}"><i
                                        class="text-success fa fa-print"></i>&nbsp;&nbsp;{{trans('salaries-trans.Print_Slip')}}
                                        </a>
                                    </td>
                                </tr>
            <!-- delete_modal_Employee -->
            <div class="modal fade" id="delete{{$Salary->id }}" tabindex="-1" role="dialog"
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
                           <form action="{{ route('employeesalary.destroy','test') }}" method="POST">
                            {{ method_field('Delete') }}
                            @csrf
                               {{ trans('salaries-trans.Warning_Delete') }}
                               <input id="id" type="hidden" name="id" class="form-control"
                                      value="{{ $Salary->id }}">
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
@can(Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_حذف_راتب')->first())

<button type="button" class="btn x-small  btn-danger " id="btn_delete_all">
    {{ trans('employees-trans.delete_checkbox') }}
    </button>
@endcan
<br><br>
<br><br>

<!--delete_Group_Of_Salaries-->
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

       <form action="{{ route('delete_all_Salaries') }}" method="POST">
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

