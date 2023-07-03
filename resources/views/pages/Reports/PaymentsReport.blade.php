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
        <h4 class="grey-text text-center">{{trans('reports-trans.Payment_Report')}}  {{ trans('attendance-trans.From') }} {{ $from }} {{ trans('attendance-trans.To') }} {{ $to }} </h4>
        <table>
            <thead class="grey-text text-darken-1">
                <tr>
                    <th>#</th>
                    <th>{{ trans('employees-trans.Name') }}</th>
                    <th>{{ trans('employees-trans.Code') }}</th>
                    <th>{{trans('salaries-trans.Initial_Salary')}}</th>
                    <th>{{trans('salaries-trans.Advance_Payments')}}</th>
                    <th>{{trans('salaries-trans.Taxes')}}</th>
                    <th>{{trans('salaries-trans.Insurance')}}</th>
                    <th>{{trans('salaries-trans.Bonus')}}</th>
                    <th>{{trans('salaries-trans.Total')}}</th>
                    <th>{{trans('salaries-trans.Date')}}</th>

                </tr>
            </thead>
           <tbody>
            @if ($salaries->count())
            <?php $i = 0; ?>
            @foreach($salaries as $Salary)
            <tr style='text-align:center;vertical-align:middle'>
                <td>{{$loop->iteration}}</td>
                <td>{{$Salary->employee->FName}}  {{$Salary->employee->LName}}</td>
                <td>{{$Salary->employee->Code}}</td>
                <td>{{$Salary->employee->Salary}}</td>
                <td>{{$Salary->Sum_Advances}}</td>
                <td>{{$Salary->Taxes}} %</td>
                <td>{{$Salary->Insurance}} %</td>
                <td>{{$Salary->Bonus}} %</td>
                <td>{{ number_format($Salary->Total,2) }}</td>
                <td>{{$Salary->created_at}}</td>
            </tr>
                @endforeach
                @else
                {{-- if there are no employees then show this message --}}
                <tr>
                    <td colspan="11"><h6 class="grey-text text-center">{{trans('attendance-trans.No_Employees_Found')}}</h6></td>
                </tr>
                @endif
            </tbody>
        </table>
</body>
</html>
