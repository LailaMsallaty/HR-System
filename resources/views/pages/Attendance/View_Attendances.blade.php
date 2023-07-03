@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{trans('attendance-trans.List_Attendance')}}
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
                <li  class="breadcrumb-item active"><a href="{{route('View_Attendances')}}">{{trans('attendance-trans.View_Attendances')}}</a></li>
            </ol>
        </div>
    </div>
</div>
@section('PageTitle')
{{trans('attendance-trans.List_Attendance')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
    <h4 class="grey-text text-darken-1">{{trans('attendance-trans.Generate_Report')}}</h4>

    <br><br>
    <div class="card-panel ">

        <form action="{{route('reports.make')}}" method="POST"  enctype="multipart/form-data">
            @csrf
         <div class="form-group">
            <div class="row ">
                <div class="col">
                    <label for="From"><strong>{{trans('attendance-trans.From')}} : </strong></label>
                    <input type="date" name="From"  class="form-control form-control-lg " id="From">

                </div>
                <div class="col">
                    <label for="To"><strong>{{trans('attendance-trans.To')}} : </strong></label>
                    <input type="date" name="To" class="form-control form-control-lg " id="To">

                </div>
                <div class="col">
                    <label for="location"><strong>{{trans('employees-trans.Location')}} : </strong></label>
                    <select type="date" name="Location" class="form-control form-control-lg "  id="location">
                        <option value="0">{{trans('attendance-trans.All')}}</option>
                        @foreach($locations as $location)
                              <option value="{{ $location->id }}">{{ $location->Address }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col">
                    <label for="selection"><strong>{{trans('reports-trans.Filter')}} : </strong></label>
                    <select required  name="selection" class="form-control form-control-lg "  id="selection">
                        <option value="0">{{trans('attendance-trans.All')}}</option>
                        <option value="1">{{trans('attendance-trans.Present')}}</option>
                        <option value="2">{{trans('attendance-trans.Absent')}}</option>
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
                    <tr>
                        <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
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
                    <!-- Check if there are any employee to render in view -->
                    @if($employees->count())
                    <?php $i = 0; ?>
                        @foreach($employees as $Employee)

                            <tr>
                                <?php $i++; ?>
                                <td><input type="checkbox"  value="{{ $Employee->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>{{ $Employee->employee->FName }} {{ $Employee->employee->LName }}</td>
                                <td>{{ $Employee->employee->Code }}</td>
                                <td>{{ $Employee->employee->email }}</td>
                                <td>{{ $Employee->employee->location->Address }}</td>
                                <td>{{ $Employee->employee->department->Name }}</td>

                                <td>
                                    @if ($Employee->employee->Manager === 1)
                                        <label
                                            class="badge badge-success" style="background-color: #8b008b">{{ trans('employees-trans.Is_Manager') }}
                                        </label>
                                    @else
                                        <label
                                            class="badge badge-info">{{ trans('employees-trans.Employee') }}</label>
                                    @endif

                                </td>

                                <td>
                                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                            <input name="attendences[{{ $Employee->id }}]" disabled
                                                   {{ $Employee->attendance_status == 1 ? 'checked' : '' }}
                                                   class="leading-tight" type="radio" value="presence">
                                            <span class="text-success"> {{trans('attendance-trans.Present')}}</span>
                                        </label>

                                        <label class="ml-4 block text-gray-500 font-semibold">
                                            <input name="attendences[{{ $Employee->id }}]" disabled
                                                   {{ $Employee->attendance_status == 0 ? 'checked' : '' }}
                                                   class="leading-tight" type="radio" value="absent">
                                            <span style="color:#8b008b"> {{trans('attendance-trans.Absent')}}</span>
                                        </label>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        {{-- if there are no employees then show this message --}}
                        <tr>
                            <td colspan="9"><h6 class="grey-text text-darken-2 center">{{trans('attendance-trans.No_Employees_Found')}}</h6></td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <button type="button" class="btn x-small  btn-danger " id="btn_delete_all">
                {{ trans('employees-trans.delete_checkbox') }}
                </button>


                <!--delete_Group_Of_Attendances -->
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

       <form action="{{ route('delete_all_Attendances') }}" method="POST">
           {{ csrf_field() }}

           <div class="modal-body">
               {{ trans('attendance-trans.Warning_Delete') }}
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
