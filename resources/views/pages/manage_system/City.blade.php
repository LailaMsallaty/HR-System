
@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('system-trans.Cities_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('system-trans.Cities_list')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('city.index')}}">{{trans('system-trans.Cities')}}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('system-trans.Cities_list')}}
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
                                    {{ trans('system-trans.Add_City') }}
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
                                            <th>{{trans('system-trans.Name')}}</th>
                                            <th>{{trans('system-trans.Country')}}</th>
                                           <th>{{trans('system-trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($Cities as $City)
                                            <tr>
                                            <?php $i++; ?>
                                            <td><input type="checkbox"  value="{{ $City->id }}" class="box1" ></td>
                                            <td>{{ $i }}</td>
                                            <td>{{$City->Name}}</td>
                                            <td>{{$City->country->Name}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#edit{{ $City->id }}"
                                                    title="{{ trans('system-trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                                     <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_City{{ $City->id }}" title="{{ trans('system-trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                       <!-- edit_modal_City -->
                            <div class="modal fade" id="edit{{ $City->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-lg" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                               id="exampleModalLabel">
                                               {{ trans('system-trans.edit_City') }}
                                           </h5>
                                           <button type="button" class="close" data-dismiss="modal"
                                                   aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>
                                       <div class="modal-body">

                                           <!-- edit_form -->
                                           <form action="{{ route('city.update','test') }}" method="POST">
                                               {{ method_field('patch') }}
                                               @csrf
                                               <div class="row">
                                                <div class="col">
                                                   <label for="Name_ar"
                                                          class="mr-sm-2">{{ trans('system-trans.Name_ar_City') }}
                                                       : <span class="text-danger">*</span></label>
                                                   <input id="Name_ar" type="text" name="Name_ar"
                                                          class="form-control" value="{{$City->getTranslation('Name', 'ar')}}"
                                                          required>
                                                   <input value="{{$City->id}}" id="id" type="hidden" name="id" class="form-control"
                                                          >
                                                </div>
                                                <div class="col">
                                                    <label for="Name_en"
                                                           class="mr-sm-2">{{ trans('system-trans.Name_en_City') }}
                                                        : <span class="text-danger">*</span></label>
                                                    <input id="Name_en" type="text" name="Name_en"
                                                           class="form-control"
                                                           value="{{ $City->getTranslation('Name', 'en') }}"
                                                           required>
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $City->id }}">
                                                </div>
                                                <div class="col">
                                                    <div class="form-group ">
                                                      <label
                                                      for="exampleFormControlTextarea1">{{ trans('system-trans.Country') }}
                                                      : <span class="text-danger">*</span></label>
                                                    <select class="form-control  form-control-lg"
                                                          id="exampleFormControlSelect1" name="country">
                                                      @foreach ($Countries as $Country)
                                                          <option value="{{ $Country->id }}"  @if ($City->country->Name == $Country->Name)
                                                              selected
                                                          @endif >
                                                              {{ $Country->Name }}
                                                          </option>
                                                      @endforeach
                                                     </select>
                                                    </div>
                                                   </div>
                                               </div>
                                               <br><br>

                                               <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary"
                                                           data-dismiss="modal">{{ trans('system-trans.Close') }}</button>
                                                   <button type="submit"
                                                           class="btn btn-success">{{ trans('system-trans.Submit') }}</button>
                                               </div>

                                           </form>
                                    </div>
                                   </div>
                               </div>
                            </div>

                               {{-- delete City --}}

                                            <div class="modal fade" id="delete_City{{$City->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('city.destroy','test')}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('system-trans.Delete_City') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ trans('system-trans.Warning_City') }}</p>
                                                            <input type="hidden" name="id"  value="{{$City->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('system-trans.Close') }}</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">{{ trans('system-trans.Submit') }}</button>
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

    {{-- add City --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                   {{ trans('system-trans.Add_City') }}
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body "  >
               <!-- add_form -->
               <form action="{{ route('city.store') }}" method="POST">
                @csrf
        <div class="card-body">
            <div class="repeater">
                <div data-repeater-list="List_Cities">
                    <div data-repeater-item>
                      <div class="row">
                        <div class="col">
                            <label for="Name_ar"
                               class="mr-sm-2">{{ trans('system-trans.Name_ar_City') }}
                            : <span class="text-danger">*</span></label>
                        <input id="Name_ar" type="text" name="Name_ar"
                               class="form-control"
                               required>
                        <input  id="id" type="hidden" name="id" class="form-control"
                               >
                     </div>
                     <div class="col">
                         <label for="Name_en"
                                class="mr-sm-2">{{ trans('system-trans.Name_en_City') }}
                             : <span class="text-danger">*</span></label>
                         <input id="Name_en" type="text" name="Name_en"
                                class="form-control"
                                required>
                         <input id="id" type="hidden" name="id" class="form-control">
                     </div>

                     <div class="col">
                        <div class="form-group">
                            <label
                            for="exampleFormControlTextarea1">{{ trans('system-trans.select_country') }}
                            : <span class="text-danger">*</span></label>
                        <select class="form-control form-control-lg"
                              id="exampleFormControlSelect1" name="country">
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
                       </div>
                <br>
                 <br>
                 <br>




                 <div class="col">
                    <label for="delete_row"
                        class="mr-sm-2">{{ trans('departments-trans.Processes') }}
                        :</label>
                    <input class="btn btn-danger btn-block" data-repeater-delete
                        type="button" value="{{ trans('system-trans.delete_row') }}" />
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-20">
        <div class="col-12">
            <input class="button" data-repeater-create type="button" value="{{ trans('system-trans.add_row') }}"/>
        </div>

    </div>

                <br><br>

                     <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('system-trans.Close') }}</button>
                    <button type="submit"
                            class="btn btn-success">{{ trans('system-trans.Submit') }}</button>



                     </div>
                    </div>
                </div>
              </div>
           </form>

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

       <form action="{{ route('delete_all_Cities') }}" method="POST">
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
