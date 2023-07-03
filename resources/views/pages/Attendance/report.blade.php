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
    <body>
        <h4 class="grey-text text-darken-1 center">{{trans('attendance-trans.Report')}} {{ trans('attendance-trans.From') }} {{ $from }} {{ trans('attendance-trans.To') }} {{ $to }}</h4>
        <table>
            <thead class="grey-text text-darken-1">
                <tr>
                    <th>#</th>
                    <th>{{ trans('employees-trans.Name') }}</th>
                    <th>{{ trans('attendance-trans.Attendance_Status') }}</th>
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
            @if ($employees->count())
            <?php $i = 0; ?>
            @foreach($employees as $Employee)
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>{{ $Employee->employee->FName }} {{ $Employee->employee->LName }}</td>
                    <td>
                        @if ($Employee->attendance_status == 1)
                        {{ trans('attendance-trans.Present') }}
                        @elseif($Employee->attendance_status == 0)
                        {{ trans('attendance-trans.Absent') }}
                        @endif
                    </td>
                    <td>{{ $Employee->employee->Code }}</td>
                    <td>{{ $Employee->employee->Nationality->Name }}</td>
                    <td>{{ $Employee->employee->email }}</td>
                    <td>{{ $Employee->employee->location->Address }}</td>
                    <td>{{ $Employee->employee->department->Name }}</td>
                    <td>
                        @if ($Employee->employee->Manager === 1)
                            {{ trans('employees-trans.Is_Manager') }}
                        @else
                            {{ trans('employees-trans.Employee') }}
                        @endif

                    </td>
                    <td>{{ $Employee->employee->Trainee }}</td>
                    <td>{{ $Employee->employee->Years_Of_Experience }}</td>
                    <td>{{ $Employee->employee->Salary }}</td>
                    <td>{{ $Employee->employee->HireDate }}</td>

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
</body>
</html>
