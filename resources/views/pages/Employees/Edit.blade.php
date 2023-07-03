@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('employees-trans.edit_Employee') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('employees-trans.Company_Employees')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item "><a href="{{route('employee.index')}}">{{trans('employees-trans.title_page')}}</a></li>
                <li class="breadcrumb-item active">
                    <a href="{{route('employee.edit',$Employee->id)}}">{{trans('employees-trans.edit_Employee')}}</a>
                </li>
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
                    <form action="{{ route('employee.update','test') }}" method="POST" enctype="multipart/form-data">
                        {{ method_field('patch') }}
                        @csrf
                         <div class="row">
                             <div class="col">
                                <label for="FName"
                                       class="mr-sm-2">{{ trans('employees-trans.FName') }}
                                    : <span class="text-danger">*</span></label>
                                <input id="FName" type="text" name="FName"
                                       class="form-control" value="{{$Employee->FName}}"
                                       required>
                                <input id="id" type="hidden" name="id" class="form-control"
                                       >
                             </div>
                             <div class="col">
                                <label for="LName"
                                       class="mr-sm-2">{{ trans('employees-trans.LName') }}
                                    : <span class="text-danger">*</span></label>
                                <input id="LName" type="text" class="form-control" value="{{$Employee->LName}}"
                                       name="LName" required>
                                <input id="id" type="hidden" class="form-control" name="id"  value="{{$Employee->id}}" >

                             </div>

                         </div>
                         <br>
                         <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label for="email">{{ trans('employees-trans.Email') }}
                                 : <span class="text-danger">*</span></label>
                               <input type="text" name="Email" class="form-control" value="{{$Employee->email}}">

                              </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                <label for="number">{{ trans('employees-trans.Number') }}
                                 : <span class="text-danger">*</span></label>
                               <input type="text" name="Number" class="form-control" value="{{$Employee->Number}}">

                              </div>
                            </div>

                         </div>
                         <br>
                         <div class="row">
                            <div class="col ">
                                <div class="form-group">
                                    <label for="Trainee">{{ trans('employees-trans.Nationality') }}
                                        : <span class="text-danger">*</span></label>
                                <select class="form-control  form-control-lg" name="Nationality" >
                                    @foreach ($Nationalities as $Nationality)
                                    <option value="{{ $Nationality->id }}"  @if ($Employee->Nationality->Name == $Nationality->Name)
                                        selected
                                    @endif >
                                        {{ $Nationality->Name }}
                                    </option>
                                    @endforeach
                                </select>
                               </div>
                               </div>

                               <div class="col">
                                <div class="form-group">
                                    <label for="degree">{{ trans('employees-trans.Degree') }}
                                        : <span class="text-danger">*</span></label>
                                  <select class="form-control form-control-lg " name="Degree">
                                    @foreach ($Degrees as $Degree)
                                    <option value="{{ $Degree->id }}"  @if ($Employee->degree->Level == $Degree->Level)
                                        selected
                                    @endif >
                                        {{ $Degree->Level }}
                                    </option>
                                    @endforeach
                                </select>
                               </div>
                            </div>
                             <div class="col">
                              <div class="form-group ">
                                <label
                                for="exampleFormControlTextarea1">{{ trans('employees-trans.employee_department') }}
                                : <span class="text-danger">*</span></label>
                              <select class="form-control  form-control-lg"
                                    id="exampleFormControlSelect1" name="employee_department" onclick="console.log($(this).val())">
                                @foreach ($Departments as $Department)
                                    <option value="{{ $Department->id }}"  @if ($Employee->department->Name == $Department->Name)
                                        selected
                                    @endif >
                                        {{ $Department->Name }}
                                    </option>
                                @endforeach
                               </select>
                              </div>
                             </div>
                         </div>

                         <div class="row">
                         <div class="col">
                            <label for="inputName" class="control-label">{{ trans('employees-trans.Positions') }} : <span class="text-danger">*</span></label>
                            <select multiple name="position_id[]" class="form-control custom-select" id="exampleFormControlSelect2">

                                @foreach($Employee->department->positions->where('Status',1) as $dep_position)

                                     <option  value="{{$dep_position->id}}"
                                        @if($Employee->positions->containsStrict('id', $dep_position->id))
                                         selected
                                           @endif
                                        >{{$dep_position->Role}}</option>

                                @endforeach
                                {{-- @foreach($list_Position->employees as $employee)
                                    <option  value="{{$employee->id}}" selected>{{$employee->FName}}</option>
                                @endforeach --}}

                            </select>
                        </div>
                        <div class="col">

                                <label
                                    for="exampleFormControlTextarea1">{{ trans('employees-trans.Skills') }}
                                    : <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="Skills"  id="exampleFormControlTextarea1"
                                        rows="4">{{ $Employee->Skills }}</textarea>
                        </div>
                         </div>

                         <br>
                         <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="Trainee">{{ trans('employees-trans.Trainee') }}
                                        : <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-lg"
                                        id="exampleFormControlSelect1" name="Trainee">
                                    <option  value=" {{ trans('employees-trans.Yes') }}"  @if ($Employee->Trainee == 'Yes' || $Employee->Trainee== 'نعم')
                                      selected @endif >
                                      {{ trans('employees-trans.Yes') }}
                                    </option>
                                    <option value="{{ trans('employees-trans.No') }}"  @if ($Employee->Trainee == 'No' || $Employee->Trainee == 'لا')
                                      selected @endif>
                                      {{ trans('employees-trans.No') }}
                                    </option>
                                    </select>
                                 </div>
                           </div>

                           <div class="col">
                            <div class="form-group">
                              <label
                              for="exampleFormControlTextarea1">{{ trans('employees-trans.Gender') }}
                              : <span class="text-danger">*</span></label>
                              <select class="form-control form-control-lg"
                                  id="exampleFormControlSelect1" name="Gender">
                              <option  value=" {{ trans('employees-trans.Male') }}"  @if ($Employee->Gender == 'Male' || $Employee->Gender== 'ذكر')
                                selected @endif >
                                {{ trans('employees-trans.Male') }}
                              </option>
                              <option value="{{ trans('employees-trans.Female') }}"  @if ($Employee->Gender == 'Female' || $Employee->Gender== 'أنثى')
                                selected @endif >
                                {{ trans('employees-trans.Female') }}
                              </option>
                              </select>
                           </div>
                       </div>

                         <div class="col">
                        <label
                        for="exampleFormControlTextarea1">{{trans('employees-trans.Location')}}
                        : <span class="text-danger">*</span></label>
                        <select name="location_id"  class="form-control form-control-lg" class="custom-select" >

                            @foreach($Employee->department->locations as $dep_location)

                            <option  value="{{$dep_location->id}}"
                               @if($Employee->location->id == $dep_location->id))
                                selected
                                  @endif
                               >{{$dep_location->Address}}</option>

                       @endforeach

                        </select>
                       </div>
                          </div>
                          <br>
                         <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="BirthDate">{{ trans('employees-trans.BirthDate') }}
                                        :</label>
                                    <input type="date" name="BirthDate" id="BirthDate" class="form-control" value="{{$Employee->BirthDate}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="HireDate">{{ trans('employees-trans.HireDate') }}
                                        : <span class="text-danger">*</span></label>
                                    <input type="date" name="HireDate" id="HireDate" class="form-control" value="{{$Employee->HireDate}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                <label for="code">{{ trans('employees-trans.Code') }}
                                 : <span class="text-danger">*</span></label>
                               <input type="text" name="Code" class="form-control" value="{{$Employee->Code}}">

                              </div>
                            </div>
                         </div>
                         <br>
                         <div class="row">
                            <div class="col">
                                    <div class="form-group">
                                        <label for="Address">{{ trans('employees-trans.Address') }}
                                            : <span class="text-danger">*</span></label>
                                        <input type="text" name="Address" id="Address" class="form-control" value="{{$Employee->Address}}" >
                                    </div>
                            </div>
                            <div class="col">
                                    <div class="form-group">
                                        <label for="YearsOfExp">{{ trans('employees-trans.YearsOfExp') }}
                                            : <span class="text-danger">*</span></label>
                                        <input type="number" name="YearsOfExp" id="YearsOfExp" class="form-control" value="{{$Employee->Years_Of_Experience}}">
                                    </div>
                                    <br><br>
                          </div>
                          <div class="col mt-5">
                            <div class="form-check ">
                                @if ($Employee->Manager === 1)
                                    <input
                                        type="checkbox"
                                        checked
                                        class="form-check-input"
                                        name="Status"
                                        id="exampleCheck1">
                                @else
                                    <input
                                        type="checkbox"
                                        class="form-check-input"
                                        name="Status"
                                        id="exampleCheck1">
                                @endif
                                <label
                                    class="form-check-label"
                                    for="exampleCheck1">{{ trans('employees-trans.Manager') }}</label>
                            </div>
                         </div>

                         </div>
                         <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                  <label for="academic_year">{{trans('employees-trans.Photo')}} : </label>
                                  <input  id="idupload" type="file" accept="image/*" name="Updatephoto" >
                              </div>
                          </div>
                            </div>

                            <div class="col-md-4">
                              <div class='item-box live-preview' style='height:300px; width:300px;'>
                                @if (file_exists('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName))
                                    <img src="{{ URL::asset('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName) }}" width="300" height="300"  id ="imagepreview" alt="Image Preview"  />
                                    @else
                                    <img src="{{ URL::asset('assets/images/385-3856300_no-avatar-png.png') }}" id ="imagepreview" width="300" height="300"  alt="Image Preview" />
                                @endif
                                </div>
                          </div>

                         <br>
                          </div>
                             <div class="modal-footer">
                           <button type="submit"
                                    class="btn btn-success">{{ trans('employees-trans.Submit') }}</button></div>

              </form>


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


</script>
   @endsection

