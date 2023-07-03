@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('leaves-trans.Leave_Request') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('leaves-trans.Leave_Request')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('Leave_Request.index')}}">{{trans('leaves-trans.Leave_Request')}}</a></li>
               </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('leaves-trans.Leave_Request') }}
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('leaves-trans.Leave_Request') }}
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
                                        @foreach($employee_Leaves as $Leave)
                                            <tr>
                                                <?php $i++; ?>
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
                                                    @if($Leave->Status == 0)

                                                    <button type="button"  type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#edit_Request{{ $Leave->id }}" title="{{ trans('employees-trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_Request{{ $Leave->id }}" title="{{ trans('employees-trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                    @else
                                                    {{ trans('leaves-trans.Done') }}
                                                    @endif
                                                </td>
                                            </tr>


{{--  edit leave request  --}}

 <div class="modal fade" id="edit_Request{{ $Leave->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   {{ trans('leaves-trans.Edit_Request') }}
               </h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">

               <!-- edit_form -->
        <form action="{{ route('Leave_Request.update','test') }}" method="POST">
                   {{ method_field('patch') }}
                   @csrf
          <div class="row">
             <div class="col">

                        <label class="control-label" for="leave"
                        class="mr-sm-2">{{ trans('leaves-trans.Leave_Type') }}
                        : <span class="text-danger">*</span></label>
                        <select class="form-control form-control-lg" name="leaveType" id="">
                                    @foreach($leaves as $leave)
                                    <option value="{{ $leave->id }}" @if ($Leave->Name == $leave->Name)
                                        selected
                                    @endif >
                                        {{ $leave->Name }}
                                    </option>
                                    @endforeach

                        </select>

            </div>
          </div>
          <br>
            <div class="row">
                    <div class="col">

                        <label class="control-label" for="From"><strong>{{trans('attendance-trans.From')}} : </strong></label>
                        <input type="date" name="From"  class="form-control form-control-lg " id="From" value="{{ $Leave->Start_Date }}">
                    </div>
                    <div class="col">
                        <label class="control-label" for="To"><strong>{{trans('attendance-trans.To')}} : </strong></label>
                        <input type="date" name="To" class="form-control form-control-lg " id="To" value="{{ $Leave->End_Date }}">
                        <input type="hidden" name="id" value="{{ $Leave->id }}">
                    </div>
            </div>
                <br>
                <br>





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

                               <div class="modal fade" id="delete_Request{{$Leave->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{route('Leave_Request.destroy','test')}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('leaves-trans.Delete_Request') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p> {{ trans('employees-trans.Warning_Delete') }}</p>
                                            <input type="hidden" name="id"  value="{{$Leave->id}}">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



     {{--  add leave  --}}
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                                     {{ trans('leaves-trans.Add_Request') }}
                                       </h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body "  >
                                       <!-- add_form -->
                                       <form action="{{ route('Leave_Request.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                                <div class="col">

                                                    <label for="leave"
                                                    class="mr-sm-2 control-label">{{ trans('leaves-trans.Leave_Type') }}
                                                    : <span class="text-danger">*</span></label>
                                         <select class="form-control form-control-lg"
                                           name="leaveType" id="">
                                           <option value="">...</option>
                                                    @foreach($leaves as $leave)
                                                       <option value="{{ $leave->id }}">{{ $leave->Name }}</option>
                                                    @endforeach

                                         </select>
                                                </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                                <div class="col">

                                                    <label class="control-label" for="From"><strong>{{trans('attendance-trans.From')}} : <span class="text-danger">*</span></strong></label>
                                                    <input type="date" name="From"  class="form-control form-control-lg " id="From">
                                                </div>
                                                <div class="col">
                                                    <label class="control-label" for="To"><strong>{{trans('attendance-trans.To')}} : <span class="text-danger">*</span></strong></label>
                                                    <input type="date" name="To" class="form-control form-control-lg " id="To">

                                                </div>
                                        </div>
                                        <br>
                                        <br>





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
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
