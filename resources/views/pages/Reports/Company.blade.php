<?php use App\Http\Controllers\ReportController;?>
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
@section('title')
{{ trans('reports-trans.Company') }}
@stop
@endsection
@section('PageTitle')
 {{ trans('reports-trans.Company') }}
@stop
@section('content')
<div class="row" id="print">
    <div class="col-md-12 mb-30" >
        <div class="card card-statistics h-100">
            <div class="card-body ml-5 mr-5"   >

<section class="section" id="employee-service-center-requests-page-configuration__section_ik3_kbx_xfb"><h2 class="title sectiontitle" id="d542053e91">{{ trans('reports-trans.Company') }}</h2><br>

    <p class="p">{{ trans('reports-trans.Text')}}</p>
    <br>
    <br>
    <table class="  table frame-all" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb"><caption></caption><colgroup><col style="width:50%" /><col style="width:50%" /></colgroup><thead class="thead">
       <tr class="row">
        <th class="entry cellrowborder colsep-1 rowsep-1" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__1"  style="width:50%" >{{ trans('reports-trans.Location') }}</th>
        <th class="entry cellrowborder colsep-1 rowsep-1" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__3"  style="width:50%" >{{ trans('reports-trans.Departments')  }}</th>
       </tr>
      </thead><tbody class="tbody">
      @foreach($locations as $location)
            <tr class="row">
                <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__1 "   style="width:50%" >{{ $location->Address }}</td>
                <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__2 "  style="width:50%" >
                <ul class="ul" id="employee-service-center-requests-page-configuration__ul_e4z_4vm_wfb">
                    @foreach($location->departments as $loc_dep)

                         <li class="li">{{ $loc_dep->Name }}</li>

                    @endforeach
                </ul>
                </td>
            </tr>
      @endforeach

      </tbody>
    </table>
   </section>
<hr>
   <section class="section" id="employee-service-center-requests-page-configuration__section_ik3_kbx_xfb"><h2 class="title sectiontitle" id="d542053e91"></h2><br>

    <br>
    <table class="  table frame-all" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb"><caption></caption><colgroup><col style="width:50%" /><col style="width:50%" /></colgroup><thead class="thead">
       <tr class="row">
        <th class="entry cellrowborder colsep-1 rowsep-1" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__1"  style="width:33%" >{{ trans('reports-trans.Department') }}</th>
        <th class="entry cellrowborder colsep-1 rowsep-1" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__3"  style="width:33%" >{{ trans('reports-trans.Employees')  }}</th>
        <th class="entry cellrowborder colsep-1 rowsep-1" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__3"  style="width:33%" >{{ trans('reports-trans.Manager')  }}</th>
       </tr>
      </thead><tbody class="tbody">
      @foreach($departments as $department)
            <tr class="row">
                <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__1 "   style="width:33%" >{{ $department->Name }}</td>
                    <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__2 "  style="width:33%" >
                <ul class="ul" id="employee-service-center-requests-page-configuration__ul_e4z_4vm_wfb">
                    @foreach($department->employees as $dep_emp)

                         <li class="li">{{ $dep_emp->FName }}  {{ $dep_emp->LName }} - {{ $dep_emp->Code }}</li>

                    @endforeach
                </ul>
                </td>
                <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__2 "  style="width:33%" >

                <ul>
                    @foreach ($Departments_loc->where('Department_Id',$department->id) as $manager)
                    <li class="li"> {{ $manager->FName }} {{ $manager->LName }} - {{ $manager->Code }} &nbsp; <br> { {{  ReportController::getNameAttribute($manager->Address)  }} }</li>
                    @endforeach

                </ul>

                </td>
            </tr>


      @endforeach

      </tbody>
    </table>
   </section>
<hr>
   <section class="section" id="employee-service-center-requests-page-configuration__section_ik3_kbx_xfb"><h2 class="title sectiontitle" id="d542053e91"></h2><br>

    <br>
    <table class="  table frame-all" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb"><caption></caption><colgroup><col style="width:50%" /><col style="width:50%" /></colgroup><thead class="thead">
       <tr class="row">
        <th class="entry cellrowborder colsep-1 rowsep-1" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__1"  style="width:50%" >{{ trans('reports-trans.Employee') }}</th>
        <th class="entry cellrowborder colsep-1 rowsep-1" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__2"  style="width:50%" >{{ trans('reports-trans.Positions')  }}</th>
       </tr>
      </thead><tbody class="tbody">
      @foreach($employees as $employee)
            <tr class="row">
                <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__1 "   style="width:50%" >{{ $employee->FName }} {{ $employee->LName }}</td>
                <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__2 "  style="width:50%" >
                <ul class="ul" id="employee-service-center-requests-page-configuration__ul_e4z_4vm_wfb">
                    @foreach($employee->positions as $emp_pos)

                         <li class="li">{{ $emp_pos->Role }} - {{ $emp_pos->FT_PT }}</li>

                    @endforeach
                </ul>
                </td>
            </tr>
      @endforeach

      </tbody>
    </table>
   </section>
   <hr>


   <section class="section" id="employee-service-center-requests-page-configuration__section_ik3_kbx_xfb"><h2 class="title sectiontitle" id="d542053e91"></h2><br>

    <br>
    <table class="  table frame-all" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb"><caption></caption><colgroup><col style="width:50%" /><col style="width:50%" /></colgroup><thead class="thead">
       <tr class="row">
        <th class="entry cellrowborder colsep-1 rowsep-1" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__1"  style="width:50%" >{{ trans('reports-trans.Trainees') }}</th>
        <th class="entry cellrowborder colsep-1 rowsep-1" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__2"  style="width:50%" >{{ trans('reports-trans.Positions')  }}</th>
       </tr>
      </thead>

      <tbody class="tbody">
    @foreach($employees as $employee)
        @if($employee->Trainee == 'Yes' || $employee->Trainee == 'نعم' )

            <tr class="row">

                <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__1 "   style="width:50%" >{{ $employee->FName }} {{ $employee->LName }}</td>
                <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__2 "  style="width:50%" >
                <ul class="ul" id="employee-service-center-requests-page-configuration__ul_e4z_4vm_wfb">
                    @foreach($employee->positions as $emp_pos)

                         <li class="li">{{ $emp_pos->Role }}</li>

                    @endforeach
                </ul>
                </td>

            </tr>
           @endif
      @endforeach

      </tbody>
    </table>
   </section>
   <hr>


   <hr>
            </div>
            <div class="container">
            <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                class="ml-2 mr-2 fa fa-print"></i>{{ trans('salaries-trans.Print') }}</button>
            </div>
<br>
        </div>
    </div>
</div>
@endsection
@section('js')
@toastr_js
@toastr_render

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
