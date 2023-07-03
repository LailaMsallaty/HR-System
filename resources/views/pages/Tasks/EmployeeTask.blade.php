@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('tasks-trans.Employee_Tasks') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('tasks-trans.Employee_Tasks')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('Receive_Task.index')}}">{{trans('tasks-trans.Reseive_Task')}}</a></li>
               </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('tasks-trans.Employee_Tasks') }}
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


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

                                                    @if (isset($task->Received_Task_Attachment) && $task->Status == 0)
                                                    <div class="row ml-3">
                                                    <a href="{{url('ShowReceiveTask')}}/{{ $task->FName.'_'.$task->LName }}/{{$task->Received_Task_Attachment}}/{{$task->id}}" class="btn btn-outline-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>
                                                    <button type="button"  type="button" class="btn btn-outline-info btn-sm"  data-toggle="modal" data-target="#edit_task{{ $task->id }}" title="{{ trans('employees-trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                                    @elseif($task->Status == 1)
                                                    <a href="{{url('ShowTask')}}/{{ $task->FName.'_'.$task->LName }}/{{$task->Sent_Task_Attachment}}/{{$task->id}}" class="btn btn-outline-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>
                                                    @else
                                                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#add_task{{ $task->id }}" data-target="#exampleModal">
                                                        {{ trans('tasks-trans.Send_Required_Task') }}
                                                    </button>
                                                    </div>
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
        <form action="{{ route('Receive_Task.update','test') }}" enctype="multipart/form-data" method="POST">
                   {{ method_field('patch') }}
                   @csrf


                   <div class="row">
                    <div class="col">

                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">{{trans('tasks-trans.Comment')}}</div>
                            </div>
                            <textarea rows="5" cols="5" name="comment" class="form-control" id="inlineFormInputGroupUsername2" >{{ $task->Comment }}</textarea>
                            <input type="hidden" name="id" value="{{ $task->id }}">

                        </div>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label class="control-label" for="receive">{{trans('tasks-trans.Received_Task_Attachment')}} :  <span class="text-danger">*</span> </label><br>
                        <input required type="file" name="receive" value="{{ $task->Received_Task_Attachment }}">
                    </div>
               </div>
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

   {{--  add task  --}}
   <div class="modal fade" id="add_task{{ $task->id }}" tabindex="-1" role="dialog"
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
                                     <form action="{{ route('Receive_Task.store') }}" method="POST" enctype="multipart/form-data">
                                      {{ csrf_field() }}



                                      <div class="row">
                                          <div class="col">

                                              <div class="input-group mb-2 mr-sm-2">
                                                  <div class="input-group-prepend">
                                                  <div class="input-group-text">{{trans('tasks-trans.Comment')}}</div>
                                                  </div>
                                                  <textarea rows="5" cols="5" name="comment" class="form-control" id="inlineFormInputGroupUsername2" ></textarea>
                                                  <input type="hidden" name="id" value="{{ $task->id }}">

                                              </div>

                                          </div>
                                      </div>
                                      <br>
                                      <div class="row">
                                          <div class="col">
                                              <label class="control-label" for="receive">{{trans('tasks-trans.Received_Task_Attachment')}} :   <span class="text-danger">*</span></label><br>
                                              <input required type="file" name="receive" required>
                                          </div>
                                     </div>
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




                                        @endforeach
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render

@endsection
