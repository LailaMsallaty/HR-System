@extends('layouts.master')
@section('css')

{{--
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" /> --}}
{{-- <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify --> --}}
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@section('title')
{{ trans('system-trans.Users') }}
@stop


@endsection

<!-- Internal Data table css -->

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('system-trans.Users') }}
            </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">&nbsp;  /  &nbsp; {{ trans('system-trans.Users_List') }}
            </span>
        </div>
        <br>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('PageTitle')
{{ trans('system-trans.Users') }}
@stop
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- row opened -->
<div class="row">
    <div class="col-xl-12">
        <br>
        <div class="card">

            <div class="card-header pb-0">
                {{-- <div class="col-sm-1 col-md-2"> --}}
                    {{-- @can('اضافة مستخدم') --}}
                        {{-- <a style="background-color: #8b008b; color:white" class="btn btn-sm ml-0" href="{{ route('users.create') }}">{{ trans('system-trans.Add_User') }}
                        </a> --}}
                    {{-- @endcan --}}
                {{-- </div> --}}

            </div>
            <br>
            <div class="card-body table-responsive hoverable-table">
                <table id="datatable" class="table  table-hover table-sm  table-striped border border-top-0  border-right-0  border-left-0 border-info p-0 "  data-page-length="50" style="text-align: center">

                         <thead>
                            <tr>
                                <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                <th class="wd-10p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">{{ trans('system-trans.User_Name') }}
                                </th>
                                <th class="wd-20p border-bottom-0">{{ trans('system-trans.Email') }}
                                </th>
                                <th class="wd-15p border-bottom-0">{{ trans('system-trans.User_Status') }}
                                </th>
                                <th class="wd-15p border-bottom-0">{{ trans('system-trans.User_Type') }}
                                </th>
                                <th class="wd-10p border-bottom-0">{{ trans('employees-trans.Processes') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $user)
                                <tr>
                                    <td><input type="checkbox"  value="{{ $user->id }}" class="box1" ></td>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->Status == '1')
                                            <label class=" badge badge-info ">
                                                {{ trans('system-trans.Active') }}
                                            </label>
                                        @elseif($user->Status == '0')
                                            <label class="badge badge-danger">
                                                {{ trans('system-trans.Not_Active') }}
                                            </label>
                                        @endif
                                    </td>

                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        {{-- @can('تعديل مستخدم') --}}
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info"
                                                title="{{ trans('system-trans.Edit') }}"><i class="fa fa-edit"></i></a>
                                        {{-- @endcan --}}


                                        {{-- @can('حذف مستخدم') --}}
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_User{{ $user->id }}" title="{{ trans('system-trans.Delete') }}"><i class="fa fa-trash"></i></button>

                                        {{-- @endcan --}}

                                           {{-- @can('عرض مستخدم') --}}
                                           <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-warning"
                                            title="{{ trans('system-trans.Show') }}"><i class="fa fa-eye"></i></a>
                                          {{-- @endcan --}}

                                    </td>
                                </tr>
                                    <!-- Modal effects -->
    <div class="modal fade" id="Delete_User{{ $user->id }}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ trans('system-trans.Delete_User') }}</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('users.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>{{ trans('employees-trans.Warning_Delete') }}</p><br>
                        <input type="hidden" name="id" id="user_id" value="{{ $user->id }}">
                        <input class="form-control" name="username" id="username" value="{{ $user->name }}" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('employees-trans.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('employees-trans.Delete') }}</button>
                   </div>
            </div>
            </form>
        </div>

<!-- /row -->
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
    <!--/div-->





<!--delete_Group_Of_Users -->
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

       <form action="{{ route('delete_all_Users') }}" method="POST">
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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- Container closed -->
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
{{-- <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script> --}}
{{-- <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script> --}}
<!--Internal  Datatable js -->
{{-- <script src="{{ URL::asset('assets/js/table-data.js') }}"></script> --}}
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var user_id = button.data('user_id')
        var username = button.data('username')
        var modal = $(this)
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #username').val(username);
    })
</script>

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
