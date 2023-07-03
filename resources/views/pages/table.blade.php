@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('salaries-trans.Edit_Advance') }}
@stop
@endsection
@section('PageTitle')
{{ trans('salaries-trans.Edit_Pay_Salary') }}
@stop
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

<section class="section" id="employee-service-center-requests-page-configuration__section_ik3_kbx_xfb"><h2 class="title sectiontitle" id="d542053e91">Preconfigured filters</h2>

    <p class="p">The following filters are included with the Employee Service Center application. You can use
     them or configure your own.</p>
    <table class="  table frame-all" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb"><caption></caption><colgroup><col style="width:50%" /><col style="width:50%" /></colgroup><thead class="thead">
       <tr class="row">
        <th class="entry cellrowborder colsep-1 rowsep-1" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__1">Application</th>
        <th class="entry cellrowborder colsep-1 rowsep-1" id="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__2">Filters</th>
       </tr>
      </thead><tbody class="tbody">
       <tr class="row">
        <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__1 ">Employee Service Center</td>
        <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__2 ">
         <ul class="ul" id="employee-service-center-requests-page-configuration__ul_e4z_4vm_wfb">
          <li class="li">Incident Portal</li>
          <li class="li">Service Catalog Request</li>
          <li class="li">Service Catalog Request Portal</li>
          <li class="li">Service Order Portal</li>
         </ul>
        </td>
       </tr>
       <tr class="row">
        <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__1 ">With <span class="ph">HR Service Delivery</span></td>
        <td class="entry cellrowborder colsep-1 rowsep-1" headers="employee-service-center-requests-page-configuration__table_cxm_vzg_wfb__entry__2 ">
         <ul class="ul" id="employee-service-center-requests-page-configuration__ul_st3_pvm_wfb">
          <li class="li">HR - My Requests</li>
          <li class="li">HR Cases Closed</li>
          <li class="li">HR Cases Open</li>
          <li class="li">HR Service Request Closed</li>
          <li class="li">HR Service Request Open</li>
         </ul>
        </td>
       </tr>
      </tbody></table>
   </section>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@toastr_js
@toastr_render

@endsection
