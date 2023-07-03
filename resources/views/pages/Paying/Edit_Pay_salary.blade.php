@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('salaries-trans.Edit_Pay_Salary') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('salaries-trans.Pay_Salary')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('employeesalary.index')}}" class="default-color">{{trans('salaries-trans.title_page')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('employeesalary.edit',$Salary->id)}}">{{trans('salaries-trans.Edit_Pay_Salary')}}</a></li>
               </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('salaries-trans.Edit_Pay_Salary') }}
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
                <form action="{{ route('employeesalary.update',$Salary->id) }}" method="POST" >
                    {{ method_field('patch') }}
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: #008080">{{trans('salaries-trans.Edit_Pay_Salary')}}</h6><br>
                 <div class="row">
                   <div class="col">
                            <label for="location_id"   class="control-label"> {{ trans('locations-trans.Location') }}  <span class="text-danger">*</span></label>
                            <select  class="form-control form-control-lg custom-select"
                            onclick="console.log($(this).val())"
                             name="location_id">

                            @foreach ($Locations as $Location)
                            <option value="{{ $Location->id }}"  @if ($Salary->employee->location->id == $Location->id)
                                selected
                            @endif >
                                {{ $Location->Address }}
                            </option>
                        @endforeach
                         </select>
                   </div>
                   <div class="col">
                    <label for="department_id"
                    class="control-label">{{ trans('departments-trans.Department_Name') }} :  <span class="text-danger">*</span></label>
                    <select name="department_id"  class="form-control form-control-lg" class="custom-select"  onclick="console.log($(this).val())">

                        @foreach($Salary->employee->location->departments as $loc_department)

                        <option  value="{{$loc_department->id}}"
                            @if($Salary->employee->department->id == $loc_department->id))
                            selected
                              @endif
                           >{{$loc_department->Name}}</option>

                   @endforeach
                    </select>
                    </div>

                    <div class="col">
                        <label for="employee_id"
                        class="control-label">{{ trans('employees-trans.Employee') }} :  <span class="text-danger">*</span></label>
                        <select name="employee_id"  class="form-control form-control-lg" class="custom-select" >

                            @foreach($Salary->employee->department->employees as $dep_employee)

                            <option  value="{{$dep_employee->id}}"
                                @if($Salary->employee->id == $dep_employee->id)
                                selected
                                  @endif
                               >{{$dep_employee->FName}} {{$dep_employee->LName}}</option>

                       @endforeach
                        </select>
                      </div>
              </div>
              <br>
               <br>
               <div class="row">

                <input type="hidden" name="Sum_Advances"  class="form-control form-control-lg" value="{{$Salary->Sum_Advances}}">

                <div class="col">
                    <label for="taxes"
                    class="control-label">{{ trans('salaries-trans.Taxes') }} :  <span class="text-danger">%/*</span></label>
                    <input type="number" name="taxes"  class="form-control form-control-lg" value="{{$Salary->Taxes}}">
                </div>
                <div class="col">
                    <label for="insurance"
                    class="control-label">{{ trans('salaries-trans.Insurance') }} :  <span class="text-danger">%/*</span></label>
                    <input type="number" name="insurance"  class="form-control form-control-lg" value="{{$Salary->Insurance}}">
                </div>
                <div class="col">
                    <label for="Bonus"
                    class="control-label">{{ trans('salaries-trans.Bonus') }} : <span class="text-danger">%</span></label>
                    <input type="number" name="Bonus"  class="form-control form-control-lg" value="{{$Salary->Bonus}}">
                </div>

               </div>

               <br>
               <div class="row">
                       <div class="col">

                           <label class="control-label" for="From"><strong>{{trans('attendance-trans.From')}} : <span class="text-danger">*</span></strong></label>
                           <input type="date" name="From"  class="form-control form-control-lg " id="From" value="{{ $Salary->Start_Date }}">
                       </div>
                       <div class="col">
                           <label class="control-label" for="To"><strong>{{trans('attendance-trans.To')}} : <span class="text-danger">*</span> </strong></label>
                           <input type="date" name="To" class="form-control form-control-lg " id="To" value="{{ $Salary->End_Date }}">

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
                    url: "{{ URL::to('departments') }}/" + location_id,
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
                    url: "{{ URL::to('DepartmentEmployees') }}/" + department_id +"/"+ location_id ,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="employee_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="employee_id"]').append('<option value="' + key + '">' + value + '</option>');
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
