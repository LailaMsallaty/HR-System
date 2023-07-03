@extends('layouts.master')
@section('css')
    @toastr_css
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection
@section('title')
    {{ trans('salaries-trans.Slip_Printing_Preview') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto " style="color: #8b008b">{{ trans('salaries-trans.Slip_Printing_Preview') }}
                </h4>
            </div>
        </div>
<br><br>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title" style="color: grey;">{{ trans('salaries-trans.Salary_Slip') }}
                            </h1>
                            <br><br>
                            <div class="billed-from">
                                <h6 class="font-italic">{{ trans('salaries-trans.Company_Name') }} : <span style="color: #8b008b"> LLJ </span></h6>
                                <p ><span class="font-bold">{{ trans('salaries-trans.Location') }} : &nbsp;</span> {{ $EmployeeSalary->employee->location->Address }}<br>
                                    <span class="font-bold"> {{ trans('salaries-trans.Company_Num') }} :  &nbsp; </span>  324 445-4544<br>
                                    <span class="font-bold"> {{ trans('salaries-trans.Company_Email') }} :  &nbsp; </span> LLJ_Company@gmail.com</p>
                            </div><!-- billed-from -->
                        </div><br><br><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <h4 class="tx-gray-600" style="color: #008080">{{ trans('salaries-trans.Slip_Date') }}</h4>
                                    <p class="text-size:100px">{{ $EmployeeSalary->created_at }} &nbsp; <span class=" text-bold" style="color: #8b008b">{{ trans('attendance-trans.From') }} </span> {{ $EmployeeSalary->Start_Date }} <span class=" text-bold"  style="color: #8b008b;"> {{ trans('attendance-trans.To') }} </span> {{ $EmployeeSalary->End_Date }}</p>
                            </div>
                            <div class="col-md">
                                <h4 class="tx-gray-600 text-dribbble" style="color: #008080">{{ trans('salaries-trans.Employee_Info') }}</h4>
                                <p class="invoice-info-row "><span class="font-bold">{{ trans('salaries-trans.Employee_Name') }} : &nbsp;</span>
                                    <span>{{ $EmployeeSalary->employee->FName }} {{ $EmployeeSalary->employee->LName }}</span></p>
                                <p class="invoice-info-row"><span  class="font-bold">{{ trans('salaries-trans.Employee_Code') }}  : &nbsp;</span>
                                    <span>{{ $EmployeeSalary->employee->Code }}</span></p>
                                <p class="invoice-info-row"><span  class="font-bold">{{ trans('salaries-trans.Department') }}  : &nbsp;</span>
                                    <span>{{ $EmployeeSalary->employee->department->Name}}</span></p>
                                <p class="invoice-info-row"><span  class="font-bold">{{ trans('salaries-trans.Location') }}  : &nbsp;</span>
                                    <span>{{ $EmployeeSalary->employee->location->Address }}</span></p>
                            </div>
                        </div>
                        <br> <br>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">{{ trans('salaries-trans.Employee') }}</th>
                                        <th class="tx-center">{{ trans('salaries-trans.Initial_Salary') }}</th>
                                        <th class="tx-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="wd-40p">{{ $EmployeeSalary->employee->FName }} {{ $EmployeeSalary->employee->LName }}</td>
                                        <td class="tx-center">{{ number_format($EmployeeSalary->employee->Salary,2) }}  {{ trans('salaries-trans.S.P') }}</td>
                                        <td class="tx-right"></td>
                                    </tr>
                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="9">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13">#</label>

                                            </div><!-- invoice-notes -->
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="tx-right">{{ trans('salaries-trans.Advance_Payments') }}  </td>
                                        <td class="tx-right" colspan="2">{{ number_format($EmployeeSalary->Sum_Advances,2) }}  {{ trans('salaries-trans.S.P') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">{{ trans('salaries-trans.Taxes') }} %</td>
                                        <td class="tx-right" colspan="2">{{ number_format($EmployeeSalary->Taxes,2) }} </td>

                                    </tr>
                                    <tr>
                                        <td class="tx-right">{{ trans('salaries-trans.Insurance') }} %</td>
                                        <td class="tx-right" colspan="2">{{ number_format($EmployeeSalary->Insurance,2) }} </td>

                                    </tr>
                                    <tr>

                                        <td class="tx-right">{{ trans('salaries-trans.Bonus') }} %</td>
                                        <td class="tx-right" colspan="2">{{ number_format($EmployeeSalary->Bonus,2) }}  </td>

                                    </tr>
                                    <tr>

                                        <td class="tx-right">{{ trans('salaries-trans.Leaves') }} </td>
                                        <td class="tx-right" colspan="2">
                                        <?php
                                        $CountLeaves = $EmployeeSalary->employee->leaves()->whereBetween('Employee_Leaves.created_at',[$EmployeeSalary->Start_Date, $EmployeeSalary->End_Date])->where('Employee_Leaves.Status',1)->select('Employee_Leaves.TotalDays')->get();
                                        $days = 0;
                                        foreach($CountLeaves as $leave) {
                                        $total = $leave->TotalDays;
                                        $days = $days + $total;
                                        }
                                        ?>{{  $days }}
                                        @if ($days == 1)
                                        {{ trans('salaries-trans.Day') }}
                                        @else
                                        {{ trans('salaries-trans.Days') }}
                                        @endif
                                        </td>

                                    </tr>
                                    <tr>

                                        <td class="tx-right">{{ trans('salaries-trans.Absents') }} </td>
                                        <td class="tx-right" colspan="2">
                                        <?php
                                        $CountAbsents = $EmployeeSalary->employee->attendances()->whereBetween('attendance_date',[$EmployeeSalary->Start_Date, $EmployeeSalary->End_Date])->where('attendance_status',0)->get();
                                        $Absents = $CountAbsents->Count();
                                        ?>{{  $Absents }}
                                        @if ($Absents == 1)
                                        {{ trans('salaries-trans.Day') }}
                                        @else
                                        {{ trans('salaries-trans.Days') }}
                                        @endif

                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="tx-right">{{ trans('employees-trans.Punishments') }} </td>
                                        <td class="tx-right" colspan="2">
                                        <?php
                                        $CountPunishments = $EmployeeSalary->employee->punishments()->whereBetween('Employee_Punishments.created_at',[$EmployeeSalary->Start_Date, $EmployeeSalary->End_Date])->select('Deducted_Amount')->get();
                                        $PunishmentsAmount = 0;
                                        foreach($CountPunishments as $punishment) {
                                        $total = $punishment->Deducted_Amount;
                                        $PunishmentsAmount = $PunishmentsAmount + $total;
                                        }
                                        ?>{{  $PunishmentsAmount }}
                                        {{ trans('salaries-trans.S.P') }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">{{ trans('awards-trans.Cash_Prize') }} </td>
                                        <td class="tx-right" colspan="2">
                                        <?php
                                        $CountAwards = $EmployeeSalary->employee->awards()->whereBetween('Employee_Awards.created_at',[$EmployeeSalary->Start_Date, $EmployeeSalary->End_Date])->select('Cash_Prize')->get();
                                        $AwardsAmount = 0;
                                        foreach($CountAwards as $award) {
                                        $total = $award->Cash_Prize;
                                        $AwardsAmount = $AwardsAmount + $total;
                                        }
                                        ?>{{  $AwardsAmount }}
                                        {{ trans('salaries-trans.S.P') }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="1">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13">#</label>

                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">{{ trans('salaries-trans.Total') }} </td>
                                        <td class="tx-right" colspan="2">
                                            <h4 style="color: #8b008b" class="tx-primary tx-bold">{{ number_format($EmployeeSalary->Total,2) }} {{ trans('salaries-trans.S.P') }}</h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="ml-2 mr-2 fa fa-print"></i>{{ trans('salaries-trans.Print') }}</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
<br>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection
