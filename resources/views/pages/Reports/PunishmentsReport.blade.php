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
        <h4 class="grey-text text-center">{{trans('reports-trans.Punishments_Report')}}  {{ trans('attendance-trans.From') }} {{ $from }} {{ trans('attendance-trans.To') }} {{ $to }} </h4>
        <table>
            <thead class="grey-text text-darken-1">
                <tr>
                    <th>#</th>
                    <th>{{ trans('awards-trans.Employee') }}</th>
                    <th>{{ trans('employees-trans.Code') }}</th>
                    <th>{{ trans('employees-trans.Punishment_Name') }}</th>
                    <th>{{ trans('employees-trans.Punishment_Description') }}</th>
                    <th>{{ trans('employees-trans.Deducted_Amount') }}</th>
                    <th>{{ trans('employees-trans.Punishment_Statement') }}</th>
                    <th>{{ trans('employees-trans.Punishment_Date') }}</th>

                </tr>
            </thead>
           <tbody>
            <?php $i = 0; ?>
            @if ($Punishments->count() )
            @foreach ($Punishments as $Punishment)
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>{{ $Punishment->FName }} {{ $Punishment->LName }}</td>
                    <td>{{ $Punishment->Code }}</td>
                    <td>{{ $Punishment->Name }}</td>
                    <td>{{ $Punishment->Description }}</td>
                    <td>{{ $Punishment->Deducted_Amount }}</td>
                    <td>{{ $Punishment->Statement }}</td>
                    <td>{{ $Punishment->created_at }}</td>

                </tr>
                @endforeach
                @else
                {{-- if there are no employees then show this message --}}
                <tr>
                    <td colspan="7"><h6 class="grey-text text-center">{{trans('attendance-trans.No_Employees_Found')}}</h6></td>
                </tr>
                @endif
            </tbody>
        </table>
</body>
</html>
