<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered p-0 " style="text-align: center">
    <thead>
        <tr class="table-secondary">
        <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
        <th>#</th>
        <th>{{ trans('employees-trans.Name') }}</th>
        <th>{{ trans('employees-trans.Code') }}</th>
        <th>{{ trans('employees-trans.Nationality') }}</th>
        <th>{{ trans('employees-trans.Email') }}</th>
        <th>{{ trans('employees-trans.Location') }}</th>
        <th>{{ trans('employees-trans.employee_department') }}</th>
        <th>{{ trans('employees-trans.Manager') }}</th>
        <th>{{trans('employees-trans.Trainee')}}</th>
        <th>{{trans('employees-trans.YearsOfExp')}}</th>
        <th>{{trans('employees-trans.Salary')}}</th>
        <th>{{trans('employees-trans.HireDate')}}</th>
        <th>{{trans('employees-trans.Processes')}}</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0; ?>
    @foreach($Employees as $Employee)
        <tr>
            <?php $i++; ?>
            <td><input type="checkbox"  value="{{ $Employee->id }}" class="box1" ></td>
            <td>{{ $i }}</td>
            <td>{{ $Employee->FName }} {{ $Employee->LName }}</td>
            <td>{{ $Employee->Code }}</td>
            <td>{{ $Employee->Nationality->Name }}</td>
            <td>{{ $Employee->email }}</td>
            <td>{{ $Employee->location->Address }}</td>
            <td>{{ $Employee->department->Name }}</td>
            <td>
                @if ($Employee->Manager === 1)
                    {{ trans('employees-trans.Is_Manager') }}
                @else
                    {{ trans('employees-trans.Employee') }}
                @endif

            </td>
            <td>{{ $Employee->Trainee }}</td>
            <td>{{ $Employee->Years_Of_Experience }}</td>
            <td>{{ $Employee->Salary }}</td>
            <td>{{ $Employee->HireDate }}</td>
            <td>
                <div class="row ml-1">
                    <a href="{{route('employeesalary.create')}}"  class="btn btn-outline-info btn-sm" role="button" >
                        {{ trans('salaries-trans.Pay_Salary') }}
                    </a>
                </div>
            </td>

        </tr>
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
