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
        <h4 class="grey-text text-darken-1 center">{{trans('employees-trans.Advances_Report')}} {{ trans('attendance-trans.From') }} {{ $from }} {{ trans('attendance-trans.To') }} {{ $to }}</h4>
        <table>
            <thead class="grey-text text-darken-1">
                <tr>
                    <th scope="col">#</th>
                       <th scope="col">{{ trans('employees-trans.Name') }}</th>
                        <th scope="col">{{trans('salaries-trans.Initial_Salary')}}</th>
                        <th scope="col">{{trans('salaries-trans.Amount')}}</th>
                        <th scope="col">{{trans('salaries-trans.Remaining_Amount')}}</th>
                        <th scope="col">{{trans('employees-trans.created_at')}}</th>
                        <th scope="col">{{trans('employees-trans.updated_at')}}</th>
                        <th scope="col">{{trans('salaries-trans.Statement')}}</th>
                </tr>
            </thead>
           <tbody>
            @if ($advances->count())
            <?php $i = 0; ?>
            @foreach($advances as $advance)
            <tr style='text-align:center;vertical-align:middle'>
                <td>{{$loop->iteration}}</td>
                <td>{{ $advance->employee->FName }} {{ $advance->employee->LName }} - {{ $advance->employee->Code }}</td>
                <td>{{$advance->Previous_Salary}}</td>
                <td>{{$advance->Advance_Amount}}</td>
                <td>{{$advance->Remaining_Amount}}</td>
                <td>{{$advance->created_at->diffForHumans()}}</td>
                <td>{{$advance->updated_at->diffForHumans()}}</td>
                <td>{{$advance->Statement}}</td>

            </tr>
                @endforeach
                @else
                {{-- if there are no employees then show this message --}}
                <tr>
                    <td colspan="8"><h6 class="grey-text text-center">{{trans('attendance-trans.No_Employees_Found')}}</h6></td>
                </tr>
                @endif
            </tbody>
        </table>
</body>
</html>
