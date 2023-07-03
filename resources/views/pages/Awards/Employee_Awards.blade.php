@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('awards-trans.Employee_Awards') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('awards-trans.Employee_Awards')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('Employee_Awards')}}">{{trans('awards-trans.Employee_Awards')}}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('awards-trans.Employee_Awards') }}
@stop
@section('content')
<!-- row -->
<div class="row">

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0" style="text-align: center">
                        <thead>
                        <tr>
                            {{-- <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th> --}}
                            <th>#</th>
                            <th>{{ trans('awards-trans.Employee') }}</th>
                            <th>{{ trans('employees-trans.Code') }}</th>
                            <th>{{ trans('awards-trans.Award_type') }}</th>
                            <th>{{ trans('awards-trans.Gift') }}</th>
                            <th>{{ trans('awards-trans.Cash_Prize') }}</th>
                            <th>{{ trans('awards-trans.Date') }}</th>
                            <th>{{ trans('awards-trans.Processes') }}</th>

                            </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($Awards as $Award)
                            <tr>
                                <?php $i++; ?>
                                {{-- <td><input type="checkbox"  value="{{ $Award->id }}" class="box1" ></td> --}}
                                <td>{{ $i }}</td>
                                <td>{{ $Award->FName }} {{ $Award->LName }}</td>
                                <td>{{ $Award->Code }}</td>
                                <td>{{ $Award->Name }}</td>
                                <td>{{ $Award->Gift }}</td>
                                <td>{{ $Award->Cash_Prize }}</td>
                                <td>{{ $Award->created_at }}</td>
                                <td>
                                    <form action="{{ route('Award_Generate_PDF') }}" method="POST">
                                        @csrf
                                    <input type="hidden" name="emp_id" value="{{ $Award->EmployeeID }}">
                                    <input type="hidden" name="award_id" value="{{ $Award->AwardID }}">
                                    <input type="hidden" name="emp_award_id" value="{{ $Award->id }}">
                                    <button style="color: white" class=" btn-info  btn-small" type="submit" name='pdf'><strong> {{ trans('awards-trans.Generate_PDF') }}</strong> </button>
                                   </form>
                                </td>
                            </tr>

                        @endforeach
                </table>

                {{-- <button type="button" class="btn x-small  btn-danger " id="btn_delete_all">
                    {{ trans('employees-trans.delete_checkbox') }}
                    </button> --}}
            </div>
        </div>
    </div>
</div>


{{-- <!--delete_Group_Of_awards -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-header">
           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
               {{ trans('employees-trans.Delete') }}
           </h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>

       <form action="{{ route('delete_all_Employee_Awards') }}" method="POST">
           {{ csrf_field() }}
           <div class="modal-body">
               {{ trans('employees-trans.Warning_Delete') }}
               <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
           </div>

           <div class="modal-footer">
               <button type="button" class="btn btn-secondary"
                       data-dismiss="modal">{{ trans('employees-trans.Close') }}</button>
               <button type="submit" class="btn btn-danger">{{ trans('employees-trans.Delete') }}</button>
           </div>
         </form>
     </div>
 </div>
</div> --}}


</div>


<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });

</script>
@endsection
