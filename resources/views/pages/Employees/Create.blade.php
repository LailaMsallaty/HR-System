@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('employees-trans.add_Employee') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('employees-trans.add_Employee')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('employee.create')}}">{{trans('employees-trans.add_Employee')}}</a></li>
               </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('employees-trans.title_page') }}
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
                    <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data" id="idForm">
                         @csrf
                         <h6 style="font-family: 'Cairo', sans-serif;color: #8b008b">{{trans('employees-trans.personal_information')}}</h6><br>
                <div class="row">
                   <div class="col">
                      <label for="FName"
                             class="mr-sm-2">{{ trans('employees-trans.FName') }}
                          : <span class="text-danger">*</span></label>
                      <input id="FName" type="text" name="FName"
                             class="form-control"
                             required>
                      <input id="id" type="hidden" name="id" class="form-control"
                             >
                   </div>
                   <div class="col">
                      <label for="LName"
                             class="mr-sm-2">{{ trans('employees-trans.LName') }}
                          : <span class="text-danger">*</span></label>
                      <input id="LName" type="text" class="form-control"
                             name="LName" required>
                   </div>
               </div>
               <br>
               <div class="row">
                  <div class="col">
                      <div class="form-group">
                      <label for="email">{{ trans('employees-trans.Email') }}
                            : <span class="text-danger">*</span></label>
                     <input type="text" name="Email" class="form-control" required  autocomplete="true">
                     <input type="hidden" name="Code" class="form-control" value="{{ rand(10000,99000) }}">
                    </div>

                  </div>

                  <div class="col">
                    <div class="form-group">
                    <label for="number">{{ trans('employees-trans.Number') }}
                          : <span class="text-danger">*</span></label>
                   <input type="text" name="Number" class="form-control" required>
                  </div>

                </div>
               </div>
               <br>


              <div class="row">

                <div class="col">
                    <div class="form-group">
                      <select class="form-control form-control-lg " name="Nationality">
                        <option value ="" >
                            {{trans('employees-trans.select_Nationality')}} <span class="text-danger">*</span>
                        </option>
                        @foreach($Nationalities as $National)
                            <option value="{{$National->id}}">{{$National->Name}}</option>
                        @endforeach
                    </select>
                   </div>
                </div>
                <div class="col">
                    <div class="form-group">
                      <select class="form-control form-control-lg " name="Degree">
                        <option value ="" >
                            {{trans('employees-trans.select_Degree')}} <span class="text-danger">*</span>
                        </option>
                        @foreach($Degrees as $Degree)
                            <option value="{{$Degree->id}}">{{$Degree->Level}}</option>
                        @endforeach
                    </select>
                   </div>
                </div>
                   <div class="col">
                    <div class="form-group">
                        <select  class="form-control form-control-lg custom-select"
                        onclick="console.log($(this).val())"
                        id="exampleFormControlSelect1"  name="employee_department">
                          <option value ="" >
                      {{trans('employees-trans.select_department')}}  <span class="text-danger">*</span>
                          </option>
                      @foreach ($Departments as $Department)
                          <option value ="{{$Department->id}}" >
                              {{ $Department->Name }}
                          </option>
                      @endforeach
                     </select>
                    </div>
                   </div>
              </div>
              <div class="row">
                <div class="col">
                    <label for="inputName"
                           class="control-label">{{ trans('employees-trans.Positions') }} : <span class="text-danger">*</span></label>
                    <select name="position_id[]" class="custom-select" multiple>

                    </select>
                   </div>
                   <div class="col">
                        <label
                            for="exampleFormControlTextarea1">{{ trans('employees-trans.Skills') }}
                            : <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="Skills"  id="exampleFormControlTextarea1"
                                rows="4"></textarea>
                   </div>
              </div>

              <br>
              <div class="row">
                  <div class="col">
                      <div class="form-group">

                       <select class="form-control form-control-lg"
                              id="exampleFormControlSelect1" name="Trainee">

                          <option value="">{{trans('employees-trans.select_trainee')}}  <span class="text-danger">*</span></option>

                          <option  value=" {{ trans('employees-trans.Yes') }}" >
                            {{ trans('employees-trans.Yes') }}
                          </option>
                          <option value="{{ trans('employees-trans.No') }}">
                            {{ trans('employees-trans.No') }}
                          </option>
                          </select>
                      </div>
                      </div>

                      <div class="col">
                        <div class="form-group">
                          <select class="form-control form-control-lg"
                              id="exampleFormControlSelect1" name="Gender">

                          <option value="">{{trans('employees-trans.select_gender')}}  <span class="text-danger">*</span></option>
                          <option value=" {{ trans('employees-trans.Male') }}">
                            {{ trans('employees-trans.Male') }}
                          </option>
                          <option value="{{ trans('employees-trans.Female') }}">
                            {{ trans('employees-trans.Female') }}
                          </option>

                          </select>
                       </div>
                     </div>

                      <div class="col">
                        <select name="location_id"  class="form-control form-control-lg" class="custom-select">
                            <option value="">{{trans('employees-trans.Location')}}  <span class="text-danger">*</span></option>
                        </select>
                       </div>
              </div>
              <br>
              <div class="row">
                  <div class="col">
                      <div class="form-group">
                          <label for="BirthDate">{{ trans('employees-trans.BirthDate') }}
                              :</label>
                          <input type="date" name="BirthDate" id="BirthDate" class="form-control">
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group">
                          <label for="HireDate">{{ trans('employees-trans.HireDate') }}
                              : <span class="text-danger">*</span></label>
                          <input type="date" name="HireDate" id="HireDate" class="form-control">
                      </div>
                  </div>

              </div>
              <br>
              <div class="row">
                  <div class="col">
                          <div class="form-group">
                              <label for="Address">{{ trans('employees-trans.Address') }}
                                  : <span class="text-danger">*</span></label>
                              <input type="text" name="Address" id="Address" class="form-control">
                          </div>
                  </div>
                  <div class="col">
                          <div class="form-group">
                              <label for="YearsOfExp">{{ trans('employees-trans.YearsOfExp') }}
                                  : <span class="text-danger">*</span></label>
                              <input type="number" name="YearsOfExp" id="YearsOfExp" class="form-control">
                          </div>
                  </div>
                  <div class="col mt-5">
                      <div class="form-check">
                              <input
                                  type="checkbox"
                                  class="form-check-input"
                                  name="Status"
                                  id="exampleCheck1">
                          <label
                              class="form-check-label"
                              for="exampleCheck1">{{ trans('employees-trans.Manager') }}</label>
                      </div>
                  </div>
              </div>
              <br>
              <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                    <label for="academic_year">{{trans('employees-trans.Photo')}} : </label>
                    <input id="idupload" type="file" accept="image/*" name="photo" >
                </div>
            </div>
              </div>
              <div class="col-md-4">
                <div class='item-box live-preview' style='height:300px; width:300px;'>
                     <img height='300' width='300'  src='{{ URL::asset('assets/images/385-3856300_no-avatar-png.png') }}' id ="imagepreview" alt="Image Preview" />
                </div>
            </div>


                   <div class="modal-footer">
                    <button type="submit"
                          class="btn btn-success">{{ trans('employees-trans.Submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

<script>
    $(document).ready(function () {
        $('select[name="employee_department"]').on('click', function () {
            var employee_department_id = $(this).val();
            if (employee_department_id) {
                $.ajax({
                    url: "{{ URL::to('positions') }}/" + employee_department_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="position_id[]"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="position_id[]"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
                 $.ajax({
                    url: "{{ URL::to('locations') }}/" + employee_department_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="location_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="location_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });


    function imagepreview(input){

if(input.files && input.files[0]) {

  var filerd = new FileReader();

  filerd.onload = function(e){

    $('#idForm + #imagepreview').remove();
    $('#imagepreview').attr('src',e.target.result);



  };

  filerd.readAsDataURL(input.files[0]);
}

}


$('#idupload').change(function(){

imagepreview(this);

});
</script>

@endsection
