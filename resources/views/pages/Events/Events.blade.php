@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('events-trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('events-trans.title_page')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('event.index')}}">{{trans('events-trans.title_page')}}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('events-trans.title_page') }}
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

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('events-trans.add_Event') }}
            </button>
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0" style="text-align: center">
                        <thead>
                        <tr>
                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                            <th>#</th>
                            <th>{{ trans('events-trans.Event_Title') }}</th>
                            <th>{{ trans('events-trans.Event_Start') }}</th>
                            <th>{{ trans('events-trans.Event_End') }}</th>
                            <th>{{ trans('events-trans.Processes') }}</th>

                            </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($events as $Event)
                            <tr>
                                <?php $i++; ?>
                                <td><input type="checkbox"  value="{{ $Event->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>{{ $Event->title }}</td>
                                <td>{{ $Event->start }}</td>
                                <td>{{ $Event->end }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $Event->id }}"
                                        title="{{ trans('departments-trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $Event->id }}"
                                        title="{{ trans('departments-trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Event -->
                            <div class="modal fade" id="edit{{ $Event->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('events-trans.edit_Event') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- edit_form -->
                                            <form action="{{ route('event.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name_ar"
                                                               class="mr-sm-2">{{ trans('events-trans.E_Name_ar') }}
                                                            : <span class="text-danger">*</span></label>
                                                        <input id="Name_ar" type="text" name="Name_Event_ar"
                                                               class="form-control"
                                                               value="{{ $Event->getTranslation('title', 'ar') }}"
                                                               required>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $Event->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en"
                                                               class="mr-sm-2">{{ trans('events-trans.E_Name_en') }}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                               value="{{ $Event->getTranslation('title', 'en') }}"
                                                               name="Name_Event_en" required>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="control-label" for="From"><strong>{{trans('attendance-trans.From')}} : </strong></label>
                                                        <input type="date" name="From"  class="form-control form-control-lg " id="From" value="{{ $Event->start }}">
                                                    </div>
                                                    <div class="col">
                                                        <label class="control-label" for="To"><strong>{{trans('attendance-trans.To')}} : </strong></label>
                                                        <input type="date" name="To" class="form-control form-control-lg " id="To" value="{{ $Event->end }}">
                                                        <input type="hidden" name="id" value="{{ $Event->id }}">
                                                    </div>
                                            </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('events-trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('events-trans.Submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- delete_modal_Event -->
                            <div class="modal fade" id="delete{{ $Event->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('departments-trans.Delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('event.destroy', 'test') }}"
                                                  method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('events-trans.Warning_Event') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $Event->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('events-trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('events-trans.Delete') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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


<!-- add_modal_Event -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('events-trans.add_Event') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('event.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Events">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="Name_ar"
                                                class="mr-sm-2">{{ trans('events-trans.E_Name_ar') }}
                                                : <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="Name_Event_ar" />
                                        </div>


                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('events-trans.E_Name_en') }}
                                                : <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="Name_Event_en" />
                                        </div>


                                        <div class="col">
                                            <label for=""
                                                class="mr-sm-2">{{ trans('events-trans.Processes') }}
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="{{ trans('departments-trans.delete_row') }}" />
                                        </div>
                                    </div>
                                    <br>
                                        <div class="row">
                                            <div class="col">

                                                <label class="control-label" for="From"><strong>{{trans('attendance-trans.From')}} : </strong></label>
                                                <input type="date" name="From"  class="form-control form-control-lg " id="From" >
                                            </div>
                                            <div class="col">
                                                <label class="control-label" for="To"><strong>{{trans('attendance-trans.To')}} : </strong></label>
                                                <input type="date" name="To" class="form-control form-control-lg " id="To">
                                            </div>
                                        </div>
                                        <br><br>
                                    </div>
                                </div>


                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('departments-trans.add_row') }}"/>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('events-trans.Close') }}</button>
                                <button type="submit"
                                    class="btn btn-success">{{ trans('events-trans.Submit') }}</button>
                            </div>

                        </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>




<!--delete_Group_Of_events -->
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

       <form action="{{ route('delete_all_events') }}" method="POST">
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
