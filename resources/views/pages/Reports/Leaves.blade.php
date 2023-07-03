@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('leaves-trans.Employee_Leave_Requests') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('leaves-trans.Employee_Leave_Requests')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('Employee_Leave_Requests')}}">{{trans('leaves-trans.Employee_Leave_Requests')}}</a></li>
               </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('leaves-trans.Employee_Leave_Requests') }}
@stop
@section('content')
<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
    <h4 class="grey-text text-darken-1">{{trans('awards-trans.Generate_Report')}}</h4>

    <br><br>
    <div class="card-panel ">
        <div class="card-panel ">

            <form action="{{route('LeaveReports')}}" method="POST"  enctype="multipart/form-data">
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
                        <label for="location"><strong>{{trans('Reports-trans.Leaves')}} : </strong></label>
                        <select required type="date" name="Leave" class="form-control form-control-lg "  id="location">
                            <option value="0">{{trans('attendance-trans.All')}}</option>
                            @foreach($leaves as $leave)
                                  <option value="{{ $leave->id }}">{{ $leave->Name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col">
                        <label for="selection"><strong>{{trans('reports-trans.Filter')}} : </strong></label>
                        <select required type="date" name="selection" class="form-control form-control-lg "  id="selection">
                            <option value="0">{{trans('reports-trans.Accepted')}}</option>
                            <option value="1">{{trans('reports-trans.Rejected')}}</option>
                            <option value="2">{{trans('reports-trans.Pending')}}</option>
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
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-secondary">

                                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                            <th>#</th>
                                            <th>{{ trans('leaves-trans.Employee') }}</th>
                                            <th>{{ trans('employees-trans.Code') }}</th>
                                            <th>{{ trans('leaves-trans.Leave_Type') }}</th>
                                            <th>{{ trans('leaves-trans.Date_From') }}</th>
                                            <th>{{ trans('leaves-trans.Date_To') }}</th>
                                            <th>{{ trans('leaves-trans.Duration') }}</th>
                                            <th>{{ trans('leaves-trans.Status') }}</th>
                                            <th>{{ trans('leaves-trans.Created_At') }}</th>
                                            <th>{{trans('leaves-trans.Processes')}}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                <?php $i = 0; ?>
                                        @foreach($Leaves as $Leave)
                                            <tr>
                                                <?php $i++; ?>
                                                <td><input type="checkbox"  value="{{ $Leave->id }}" class="box1" ></td>
                                                <td>{{ $i }}</td>
                                                <td>{{ $Leave->FName }} {{ $Leave->LName }}</td>
                                                <td>{{ $Leave->Code }}</td>
                                                <td>{{ $Leave->Name }}</td>
                                                <td>{{ $Leave->Start_Date }}</td>
                                                <td>{{ $Leave->End_Date }}</td>
                                                <td>{{ $Leave->TotalDays }}</td>
                                                <td>
                                                    @if ( $Leave->Status == 0)
                                                    <label class="badge badge-secondary">{{ trans('leaves-trans.Pending') }}</label>
                                                    @elseif($Leave->Status == 1)
                                                    <label class="badge badge-success" >{{ trans('leaves-trans.Acceptable') }}</label>
                                                    @else
                                                    <label class="badge badge-danger">{{ trans('leaves-trans.Rejected') }}</label>
                                                    @endif

                                                </td>
                                                <td>{{ $Leave->created_at }}</td>

                                                <td>
                                                @if ($Leave->Status == 0)
                                                <form name="post_action" method="POST" action="{{ route('Accept_Reject_Leave_Request') }}" id="post_action">
                                                    @csrf
                                                    <button type="submit"name="action" value="accept" class="btn btn-outline-info btn-sm accept-button">{{ trans('leaves-trans.Accept') }}</button>
                                                    <button type="submit" name="action" value="reject" class="btn btn-outline-danger btn-sm reject-button">{{ trans('leaves-trans.Reject') }}</button>
                                                    <input type="hidden" name="id" value="{{ $Leave->id }}">
                                                </form>
                                                @else
                                                {{ trans('leaves-trans.Done') }}
                                                @endif
                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>

                                    <button type="button" class="btn x-small  btn-danger " id="btn_delete_all">
                                        {{ trans('employees-trans.delete_checkbox') }}
                                        </button>
                                </div>
                            </div>
                        </div>
                    </div>


    <!--delete_Group_Of_Requests -->
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

       <form action="{{ route('delete_all_Requests') }}" method="POST">
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
</div></div>
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

    </script>
@endsection
