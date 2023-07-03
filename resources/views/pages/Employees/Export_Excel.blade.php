<table id="datatable" class="table table-striped table-bordered p-0 " style="text-align: center">
    <thead>
        <tr class="table-secondary">
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
    </tr>
    </thead>
    <tbody>
    <?php $i = 0; ?>
    @foreach($Employees as $Employee)
        <tr>
            <?php $i++; ?>
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

        </tr>
    @endforeach
    </tbody>
</table>

