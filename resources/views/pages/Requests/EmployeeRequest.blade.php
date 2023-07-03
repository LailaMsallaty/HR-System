@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('requests-trans.Employee_Requests') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('requests-trans.Employee_Requests')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('Send_Request.index')}}">{{trans('requests-trans.Employee_Requests')}}</a></li>
               </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('requests-trans.Employee_Requests') }}
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('requests-trans.Send_Request') }}
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
                                            <th>{{ trans('requests-trans.Employee') }}</th>
                                            <th>{{ trans('employees-trans.Code') }}</th>
                                            <th>{{ trans('requests-trans.Request_Type') }}</th>
                                            <th>{{ trans('requests-trans.Statement') }}</th>
                                            <th>{{ trans('requests-trans.Status') }}</th>
                                            <th>{{ trans('requests-trans.Created_At') }}</th>
                                            <th>{{trans('requests-trans.Processes')}}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                        @foreach($employee_requests as $request)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{ $request->FName }} {{ $request->LName }}</td>
                                                <td>{{ $request->Code }}</td>
                                                <td>{{ $request->Name }}</td>
                                                <td><a class="btn btn-outline-warning btn-sm"
                                                    href="{{url('Download_Statement')}}/{{ $request->FName.'_'.$request->LName }}/{{$request->Statement}}"
                                                    role="button"><i class="fa fa-download"></i>&nbsp; {{trans('employees-trans.Download')}}</a>
                                                </td>
                                                <td>
                                                    @if ( $request->Status == 0)
                                                    <label class="badge badge-secondary">{{ trans('requests-trans.Pending') }}</label>
                                                    @elseif($request->Status == 1)
                                                    <label class="badge badge-success" >{{ trans('requests-trans.Accepted') }}</label>
                                                    @else
                                                    <label class="badge badge-danger">{{ trans('requests-trans.Rejected') }}</label>
                                                    @endif

                                                </td>
                                                <td>{{$request->created_at->diffForHumans()}}</td>

                                                <td>
                                                    @if($request->Status == 0)

                                                    <button type="button"  type="button" class="btn btn-outline-info btn-sm"  data-toggle="modal" data-target="#edit_Request{{ $request->id }}" title="{{ trans('employees-trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete_Request{{ $request->id }}" title="{{ trans('employees-trans.Delete') }}"><i class="fa fa-trash"></i></button>

                                                    <a href="{{url('ShowRequest')}}/{{ $request->FName.'_'.$request->LName }}/{{$request->Statement}}/{{$request->id}}" class="btn btn-outline-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>

                                                    @else
                                                    {{ trans('requests-trans.Done') }} &nbsp;
                                                    @if ( isset($request->Reply_Statement))
                                                    <a href="{{url('ShowReply')}}/{{ $request->FName.'_'.$request->LName }}/{{$request->Reply_Statement}}/{{$request->id}}" class="btn btn-outline-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>
                                                    @endif
                                                    @endif
                                                </td>
                                            </tr>


{{--  edit request request  --}}

 <div class="modal fade" id="edit_Request{{ $request->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   {{ trans('requests-trans.Edit_Request') }}
               </h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">

               <!-- edit_form -->
        <form action="{{ route('Send_Request.update','test') }}" enctype="multipart/form-data" method="POST">
                   {{ method_field('patch') }}
                   @csrf
          <div class="row">
             <div class="col">

                        <label class="control-label" for="request"
                        class="mr-sm-2">{{ trans('requests-trans.Request_Type') }}
                        : <span class="text-danger">*</span></label>
                        <select class="form-control form-control-lg" name="requestType" id="" required>
                                    @foreach($requests as $Request)
                                    <option value="{{ $Request->id }}" @if ($Request->Name == $request->Name)
                                        selected
                                    @endif >
                                        {{ $Request->Name }}
                                    </option>
                                    @endforeach

                        </select>

            </div>
          </div>
          <br>
            <div class="row">
                    <div class="col">
                        <label class="control-label" for="statement"><strong>{{trans('requests-trans.Statement')}} : </strong></label>
                        <input type="file"  name="statement"  value="{{ $request->Statement }}">
                        <input type="hidden" name="id" value="{{ $request->id }}">
                        <input type="hidden" name="FName" value="{{ $request->FName }}">
                        <input type="hidden" name="LName" value="{{ $request->LName }}">
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
           <div class="modal fade" id="delete_Request{{ $request->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                                    <form action="{{route('Send_Request.destroy','test')}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('requests-trans.Delete_Request') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p> {{ trans('employees-trans.Warning_Delete') }}</p>
                                            <input type="hidden" name="id"  value="{{$request->id}}">
                                            <input type="hidden" name="FName" value="{{ $request->FName }}">
                                            <input type="hidden" name="LName" value="{{ $request->LName }}">
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



     {{--  add request  --}}
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                                     {{ trans('requests-trans.Add_Request') }}
                                       </h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body "  >
                                       <!-- add_form -->
                                       <form action="{{ route('Send_Request.store') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                                <div class="col">

                                                    <label for="request"
                                                    class="mr-sm-2 control-label">{{ trans('requests-trans.Request_Type') }}
                                                    : <span class="text-danger">*</span></label>
                                         <select class="form-control form-control-lg"
                                           name="requestType" id="" required>
                                           <option value="">...</option>
                                                    @foreach($requests as $request)
                                                       <option value="{{ $request->id }}">{{ $request->Name }}</option>
                                                    @endforeach

                                         </select>
                                                </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">

                                                <div class="col">
                                                    <label class="control-label" for="statement">{{trans('requests-trans.Statement')}} :    <span class="text-danger">*</span></label><br>
                                                    <input type="file" name="statement" required>
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
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
