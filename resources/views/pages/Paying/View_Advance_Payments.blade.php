@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{trans('salaries-trans.Advance_Payments')}}
@stop
@endsection
@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('View_Advances')}}">{{trans('salaries-trans.Advance_Payments')}}</a></li>
            </ol>
        </div>
    </div>
</div>
@section('PageTitle')
{{trans('salaries-trans.Advance_Payments')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
    <h4 class="grey-text text-darken-1">{{trans('awards-trans.Generate_Report')}}</h4>

    <br><br>
    <div class="card-panel ">

        <form action="{{route('PaymentReports.make')}}" method="POST"  enctype="multipart/form-data">
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
                        @foreach($locations as $location)
                              <option value="{{ $location->id }}">{{ $location->Address }}</option>
                        @endforeach
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
    <!-- Show All Employee List as a Card -->
            <!-- Table that shows Employee List -->
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0 " style="text-align: center">
                 <thead>
                    <tr class="table-secondary">
                        <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                        <th scope="col">#</th>
                        <th scope="col">{{ trans('employees-trans.Name') }}</th>
                        <th scope="col">{{ trans('employees-trans.Code') }}</th>
                        <th scope="col">{{trans('salaries-trans.Initial_Salary')}}</th>
                        <th scope="col">{{trans('salaries-trans.Amount')}}</th>
                        <th scope="col">{{trans('salaries-trans.Remaining_Amount')}}</th>
                        <th scope="col">{{trans('employees-trans.created_at')}}</th>
                        <th scope="col">{{trans('employees-trans.updated_at')}}</th>
                        <th scope="col">{{trans('salaries-trans.Statement')}}</th>
                        <th scope="col">{{trans('employees-trans.Processes')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Check if there are any employee to render in view -->
                    @if($advances->count())
                    <?php $i = 0; ?>
                        @foreach($advances as $advance)
                            <tr style='text-align:center;vertical-align:middle'>
                                <td><input type="checkbox"  value="{{ $advance->id }}" class="box1" ></td>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $advance->employee->FName }} {{ $advance->employee->LName }}</td>
                                <td>{{$advance->employee->Code}}</td>
                                <td>{{$advance->Previous_Salary}}</td>
                                <td>{{$advance->Advance_Amount}}</td>
                                <td>{{$advance->Remaining_Amount}}</td>
                                <td>{{$advance->created_at->diffForHumans()}}</td>
                                <td>{{$advance->updated_at->diffForHumans()}}</td>
                                <td>{{$advance->Statement}}</td>
                                <td colspan="2">
                                    <a class="btn btn-outline-info btn-sm"
                                       href="{{ url('edit_employee_advance')}}/{{$advance->id}}/{{ $advance->employee->id }}"
                                       role="button"><i class="fa fa-edit"></i>&nbsp; {{trans('salaries-trans.Edit_Advance')}}</a>


                                </td>
                            </tr>
                          @endforeach
                    @else
                        {{-- if there are no employees then show this message --}}
                        <tr>
                            <td colspan="12"><h6 class="grey-text text-darken-2 center">{{trans('attendance-trans.No_Employees_Found')}}</h6></td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <button type="button" class="btn x-small  btn-danger " id="btn_delete_all">
                {{ trans('employees-trans.delete_checkbox') }}
                </button>


                <!--delete_Group_Of_salariess -->
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

       <form action="{{ route('delete_all_AdvancePayments') }}" method="POST">
        {{ csrf_field() }}

           <div class="modal-body">
               {{ trans('salaries-trans.Warning_Delete') }}
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
            <!-- employees Table END -->
            </div>
        <!-- Show Pagination Links -->
            </div>
        </div>
    </div>

<!-- Card END -->
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
