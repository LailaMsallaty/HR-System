<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered p-0 " style="text-align: center">
    <thead>
        <tr class="table-danger">
        <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
        <th>#</th>
        <th>{{ trans('employees-trans.Photo') }}</th>
        <th>{{ trans('employees-trans.Name') }}</th>
        <th>{{ trans('employees-trans.Code') }}</th>
        <th>{{ trans('employees-trans.Nationality') }}</th>
        <th>{{ trans('employees-trans.Email') }}</th>
        <th>{{ trans('employees-trans.Location') }}</th>
        <th>{{ trans('employees-trans.employee_department') }}</th>
        <th>{{ trans('employees-trans.Manager') }}</th>
        <th>{{ trans('employees-trans.Deleted_at') }}</th>
        <th>{{trans('employees-trans.Processes')}}</th>

    </tr>
    </thead>
    <tbody>
    <?php $i = 0; ?>
    @foreach($employees as $Employee)
        <tr>
            <?php $i++; ?>
            <td><input type="checkbox"  value="{{ $Employee->id }}" class="box1" ></td>
            <td>{{ $i }}</td>
            <td>@if (file_exists('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName))
                <img src='{{ URL::asset('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName) }}' height="80" width="80" alt="" />

             </td>

                @else
                <img src='{{ URL::asset('assets/images/385-3856300_no-avatar-png.png') }}' height="80" width="80"  id ="imagepreview" alt="Image Preview" />


             </td>

            @endif
            <td>{{ $Employee->FName }} {{ $Employee->LName }}</td>
            <td>{{ $Employee->Code }}</td>
            <td>{{ $Employee->Nationality->Name }}</td>
            <td>{{ $Employee->email }}</td>
            <td>{{ $Employee->location->Address }}</td>
            <td>{{ $Employee->department->Name }}</td>

            <td>
                @if ($Employee->Manager === 1)
                    <label
                        class="badge badge-success" style="background-color: #8b008b">{{ trans('employees-trans.Is_Manager') }}
                    </label>
                @else
                    <label
                        class="badge badge-primary">{{ trans('employees-trans.Employee') }}</label>
                @endif

            </td>
            <td>
                {{ $Employee->deleted_at }}
            </td>

            <td>
                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#Return_Employee{{ $Employee->id }}" title="{{ trans('employees-trans.Return_Employee') }}">{{ trans('employees-trans.Return_Employee') }}</button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#Delete_Employee{{ $Employee->id }}" title="{{ trans('employees-trans.Delete_Employee') }}">{{ trans('employees-trans.Delete_Employee') }}</button>

            </td>
        </tr>
    @include('pages.Resigned.return')
    @include('pages.Resigned.Delete')
    @endforeach
    </tbody>
</table>
<button type="button" class="btn x-small  btn-danger " id="btn_delete_all">
    {{ trans('employees-trans.delete_checkbox') }}
    </button>
</div>
<!--delete_Group_Of_Employees -->
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

          <form action="{{ route('delete_all') }}" method="POST">
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
