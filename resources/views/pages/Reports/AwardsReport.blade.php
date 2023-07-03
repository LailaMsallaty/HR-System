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
        <h4 class="grey-text text-center">{{trans('reports-trans.Awards_Report')}}  {{ trans('attendance-trans.From') }} {{ $from }} {{ trans('attendance-trans.To') }} {{ $to }} </h4>
        <table>
            <thead class="grey-text text-darken-1">
                <tr>
                    <th>#</th>
                    <th>{{ trans('awards-trans.Employee') }}</th>
                    <th>{{ trans('employees-trans.Code') }}</th>
                    <th>{{ trans('awards-trans.Award_type') }}</th>
                    <th>{{ trans('awards-trans.Gift') }}</th>
                    <th>{{ trans('awards-trans.Cash_Prize') }}</th>
                    <th>{{ trans('awards-trans.Date') }}</th>

                </tr>
            </thead>
           <tbody>
         @if(isset($Awards))
            <?php $i = 0; ?>
            @foreach ($Awards as $Award)
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>{{ $Award->FName }} {{ $Award->LName }}</td>
                    <td>{{ $Award->Code }}</td>
                    <td>{{ $Award->Name }}</td>
                    <td>{{ $Award->Gift }}</td>
                    <td>{{ $Award->Cash_Prize }}</td>
                    <td>{{ $Award->created_at }}</td>

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
