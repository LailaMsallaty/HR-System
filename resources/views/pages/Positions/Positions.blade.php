@extends('layouts.master')

@section('css')
    @toastr_css
@section('title')
    {{ trans('positions-trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('positions-trans.Positions')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('position.index')}}">{{trans('positions-trans.title_page')}}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('positions-trans.title_page') }}
@stop
@section('content')

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('positions-trans.add_Position') }}</a>
            </div>
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                 @endif
 <div class="card card-statistics h-100">
    <div class="card-body">
        <div class="accordion gray plus-icon round">

            @foreach($departments_positions as $department_position)

            <div class="acd-group">
                <a href="#" class="acd-heading">{{ $department_position->Name }}</a>
                <div class="acd-des">
                    <div class="row">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="d-block d-md-flex justify-content-between">
                                        <div class="d-block">
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-15">
                                        <table class="table center-aligned-table mb-0">
                                            <thead>
                                            <tr class="text-dark">
                                                <th>#</th>
                                                <th>{{ trans('positions-trans.Role') }}</th>
                                                <th>{{ trans('positions-trans.Status') }}</th>
                                                <th>{{ trans('positions-trans.Salary') }}</th>
                                                <th>{{ trans('positions-trans.FT_PT') }}</th>
                                                <th>{{ trans('positions-trans.Requirements') }}</th>
                                                {{-- <th>{{ trans('positions-trans.Employee_Role') }}</th> --}}
                                                <th>{{trans('positions-trans.Processes')}}</th>
                                         </tr>
                                        </thead>
                    <tbody>
                    <?php $i = 0 ?>
                    @foreach($department_position->positions as $list_Position)
                       <tr>
                        <?php $i++; ?>
                        <td>{{ $i }}</td>
                        <td>{{ $list_Position->Role }}</td>
                        <td>
                            @if ($list_Position->Status === 1)
                                <label
                                    class="badge badge-success">{{ trans('positions-trans.Status_Section_AC') }}</label>
                            @else
                                <label
                                    class="badge badge-danger">{{ trans('positions-trans.Status_Section_No') }}</label>
                            @endif

                        </td>
                        <td>{{ $list_Position->Salary }}</td>
                        <td>{{ $list_Position->FT_PT }}</td>
                        <td>{{ $list_Position->Requirements }}</td>
                        {{-- <td>{{ $list_Position->employees->FName }}</td> --}}
                        <td>
                            <button type="button" class=" btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#edit{{ $list_Position->id }}"
                                    title="{{ trans('positions-trans.Edit') }}"><i
                                    class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete{{ $list_Position->id }}"
                                    title="{{ trans('positions-trans.Delete') }}"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                     </tr>

            <!-- edit_modal_Position -->
            <div class="modal fade"
            id="edit{{ $list_Position->id }}"
            tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            style="font-family: 'Cairo', sans-serif;"
                            id="exampleModalLabel">
                            {{ trans('positions-trans.edit_Position') }}
                        </h5>
                        <button type="button" class="close"
                                data-dismiss="modal"
                                aria-label="Close">
                        <span
                            aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body "  >
                    <!-- edit_form -->
                    <form  action="{{ route('position.update','test') }}" method="POST">
                        {{ method_field('patch')}}
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Role_ar"
                                        class="mr-sm-2">{{ trans('positions-trans.Role_ar') }} : <span class="text-danger">*</span></label>
                                <input id="Role_ar" type="text" name="Role_ar" class="form-control"  value="{{$list_Position->getTranslation('Role','ar')}}" required>
                            </div>
                            <div class="col">
                                <label for="Role_en"
                                        class="mr-sm-2">{{ trans('positions-trans.Role_en') }} : <span class="text-danger">*</span></label>
                                <input id="Role_en" type="text" class="form-control" name="Role_en"  value="{{$list_Position->getTranslation('Role','en')}}"  required>
                                <input id="id" type="hidden" class="form-control" name="id"  value="{{$list_Position->id}}" >

                            </div>
                          </div>
                          <br>
                         <div class="row">
                             <div class="col">
                                <label for="Salary"
                                    class="mr-sm-2">{{ trans('positions-trans.Salary') }} : <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="Salary" value="{{$list_Position->Salary}}"  required >
                             </div>
                             <div class="col">
                                <label for="FT_PT"
                                    class="mr-sm-2">{{ trans('positions-trans.FT_PT') }} : <span class="text-danger">*</span></label>
                                 <select class="form-control" name="FT_PT" required>
                                    <option value="{{ trans('positions-trans.FT') }}"
                                        @if ($list_Position->FT_PT == 'Full Time' || $list_Position->FT_PT == 'دوام كامل')
                                        selected @endif>{{ trans('positions-trans.FT') }}</option>


                                    <option value="{{ trans('positions-trans.PT') }}"
                                    @if ($list_Position->FT_PT == 'Part Time' || $list_Position->FT_PT == 'دوام جزئي')
                                    selected @endif>{{ trans('positions-trans.PT')}}</option>
                                 </select>
                                 </div>

                         </div>
                        <br>
                        <div class="row">
                            <div class="col">
                            <div class="form-group">
                                <label
                                for="exampleFormControlTextarea1">{{ trans('positions-trans.Department') }}
                                : <span class="text-danger">*</span></label>
                                <select class="form-control "
                                    id="exampleFormControlSelect1" name="position_department"  onclick="console.log($(this).val())">
                                @foreach ($Departments as $Department)
                                    <option value="{{ $Department->id }}"  @if ($list_Position->department->Name == $Department->Name)
                                        selected
                                    @endif >
                                        {{ $Department->Name }}
                                    </option>
                                @endforeach
                                </select>
                                </div>
                            </div>

                        </div>
                            <div class="form-group">
                                <label
                                    for="exampleFormControlTextarea1">{{ trans('positions-trans.Requirements') }}
                                    :</label>
                                <textarea class="form-control" name="Requirements"  id="exampleFormControlTextarea1"
                                        rows="3">{{$list_Position->Requirements}} </textarea>
                               </div>
                               <div class="col">
                                <div class="form-check">
                                    @if ($list_Position->Status === 1)
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
                                        for="exampleCheck1">{{ trans('positions-trans.Status') }}</label>
                                </div>
                            </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('positions-trans.Close') }}</button>
                        <button type="submit"
                                class="btn btn-success">{{ trans('positions-trans.Submit') }}</button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
            </div>
                                <!-- delete_modal_Position -->
                                        <div class="modal fade" id="delete{{ $list_Position->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('positions-trans.delete_Position') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('position.destroy','test')}}" method="post">
                                                        {{method_field('Delete')}}
                                                        @csrf
                                                        {{ trans('positions-trans.Warning_Position') }}


                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $list_Position->id }}">

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('positions-trans.Close') }}</button>
                                                            <button type="submit"
                                                                    class="btn btn-danger">{{ trans('positions-trans.Delete') }}</button>
                                                                    </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>




                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
      <!-- add_modal_Position -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                     id="exampleModalLabel">
                     {{ trans('positions-trans.add_Position') }}
                 </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body "  >
                 <!-- add_form -->
                 <form  action="{{ route('position.store') }}" method="POST">
                     @csrf
                     <div class="row">
                         <div class="col">
                                <label for="Role_ar"
                                        class="mr-sm-2">{{ trans('positions-trans.Role_ar') }} : <span class="text-danger">*</span> </label>
                                <input id="Role_ar" type="text" name="Role_ar" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="Role_en"
                                        class="mr-sm-2">{{ trans('positions-trans.Role_en') }} : <span class="text-danger">*</span></label>
                                <input id="Role_en" type="text" class="form-control" name="Role_en"  required>
                            </div>
                     </div>
                     <br>
                     <div class="row">
                            <div class="col">
                                <label for="Salary"
                                    class="mr-sm-2">{{ trans('positions-trans.Salary') }} : <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="Salary" required>
                            </div>
                            <div class="col">
                                <label for="FT_PT"
                                    class="mr-sm-2">{{ trans('positions-trans.FT_PT') }} : <span class="text-danger">*</span></label>
                                <select class="form-control" name="FT_PT"   required>
                                    <option value="">...</option>
                                    <option value="{{ trans('positions-trans.FT') }}">{{ trans('positions-trans.FT') }}</option>
                                    <option value="{{ trans('positions-trans.PT') }}">{{ trans('positions-trans.PT') }}</option>
                                </select>
                            </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col">
                            <div class="form-group">
                              {{-- <label
                              for="exampleFormControlTextarea1">{{ trans('employees-trans.employee_department') }}
                              :</label> --}}
                            <select class="form-control custom-select"
                                  onclick="console.log($(this).val())"
                                  id="exampleFormControlSelect1" name="position_department">
                                  <option value ="" >
                              {{trans('employees-trans.select_department')}} <span class="text-danger">*</span>
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
                     <br>
                            <div class="form-group">
                                <label
                                    for="exampleFormControlTextarea1">{{ trans('positions-trans.Requirements') }}
                                    :</label>
                                <textarea class="form-control" name="Requirements"  id="exampleFormControlTextarea1"
                                        rows="3"></textarea>
                            </div>
                            <br><br>


                 </div>

             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary"
                         data-dismiss="modal">{{ trans('positions-trans.Close') }}</button>
                 <button type="submit"
                         class="btn btn-success">{{ trans('positions-trans.Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
 </div>
    </div>
    </div>
</div>
</div>
</div>
<br>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

@endsection

