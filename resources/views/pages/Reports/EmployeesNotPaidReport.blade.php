<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{trans('attendance-trans.Generate_Report')}}</title>
        <style>
            td{
                border-top:#9e9e9e 1px solid !important;
                border-bottom:#9e9e9e 1px solid !important;
                border-right:#e0e0e0 1px solid !important;
                border-left:#e0e0e0 1px solid !important;
            }
            th{
                border-bottom:#212121 1px solid !important;
                border-top:#212121 1px solid !important;
                border-right:#9e9e9e 1px solid !important;
                border-left:#9e9e9e 1px solid !important;
            }

            body{

                font-family:"freeserif";
                font-feature-settings: "ss07";

                }
        </style>
    </head>
    <body class="text-center">
<div class="table-responsive">
    <h4 class="grey-text text-darken-1 center">{{trans('Reports-trans.Employees_Not_Paid')}} {{ trans('attendance-trans.From') }} {{ $from }} {{ trans('attendance-trans.To') }} {{ $to }}</h4>
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
    @if ($Employees->count())
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
    @else
    {{-- if there are no employees then show this message --}}
    <tr>
        <td colspan="13"><h6 class="grey-text text-center">{{trans('attendance-trans.No_Employees_Found')}}</h6></td>
    </tr>
    @endif
    </tbody>
</table>
</div>
</div>
</div>
    </div>
</div>
</div>
</body>
</html>
