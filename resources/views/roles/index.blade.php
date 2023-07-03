@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
        <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@section('title')
{{ trans('system-trans.Roles') }}
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('system-trans.Users') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> &nbsp;  /  &nbsp;
                {{ trans('system-trans.Roles') }}</span>
        </div>
<br>
    </div>
</div>

<!-- breadcrumb -->
@endsection
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- @if (session()->has('Add'))
    <script>
        window.onload = function() {
            notif({
                msg: trans('messages-trans.Add_Role'),
                type: "success"
            });
        }
    </script>
@endif

@if (session()->has('edit'))
    <script>
        window.onload = function() {
            notif({
                msg: trans('messages-trans.Update_Role'),
                type: "success"
            });
        }
    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function() {
            notif({
                msg: trans('messages-trans.Delete_Role'),
                type: "error"
            });
        }
    </script>
@endif --}}

<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            {{-- @can('اضافة صلاحية') --}}
                                <a class="btn btn-info btn-sm" href="{{ route('roles.create') }}">{{ trans('system-trans.Add_Role') }}</a>
                            {{-- @endcan --}}
                        </div>
                    </div>
                    <br>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                    data-page-length="50"
                    style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('system-trans.Role_Name') }}</th>
                                <th>{{ trans('employees-trans.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        {{-- @can('عرض صلاحية') --}}
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('roles.show', $role->id) }}">{{ trans('system-trans.Show') }}</a>
                                        {{-- @endcan --}}

                                        {{-- @can('تعديل صلاحية') --}}
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('roles.edit', $role->id) }}">{{ trans('system-trans.Edit') }}</a>
                                        {{-- @endcan --}}

                                        @if ($role->name !== 'owner')
                                            {{-- @can('حذف صلاحية') --}}
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Role{{ $role->id }}" title="{{ trans('system-trans.Delete') }}">{{ trans('system-trans.Delete_Role') }}</button>
                                            {{-- @endcan --}}
                                        @endif


                                    </td>
                                </tr>
                                   <!-- Modal effects -->
   <div class="modal fade" id="Delete_Role{{ $role->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('system-trans.Delete_Role') }}</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('roles.destroy', 'test') }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <p>{{ trans('employees-trans.Warning_Delete') }}</p><br>
                    <input type="hidden" name="id" id="role_id" value="{{ $role->id }}">
                    <input class="form-control" value="{{ $role->name }}" type="text" readonly>
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
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
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
<br>
<br>
<br>
<br>
<br>
<!-- row closed -->
<!-- Container closed -->

<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var role_id = button.data('role_id')
        var rolename = button.data('rolename')
        var modal = $(this)
        modal.find('.modal-body #role_id').val(role_id);
        modal.find('.modal-body #rolename').val(rolename);
    })
</script>
@endsection
