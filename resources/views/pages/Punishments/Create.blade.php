@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('employees-trans.Impose_Punishment') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('employees-trans.Impose_Punishment')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('Employee_punishment.create')}}">{{trans('employees-trans.Impose_Punishment')}}</a></li>
               </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('employees-trans.Impose_Punishment') }}
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
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
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                <form action="{{ route('Employee_punishment.store') }}" method="POST"  id="idForm">
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: #008080">{{trans('employees-trans.Impose_Punishment')}}</h6><br>
                 <div class="row">
                   <div class="col">
                            <label for="location_id"   class="control-label"> {{ trans('locations-trans.Location') }}  <span class="text-danger">*</span></label>
                            <select  class="form-control form-control-lg custom-select"
                            onclick="console.log($(this).val())"
                            id="exampleFormControlSelect1"  name="location_id">
                          <option value=""></option>

                          @foreach ($Locations as $Location)
                              <option value ="{{$Location->id}}" >
                                  {{ $Location->Address }}
                              </option>
                          @endforeach
                         </select>
                   </div>
                   <div class="col">
                    <label for="department_id"
                    class="control-label">{{ trans('departments-trans.Department_Name') }} :  <span class="text-danger">*</span></label>
                    <select name="department_id"  class="form-control form-control-lg" class="custom-select"  onclick="console.log($(this).val())">
                    </select>
                    </div>


              </div>
              <br>
              <div class="row">
                <div class="col">
                    <label for="employee_id"
                    class="control-label">{{ trans('employees-trans.Employee') }} :  <span class="text-danger">*</span></label>
                    <select name="employee"  class="form-control form-control-lg" class="custom-select" >
                    </select>
                  </div>
                  <div class="col">
                    <label for="punishment_id"   class="control-label"> {{ trans('employees-trans.Punishment_Name') }}  : <span class="text-danger">*</span></label>
                    <select  class="form-control form-control-lg custom-select"
                    id="exampleFormControlSelect1"  name="punishment_id">
                  <option value="">...</option>

                  @foreach ($Punishments as $Punishment)
                      <option value ="{{$Punishment->id}}" >
                          {{ $Punishment->Name }}
                      </option>
                  @endforeach
                 </select>
                  </div>
              </div>
               <br>
               <div class="row">
                <div class="col">
                    <label for=""
                    class="mr-sm-2">{{ trans('employees-trans.Punishment_Statement') }}
                    :  <span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="2" name="statement" ></textarea>
                </div>
               </div>
              <br><br>

                   <div class="modal-footer">
                   <button type="submit"
                          class="btn btn-success">{{ trans('locations-trans.Submit') }}</button>

                    </div>
              </form>

          </div>


      </div>

  </div>


</div>
</div>
</div>

@endsection
@section('js')
@toastr_js
@toastr_render
<script>
    $(document).ready(function () {
        $('select[name="location_id"]').on('click', function () {
            var location_id = $(this).val();
            if (location_id) {
                $.ajax({
                    url: "{{ URL::to('Resign_departments') }}/" + location_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="department_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="department_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
        $('select[name="department_id"]').on('click', function () {
            var department_id = $(this).val();
            var location_id = $('select[name="location_id"]').val();
            if (department_id) {
                $.ajax({
                    url: "{{ URL::to('Resign_Department_Employees') }}/" + department_id + "/"+ location_id ,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="employee"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="employee"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });


</script>

@endsection
