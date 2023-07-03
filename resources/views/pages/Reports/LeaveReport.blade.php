<!DOCTYPE html>
<html>


    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=2.0">
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
        <h4 class="grey-text text-center">{{trans('reports-trans.Leave_Report')}}  {{ trans('attendance-trans.From') }} {{ $from }} {{ trans('attendance-trans.To') }} {{ $to }} </h4>
        <table class="justify-content-center">
            <thead class="grey-text text-darken-1 text-center">
                <tr>
                    <th>#</th>
                    <th>{{ trans('leaves-trans.Employee') }}</th>
                    <th>{{ trans('employees-trans.Code') }}</th>
                    <th>{{ trans('leaves-trans.Leave_Type') }}</th>
                    <th>{{ trans('leaves-trans.Date_From') }}</th>
                    <th>{{ trans('leaves-trans.Date_To') }}</th>
                    <th>{{ trans('leaves-trans.Duration') }}</th>
                    <th>{{ trans('leaves-trans.Status') }}</th>
                    <th>{{ trans('leaves-trans.Created_At') }}</th>

                </tr>
            </thead>
           <tbody>
            @if ($Leaves->count())
            <?php $i = 0; ?>
            @foreach($Leaves as $Leave)
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>{{ $Leave->FName }} {{ $Leave->LName }}</td>
                    <td>{{ $Leave->Code }}</td>
                    <td>{{ $Leave->Name }}</td>
                    <td>{{ $Leave->Start_Date }}</td>
                    <td>{{ $Leave->End_Date }}</td>
                    <td>{{ $Leave->TotalDays }}</td>
                    <td>
                        @if ( $Leave->Status == 0)
                        <label class="badge badge-secondary">{{ trans('leaves-trans.Pending') }}</label>
                        @elseif($Leave->Status == 1)
                        <label class="badge badge-success" >{{ trans('leaves-trans.Acceptable') }}</label>
                        @else
                        <label class="badge badge-danger">{{ trans('leaves-trans.Rejected') }}</label>
                        @endif

                    </td>
                    <td>{{ $Leave->created_at }}</td>
            </tr>
                @endforeach
                @else
                {{-- if there are no employees then show this message --}}
                <tr>
                    <td colspan="9"><h6 class="grey-text text-center">{{trans('attendance-trans.No_Employees_Found')}}</h6></td>
                </tr>
                @endif
            </tbody>
        </table>
</body>
</html>
