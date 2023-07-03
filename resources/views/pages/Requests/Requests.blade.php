@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('requests-trans.Employees_Requests') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('requests-trans.Employees_Requests')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('Employee_Requests')}}">{{trans('requests-trans.Employees_Requests')}}</a></li>
               </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('requests-trans.Employees_Requests') }}
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
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
                                            <th>{{ trans('requests-trans.Employee') }}</th>
                                            <th>{{ trans('employees-trans.Code') }}</th>
                                            <th>{{ trans('requests-trans.Request_Type') }}</th>
                                            <th>{{ trans('requests-trans.Send_Request_Attachment') }}</th>
                                            <th>{{ trans('requests-trans.Reply_Attachment') }}</th>
                                            <th>{{ trans('requests-trans.Status') }}</th>
                                            <th>{{ trans('requests-trans.Created_At') }}</th>
                                            <th>{{trans('requests-trans.Processes')}}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                  <?php $i = 0; ?>
                                        @foreach($requests as $Request)
                                            <tr>
                                                <?php $i++; ?>
                                                <td><input type="checkbox"  value="{{ $Request->id }}" class="box1" ></td>
                                                <td>{{ $i }}</td>
                                                <td>{{ $Request->FName }} {{ $Request->LName }}</td>
                                                <td>{{ $Request->Code }}</td>
                                                <td>{{ $Request->Name }}</td>
                                                <td>
                                                    <a class="btn btn-outline-warning btn-sm"
                                                    href="{{url('Download_Statement')}}/{{ $Request->FName.'_'.$Request->LName }}/{{$Request->Statement}}"
                                                    role="button"><i class="fa fa-download"></i>&nbsp; {{trans('employees-trans.Download')}}</a>

                                                </td>
                                                <td>
                                                    @if ($Request->Reply_Statement)
                                                    <a class="btn btn-outline-warning btn-sm"
                                                    href="{{url('Download_Replying')}}/{{ $Request->FName.'_'.$Request->LName }}/{{$Request->Reply_Statement}}"
                                                    role="button"><i class="fa fa-download"></i>&nbsp; {{trans('employees-trans.Download')}}</a>
                                                    @else
                                                    <label class="badge badge-secondary">{{ trans('requests-trans.Without_Attachment') }}</label>

                                                    @if ( $Request->Status == 0)
                                                    <label class="badge badge-secondary">{{ trans('tasks-trans.Pending') }}</label>

                                                    @endif
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ( $Request->Status == 0)
                                                    <label class="badge badge-secondary">{{ trans('requests-trans.Pending') }}</label>
                                                    @elseif($Request->Status == 1)
                                                    <label class="badge badge-success" >{{ trans('requests-trans.Accepted') }}</label>
                                                    @else
                                                    <label class="badge badge-danger">{{ trans('requests-trans.Rejected') }}</label>
                                                    @endif

                                                </td>
                                                <td>{{ $Request->created_at }}</td>

                                                <td>
                                                @if ($Request->Status == 0 && !isset($Request->Reply_Statement))
                                                <div class="row justify-content-center">
                                                <form name="post_action" method="POST" action="{{ route('Accept_Reject_Request') }}" id="post_action">
                                                    @csrf
                                                    <button type="submit"name="action" value="accept" class="btn btn-outline-info btn-sm accept-button">{{ trans('requests-trans.Accept') }}</button>
                                                    <button type="submit" name="action" value="reject" class="btn btn-outline-danger btn-sm reject-button">{{ trans('requests-trans.Reject') }}</button>
                                                    <input type="hidden" name="id" value="{{ $Request->id }}">
                                                </form>&nbsp;
                                                <a href="{{url('ShowRequest')}}/{{ $Request->FName.'_'.$Request->LName }}/{{$Request->Statement}}/{{$Request->id}}" class="btn btn-outline-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>
                                                &nbsp;
                                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#reply_Request{{ $Request->id }}" data-target="#exampleModal">
                                                    {{ trans('requests-trans.Reply_Request_Attachment') }}
                                                </button>
                                                </div>
                                                @elseif( $Request->Reply_Statement !== '' && $Request->Status == 0)
                                                <div class="ml-2 mr-2 row justify-content-center">
                                                    <form name="post_action" method="POST" action="{{ route('Accept_Reject_Request') }}" id="post_action">
                                                        @csrf
                                                        <button type="submit"name="action" value="accept" class="btn btn-outline-info btn-sm accept-button">{{ trans('requests-trans.Accept') }}</button>
                                                        <button type="submit" name="action" value="reject" class="btn btn-outline-danger btn-sm reject-button">{{ trans('requests-trans.Reject') }}</button>
                                                        <input type="hidden" name="id" value="{{ $Request->id }}">
                                                    </form>&nbsp;
                                                <button type="button"  type="button" class="btn btn-outline-info btn-sm"  data-toggle="modal" data-target="#edit_reply{{ $Request->id }}" title="{{ trans('employees-trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                                &nbsp;
                                                <a href="{{url('ShowReply')}}/{{ $Request->FName.'_'.$Request->LName }}/{{$Request->Reply_Statement}}/{{$Request->id}}" class="btn btn-outline-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>
                                                </div>
                                                @else
                                                <div class="">
                                                {{ trans('requests-trans.Done') }} &nbsp;
                                                @if ( isset($Request->Reply_Statement))
                                                <a href="{{url('ShowReply')}}/{{ $Request->FName.'_'.$Request->LName }}/{{$Request->Reply_Statement}}/{{$Request->id}}" class="btn btn-outline-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>
                                                @endif
                                                </div>
                                                @endif
                                                </td>
                                            </tr>

   {{--  add reply  --}}
   <div class="modal fade" id="reply_Request{{ $Request->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                                    {{ trans('requests-trans.Reply_Request') }}
                                      </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body "  >
                                      <!-- add_form -->
                                      <form action="{{ route('Reply_Request.store') }}" method="POST" enctype="multipart/form-data">
                                       {{ csrf_field() }}



                                       <div class="row">
                                           <div class="col">

                                               <div class="input-group mb-2 mr-sm-2">
                                                   <div class="input-group-prepend">
                                                   <div class="input-group-text">{{trans('requests-trans.Comment')}}</div>
                                                   </div>
                                                   <textarea rows="5" cols="5" name="comment" class="form-control" id="inlineFormInputGroupUsername2" ></textarea>
                                                   <input type="hidden" name="id" value="{{ $Request->id }}">

                                               </div>

                                           </div>
                                       </div>
                                       <br>
                                       <div class="row">
                                           <div class="col">
                                               <label class="control-label" for="receive">{{trans('requests-trans.Reply_Request_Attachment')}} :   <span class="text-danger">*</span></label><br>
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



{{--  edit reply  --}}

 <div class="modal fade" id="edit_reply{{ $Request->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   {{ trans('requests-trans.Edit_Reply_Request') }}
               </h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">

               <!-- edit_form -->
        <form action="{{ route('Reply_Request.update','test') }}" enctype="multipart/form-data" method="POST">
                   {{ method_field('patch') }}
                   @csrf


                   <div class="row">
                    <div class="col">

                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">{{trans('requests-trans.Comment')}}</div>
                            </div>
                            <textarea rows="5" cols="5" name="comment" class="form-control" id="inlineFormInputGroupUsername2" >{{ $Request->HR_Comment }}</textarea>
                            <input type="hidden" name="id" value="{{ $Request->id }}">

                        </div>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label class="control-label" for="receive">{{trans('requests-trans.Reply_Request_Attachment')}} :  <span class="text-danger">*</span> </label><br>
                        <input required type="file" name="receive" value="{{ $Request->Reply_Statement }}">
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

       <form action="{{ route('delete_all_Employee_Requests') }}" method="POST">
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
