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
                <li  class="breadcrumb-item active"><a href="{{route('Payments')}}">{{trans('salaries-trans.title_page')}}</a></li>
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
    <h4 class="grey-text text-darken-1">{{trans('awards-trans.Generate_Report')}}</h4>

    <br><br>
    <div class="card-panel ">
        <div class="card-panel ">

            <form action="{{route('PaymentReports')}}" method="POST"  enctype="multipart/form-data">
                @csrf
             <div class="form-group">
                <div class="row ">
                    <div class="col">
                        <label for="From"><strong>{{trans('attendance-trans.From')}} : </strong></label>
                        <input required type="date" name="From"  class="form-control form-control-lg " id="From">

                    </div>
                    <div class="col">
                        <label for="To"><strong>{{trans('attendance-trans.To')}} : </strong></label>
                        <input required type="date" name="To" class="form-control form-control-lg " id="To">

                    </div>
                    <div class="col">
                        <label for="location"><strong>{{trans('employees-trans.Location')}} : </strong></label>
                        <select required type="date" name="Location" class="form-control form-control-lg "  id="location">
                            <option value="0">{{trans('attendance-trans.All')}}</option>
                            @foreach($Locations as $location)
                                  <option value="{{ $location->id }}">{{ $location->Address }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col">
                        <label for="selection"><strong>{{trans('reports-trans.Filter')}} : </strong></label>
                        <select required type="date" name="selection" class="form-control form-control-lg "  id="selection">
                            <option value="1">{{trans('reports-trans.All_Paid')}}</option>
                            <option value="2">{{trans('reports-trans.Managers')}}</option>
                            <option value="3">{{trans('reports-trans.Employees_Not_Paid')}}</option>
                        </select>

                    </div>

                    <div class="col mt-2">
                     <button type="submit" name="action" value="search" class="mt-4 btn  btn-small"><img class="icon" src="{{ URL::asset('assets/images/5d6eea69216fc703baa30fe760deb138.jpg') }}" width="50" height="50" alt=""></button>
                     <button type="submit" name="action" value="report" class="mt-4 btn  btn-small"><img class="icon" src="{{ URL::asset('assets/images/file-icon/PDF.png') }}" width="50" height="50" alt=""></button>
                    </div>



                </div>
                </div>
                </form>

        </div>

    <br><br>


    @if (isset($salaries))
    <div class="table-responsive">

        <table id="datatable" class="table table-striped table-bordered p-0 " style="text-align: center">

         <thead>
            <tr class="table-secondary">
                                <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                <th>#</th>
                                <th>{{ trans('employees-trans.Name') }}</th>
                                <th>{{ trans('employees-trans.Code') }}</th>
                                <th>{{trans('salaries-trans.Initial_Salary')}}</th>
                                <th>{{trans('salaries-trans.Advance_Payments')}}</th>
                                <th>{{trans('salaries-trans.Taxes')}}</th>
                                <th>{{trans('salaries-trans.Insurance')}}</th>
                                <th>{{trans('salaries-trans.Bonus')}}</th>
                                <th>{{trans('salaries-trans.Total')}}</th>
                                <th>{{trans('salaries-trans.Date')}}</th>
                                <th>{{trans('employees-trans.Processes')}}</th>
                                <th>{{trans('salaries-trans.Print')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($salaries->count())

                            <?php $i = 0; ?>
                            @foreach($salaries as $Salary)

                                <tr>
                                <?php $i++; ?>
                                <td><input type="checkbox"  value="{{ $Salary->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>{{$Salary->FName}}  {{$Salary->LName}}</td>
                                <td>{{$Salary->Code}}</td>
                                <td>{{$Salary->Salary}}</td>
                                <td>{{$Salary->Sum_Advances}}</td>
                                <td>{{$Salary->Taxes}} %</td>
                                <td>{{$Salary->Insurance}} %</td>
                                <td>{{$Salary->Bonus}} %</td>
                                <td>{{ number_format($Salary->Total,2) }}</td>
                                <td>{{$Salary->created_at}}</td>
                                    <td>
                                        <div class="row ml-1">
                                            <a href="{{route('employeesalary.edit',$Salary->id)}}"
                                               class="btn btn-outline-info btn-sm" role="button"><i class="fa fa-edit"></i></a>

                                          </div>
                                    </td>
                                    <td>    <a  class="btn btn-light btn-sm"  href="{{route('print_slip',$Salary->id)}}"><i
                                        class="text-success fa fa-print"></i>&nbsp;&nbsp;{{trans('salaries-trans.Print_Slip')}}
                                        </a>
                                    </td>
                                </tr>

                        @endforeach
                        @else
                        {{-- if there are no employees then show this message --}}
                        <tr>
                            <td colspan="13"><h6 class="grey-text text-center">{{trans('attendance-trans.No_Employees_Found')}}</h6></td>
                        </tr>
                        @endif


</tbody>

</table>
<button type="button" class="btn x-small  btn-danger " id="btn_delete_all">
    {{ trans('employees-trans.delete_checkbox') }}
    </button>

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
</div>
        @else
                @include('pages.Reports.EmployeesNotPaidSearch')


        @endif
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

