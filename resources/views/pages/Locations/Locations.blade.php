
@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('locations-trans.Locations_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('locations-trans.title_page')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('location.index')}}">{{trans('locations-trans.title_page')}}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('locations-trans.Locations_list')}}
@stop
<!-- breadcrumb -->
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                   <button type="button" class="button x-small " data-toggle="modal" data-target="#exampleModal">
                                    {{ trans('locations-trans.Add_Location') }}
                                   </button>

                                   <br><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                            <th>#</th>
                                            <th>{{trans('locations-trans.Address')}}</th>
                                            <th>{{trans('locations-trans.Country')}}</th>
                                            <th>{{trans('locations-trans.City')}}</th>
                                            <th>{{trans('locations-trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($Locations as $Location)
                                            <tr>
                                            <?php $i++; ?>
                                            <td><input type="checkbox"  value="{{ $Location->id }}" class="box1" ></td>
                                            <td>{{ $i }}</td>
                                            <td>{{$Location->Address}}</td>
                                            <td>{{$Location->city->country->Name}}</td>
                                            <td>{{$Location->city->Name}}</td>
                                                <td>
                                                    <button type="button"  type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#edit_Location{{ $Location->id }}" title="{{ trans('locations-trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_Location{{ $Location->id }}" title="{{ trans('locations-trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                       <!-- edit_modal_Location -->
                            <div class="modal fade" id="edit_Location{{ $Location->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                               id="exampleModalLabel">
                                               {{ trans('locations-trans.Edit_Location') }}
                                           </h5>
                                           <button type="button" class="close" data-dismiss="modal"
                                                   aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>
                                       <div class="modal-body">

                                           <!-- edit_form -->
                                           <form action="{{ route('location.update','test') }}" method="POST">
                                               {{ method_field('patch') }}
                                               @csrf
                                               <div class="row">
                                                <div class="col">
                                                   <label for="Address_ar"
                                                          class="mr-sm-2">{{ trans('locations-trans.Address_ar') }}
                                                       : <span class="text-danger">*</span></label>
                                                   <input id="Address_ar" type="text" name="Address_ar"
                                                          class="form-control" value="{{$Location->getTranslation('Address', 'ar')}}"
                                                          required>
                                                   <input value="{{$Location->id}}" id="id" type="hidden" name="id" class="form-control"
                                                          >
                                                </div>
                                                <div class="col">
                                                    <label for="Address_en"
                                                           class="mr-sm-2">{{ trans('locations-trans.Address_en') }}
                                                        : <span class="text-danger">*</span></label>
                                                    <input id="Address_en" type="text" name="Address_en"
                                                           class="form-control"
                                                           value="{{ $Location->getTranslation('Address', 'en') }}"
                                                           required>
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $Location->id }}">
                                                </div>
                                               </div>
                                               <br>
                                        <div class="row">
                                                <div class="col">
                                                   <label for="location_country"
                                                   class="mr-sm-2">{{ trans('locations-trans.Country') }}
                                                : <span class="text-danger">*</span></label>
                                                   <select class="form-control "
                                                         id="exampleFormControlSelect1" name="location_country" onclick="console.log($(this).val())">
                                                         <option value ="" >
                                                                ...
                                                         </option>
                                                     @foreach ($Countries as $Country)
                                                     <option value="{{ $Country->id }}"  @if ($Location->city->country->Name == $Country->Name)
                                                        selected
                                                    @endif >
                                                        {{ $Country->Name }}
                                                    </option>
                                                     @endforeach
                                                    </select>
                                                 </div>
                                                  <div class="col">
                                                   <label for="location_city"
                                                   class="mr-sm-2">{{ trans('locations-trans.City') }}
                                                : <span class="text-danger">*</span></label>
                                                 <select  class="form-control " class="custom-select"
                                                     id="exampleFormControlSelect1" name="location_city">
                                                         <option value ="" >
                                                               ...
                                                       </option>
                                                     @foreach($Location->city->country->cities as $loc_city)

                                                     <option  value="{{$loc_city->id}}"
                                                        @if ($Location->city->Name == $loc_city->Name)
                                                        selected
                                                    @endif >
                                                        {{ $loc_city->Name }}
                                                    </option>
                                                     @endforeach
                                                    </select>
                                                  </div>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label for="location_departments"class="control-label">{{ trans('locations-trans.Departments') }} :</label>
                                                    <select multiple class="form-control custom-select"
                                                          id="exampleFormControlSelect1" name="location_departments[]">
                                                          @foreach($Departments as $department)

                                                          <option  value="{{$department->id}}"
                                                             @if($Location->departments->containsStrict('id', $department->id))
                                                              selected
                                                                @endif
                                                             >{{$department->Name}}</option>

                                                     @endforeach
                                                     </select>
                                                   </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="modal-footer">
                                                <button type="button"
                                                        class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('locations-trans.Close') }}</button>
                                                <button type="submit"
                                                        class="btn btn-success">{{ trans('locations-trans.Submit') }}</button>
                                            </div>

                                           </form>
                                    </div>
                                   </div>
                               </div>
                            </div>

                               {{-- delete location --}}

                                            <div class="modal fade" id="delete_Location{{$Location->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('location.destroy','test')}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('locations-trans.Delete_Location') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ trans('locations-trans.Warning_Location') }}</p>
                                                            <input type="hidden" name="id"  value="{{$Location->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('locations-trans.Close') }}</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">{{ trans('locations-trans.Submit') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>

                                        @endforeach
                                    </table>

                                    <button type="button" class="btn x-small  btn-danger " id="btn_delete_all">
                                        {{ trans('employees-trans.delete_checkbox') }}
                                        </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- add location --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   {{ trans('locations-trans.Add_Location') }}
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body "  >
               <!-- add_form -->
               <form action="{{ route('location.store') }}" method="POST">
                @csrf
                <div class="row">
                     <div class="col">
                        <label for="Address_ar"
                               class="mr-sm-2">{{ trans('locations-trans.Address_ar') }}
                            : <span class="text-danger">*</span></label>
                        <input id="Address_ar" type="text" name="Address_ar"
                               class="form-control"
                               required>
                        <input  id="id" type="hidden" name="id" class="form-control"
                               >
                     </div>
                     <div class="col">
                         <label for="Address_en"
                                class="mr-sm-2">{{ trans('locations-trans.Address_en') }}
                             : <span class="text-danger">*</span></label>
                         <input id="Address_en" type="text" name="Address_en"
                                class="form-control"
                                required>
                         <input id="id" type="hidden" name="id" class="form-control">
                     </div>
                </div>
                <br>
                <div class="row">
                     <div class="col">
                        <label for="location_country"
                        class="mr-sm-2">{{ trans('locations-trans.Country') }}
                     : <span class="text-danger">*</span></label>
                        <select class="form-control "
                              id="exampleFormControlSelect1" name="location_country"  onclick="console.log($(this).val())">
                              <option value ="" >
                                     ...
                              </option>
                          @foreach ($Countries as $Country)
                              <option value ="{{$Country->id}}" >
                                  {{ $Country->Name }}
                              </option>
                          @endforeach
                         </select>
                      </div>
                       <div class="col">
                        <label for="location_city"
                        class="mr-sm-2">{{ trans('locations-trans.City') }}
                     : <span class="text-danger">*</span></label>
                      <select class="form-control " class="custom-select"
                              id="exampleFormControlSelect1" name="location_city">
                              <option value ="" >
                                ...
                             </option>
                         </select>
                       </div>
                 </div>
                 <br>
                 <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="location_departments"class="control-label">{{ trans('locations-trans.Departments') }} :</label>
                        <select multiple class="form-control custom-select"
                              id="exampleFormControlSelect1" name="location_departments[]">
                              @foreach($Departments as $department)

                              <option  value="{{$department->id}}">{{$department->Name}}</option>

                              @endforeach
                         </select>
                       </div>
                    </div>
                </div>
                 <br>
                 <br>





                <br><br>

                     <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('locations-trans.Close') }}</button>
                    <button type="submit"
                            class="btn btn-success">{{ trans('locations-trans.Submit') }}</button>




              </div>
           </form>

            </div>


        </div>

    </div>


</div>


<!--delete_Group_Of_Cities -->
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

       <form action="{{ route('delete_all_Locations') }}" method="POST">
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
</div>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            $('select[name="location_country"]').on('click', function () {
                var location_country_id = $(this).val();
                if (location_country_id) {
                    $.ajax({
                        url: "{{ URL::to('cities') }}/" + location_country_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="location_city"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="location_city"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
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
