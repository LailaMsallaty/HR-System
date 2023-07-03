@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('tasks-trans.Employees_Tasks') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('tasks-trans.Employees_Tasks')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('Send_Task.index')}}">{{trans('tasks-trans.Send_Task')}}</a></li>
               </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('tasks-trans.Send_Task') }}
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('tasks-trans.Send_Task') }}
                     </button>
<br><br>

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-secondary">
                                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                            <th>#</th>
                                            <th>{{ trans('tasks-trans.Employee') }}</th>
                                            <th>{{ trans('employees-trans.Code') }}</th>
                                            <th>{{ trans('tasks-trans.Task_Type') }}</th>
                                            {{-- <th>{{ trans('tasks-trans.Description') }}</th> --}}
                                            <th>{{ trans('tasks-trans.Sent_Task_Attachment') }}</th>
                                            <th>{{ trans('tasks-trans.Received_Task_Attachment') }}</th>
                                            <th>{{ trans('tasks-trans.Comment') }}</th>
                                            <th>{{ trans('tasks-trans.Status') }}</th>
                                            <th>{{ trans('tasks-trans.Duration') }}</th>
                                            <th>{{ trans('tasks-trans.Created_At') }}</th>
                                            <th>{{trans('tasks-trans.Processes')}}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                  <?php $i = 0; ?>
                                        @foreach($employee_tasks as $task)
                                            <tr>
                                                <?php $i++; ?>
                                                <td><input type="checkbox"  value="{{ $task->id }}" class="box1" ></td>
                                                <td>{{ $i }}</td>
                                                <td>{{ $task->FName }} {{ $task->LName }}</td>
                                                <td>{{ $task->Code }}</td>
                                                <td>{{ $task->Title }}</td>
                                                {{-- <td>{{ $task->Description }}</td> --}}
                                                <td> <a class="btn btn-outline-warning btn-sm"
                                                    href="{{url('Download_Task')}}/{{ $task->FName.'_'.$task->LName }}/{{$task->Sent_Task_Attachment}}"
                                                    role="button"><i class="fa fa-download"></i>&nbsp; {{trans('employees-trans.Download')}}</a>
                                                </td>
                                                <td>
                                                    @if ($task->Received_Task_Attachment)
                                                    <a class="btn btn-outline-warning btn-sm"
                                                    href="{{url('Download_Receive_Task')}}/{{ $task->FName.'_'.$task->LName }}/{{$task->Received_Task_Attachment}}"
                                                    role="button"><i class="fa fa-download"></i>&nbsp; {{trans('employees-trans.Download')}}</a>
                                                    @else
                                                    <label class="badge badge-secondary">{{ trans('tasks-trans.Pending') }}</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $task->Comment }}
                                                </td>

                                                <td>
                                                    @if ( $task->Status == 0 )
                                                    <label class="badge badge-secondary">{{ trans('tasks-trans.Pending') }}</label>
                                                    @elseif($task->Status == 1)
                                                    <label class="badge badge-success" >{{ trans('tasks-trans.Accepted') }}</label>
                                                    @else
                                                    <label class="badge badge-danger">{{ trans('tasks-trans.Rejected') }}</label>
                                                    @endif

                                                  </td>

                                                <td>{{ $task->Duration }}</td>

                                                <td>{{$task->created_at->diffForHumans()}}</td>

                                                <td>
                                                    @if($task->Status == 0 && $task->Received_Task_Attachment =='')

                                                    <div class="row justify-content-center">
                                                    <button type="button"  type="button" class="btn btn-outline-info btn-sm"  data-toggle="modal" data-target="#edit_task{{ $task->id }}" title="{{ trans('employees-trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete_task{{ $task->id }}" title="{{ trans('employees-trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                    <a href="{{url('ShowTask')}}/{{ $task->FName.'_'.$task->LName }}/{{$task->Sent_Task_Attachment}}/{{$task->id}}" class="btn btn-outline-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>
                                                    </div>
                                                    @elseif(isset($task->Received_Task_Attachment) && $task->Status == 0)

                                                    <form name="post_action" method="POST" action="{{ route('Accept_Reject_Task') }}" id="post_action">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $task->id }}">
                                                        <button type="submit" name="action" value="accept" class="btn btn-outline-info btn-sm accept-button">{{ trans('requests-trans.Accept') }}</button>
                                                        <button type="submit" name="action" value="reject" class="btn btn-outline-warning btn-sm reject-button">{{ trans('requests-trans.Reject') }}</button>
                                                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete_task{{ $task->id }}" title="{{ trans('employees-trans.Delete') }}">{{ trans('employees-trans.Delete') }}</i></button>

                                                    </form>

                                                    @else
                                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete_task{{ $task->id }}" title="{{ trans('employees-trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                    <a href="{{url('ShowReceiveTask')}}/{{ $task->FName.'_'.$task->LName }}/{{$task->Received_Task_Attachment}}/{{$task->id}}" class="btn btn-outline-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>
                                                    @endif
                                                </td>
                                            </tr>


{{--  edit task task  --}}

 <div class="modal fade" id="edit_task{{ $task->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   {{ trans('tasks-trans.Edit_Task') }}
               </h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">

               <!-- edit_form -->
        <form action="{{ route('Send_Task.update','test') }}" enctype="multipart/form-data" method="POST">
                   {{ method_field('patch') }}
                   @csrf
          <div class="row">
            <div class="col">
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                    <div class="input-group-text">{{trans('tasks-trans.Location')}}  &nbsp;  <span class="text-danger">*</span></div>
                    </div>
             <select class="form-control  form-control-lg p-10" required
             id="exampleFormControlSelect1" name="location" onclick="console.log($(this).val())">
                @foreach ($Locations as $Location)
                    <option value="{{ $Location->id }}" @if($task->Location_Id == $Location->id)
                        selected
                    @endif>
                        {{ $Location->Address }}
                    </option>
                @endforeach
             </select>
             <input type="hidden" name="id" value="{{ $task->id }}">
                </div>
            </div>
          </div>
          <br>
          <div class="row">

            <div class="col">
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend ">
                    <div class="input-group-text">{{trans('awards-trans.Employee')}}  &nbsp;  <span class="text-danger">*</span></div>
                    </div>
                    <select name="employee" required  class="form-control form-control-lg p-10" class="custom-select" >


                    @foreach($employees->where('Location_Id',$task->Location_Id) as $employee)
                    <option  value="{{$employee->id}}"
                        @if($task->EmployeeID == $employee->id)
                        selected
                        @endif
                       >{{$employee->FName}} {{$employee->LName}}</option>

               @endforeach
                </select>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                    <div class="input-group-text">{{trans('tasks-trans.Task_Type_English')}}  &nbsp;  <span class="text-danger">*</span></div>
                    </div>
                    <input type="text" name="title_en" required class="form-control" id="inlineFormInputGroupUsername2" value="{{ $task->getTranslation('Title','en') }}" >
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                    <div class="input-group-text">{{trans('tasks-trans.Task_Type_Arabic')}}  &nbsp;  <span class="text-danger">*</span></div>
                    </div>
                    <input type="text" name="title_ar" required class="form-control" id="inlineFormInputGroupUsername2" value="{{ $task->getTranslation('Title','ar') }}" >
                </div>
            </div>
        </div>
        <br>
        <label for=""
        class="mr-sm-2">{{ trans('tasks-trans.Duration') }}
     :  <span class="text-danger">*</span></label>
        <div class="row">
            <div class="col">
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                    <div class="input-group-text">{{trans('attendance-trans.From')}}    &nbsp;  <span class="text-danger">*</span></div>
                    </div>
                    <input required type="date" name="From" class="form-control" id="inlineFormInputGroupUsername2" value="{{ $task->Start_Date }}" >
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                    <div class="input-group-text">{{trans('attendance-trans.To')}}    &nbsp;   <span class="text-danger">*</span></div>
                    </div>
                    <input required type="date" name="To" class="form-control" id="inlineFormInputGroupUsername2" value="{{ $task->End_Date }}"  >
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">

                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                    <div class="input-group-text">{{trans('tasks-trans.Description')}}</div>
                    </div>
                    <textarea rows="3" cols="5" name="description" class="form-control" id="inlineFormInputGroupUsername2" >{{ $task->Description }}</textarea>
                </div>

            </div>
        </div>

                <br>
                <br>
                <div class="row">

                    <div class="col">
                        <label class="control-label" for="statement">{{trans('tasks-trans.Sent_Task_Attachment')}}  :   &nbsp;  <span class="text-danger">*</span> </label><br>
                        <input type="file" name="sent" value="{{ $task->Sent_Task_Attachment }}">
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
           {{-- delete location --}}
           <div class="modal fade" id="delete_task{{ $task->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                                    <form action="{{route('Send_Task.destroy','test')}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('tasks-trans.Delete_Task') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p> {{ trans('employees-trans.Warning_Delete') }}</p>
                                            <input type="hidden" name="id"  value="{{$task->id}}">
                                            <input type="hidden" name="FName" value="{{ $task->FName }}">
                                            <input type="hidden" name="LName" value="{{ $task->LName }}">
                                        </div>
                                        <div class="modal-footer">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('employees-trans.Close') }}</button>
                                                <button type="submit"
                                                        class="btn btn-danger">{{ trans('employees-trans.Submit') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>



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
                </div>
            </div>
        </div>
    </div>



     {{--  add task  --}}
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                                     {{ trans('tasks-trans.Send_Task') }}
                                       </h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body "  >
                                       <!-- add_form -->
                                       <form action="{{ route('Send_Task.store') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group mb-2 mr-sm-2 ">
                                                    <div class="input-group-prepend">
                                                    <div class="input-group-text">{{trans('tasks-trans.Location')}} &nbsp;  <span class="text-danger">*</span></div>
                                                    </div>
                                             <select class="form-control  form-control-lg p-10" required
                                             id="exampleFormControlSelect1" name="location" onclick="console.log($(this).val())">
                                                @foreach ($Locations as $Location)
                                                    <option value="{{ $Location->id }}" >
                                                        {{ $Location->Address }}
                                                    </option>
                                                @endforeach
                                             </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>


                                    <div class="row">

                                        <div class="col">
                                            <div class="input-group mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text">{{trans('awards-trans.Employee')}} &nbsp;  <span class="text-danger">*</span></div>
                                                </div>
                                            <select name="employee" required  class="form-control form-control-lg p-10" class="custom-select" >

                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                        <br>

                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                    <div class="input-group-text">{{trans('tasks-trans.Task_Type_English')}} &nbsp;  <span class="text-danger">*</span></div>
                                                    </div>
                                                    <input type="text" required name="title_en" class="form-control" id="inlineFormInputGroupUsername2"  >
                                                    <input type="hidden" name="Sender_id" value="{{ \Auth::user()->employee->id }}" class="form-control" >

                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                    <div class="input-group-text">{{trans('tasks-trans.Task_Type_Arabic')}} &nbsp;  <span class="text-danger">*</span></div>
                                                    </div>
                                                    <input type="text" required name="title_ar" class="form-control" id="inlineFormInputGroupUsername2"  >
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <label for=""
                                        class="mr-sm-2">{{ trans('tasks-trans.Duration') }}
                                     :  <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                    <div class="input-group-text">{{trans('attendance-trans.From')}}     &nbsp;  <span class="text-danger">*</span></div>
                                                    </div>
                                                    <input type="date" required name="From" class="form-control" id="inlineFormInputGroupUsername2" >
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                    <div class="input-group-text">{{trans('attendance-trans.To')}}     &nbsp;   <span class="text-danger">*</span></div>
                                                    </div>
                                                    <input type="date" required name="To" class="form-control" id="inlineFormInputGroupUsername2"   >
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">

                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                    <div class="input-group-text">{{trans('tasks-trans.Description')}}</div>
                                                    </div>
                                                    <textarea rows="3" cols="5" name="description" class="form-control" ></textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">

                                                <div class="col">
                                                    <label class="control-label" for="statement">{{trans('tasks-trans.Sent_Task_Attachment')}} :  <span class="text-danger">*</span></label><br>
                                                    <input type="file" required name="sent">
                                           </div>
                                        </div>
                                        <br>
                                        <br>







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

    <!--delete_Group_Of_Tasks -->
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

       <form action="{{ route('delete_all_Employee_Tasks') }}" method="POST">
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
                $('select[name="location"]').on('click', function () {
                    var location_id = $(this).val();
                    if (location_id) {
                        $.ajax({
                            url: "{{ URL::to('Location_employees') }}/" + location_id,
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
