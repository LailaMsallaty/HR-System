@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('employees-trans.Punishments') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('employees-trans.Punishments')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('punishment.index')}}">{{trans('employees-trans.Punishments')}}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('employees-trans.Punishments') }}
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
                {{ trans('employees-trans.add_Punishment') }}
            </button>
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0" style="text-align: center">
                        <thead>
                        <tr>
                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                            <th>#</th>
                            <th>{{ trans('employees-trans.Punishment_Name') }}</th>
                            <th>{{ trans('employees-trans.Punishment_Description') }}</th>
                            <th>{{ trans('employees-trans.Deducted_Amount') }}</th>
                            <th>{{ trans('employees-trans.Processes') }}</th>

                            </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($Punishments as $Punishment)
                            <tr>
                                <?php $i++; ?>
                                <td><input type="checkbox"  value="{{ $Punishment->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>{{ $Punishment->Name }}</td>
                                <td>{{ $Punishment->Description }}</td>
                                <td>{{ $Punishment->Deducted_Amount }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $Punishment->id }}"
                                        title="{{ trans('employees-trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $Punishment->id }}"
                                        title="{{ trans('employees-trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Punishment -->
                            <div class="modal fade" id="edit{{ $Punishment->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('employees-trans.edit_Punishment') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- edit_form -->
                                            <form action="{{ route('punishment.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name_ar"
                                                               class="mr-sm-2">{{ trans('employee-trans.P_Name_ar') }}
                                                            : <span class="text-danger">*</span></label>
                                                        <input id="Name_ar" type="text" name="Name_Punishment_ar"
                                                               class="form-control"
                                                               value="{{ $Punishment->getTranslation('Name', 'ar') }}"
                                                               required>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $Punishment->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en"
                                                               class="mr-sm-2">{{ trans('employees-trans.P_Name_en') }}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                               value="{{ $Punishment->getTranslation('Name', 'en') }}"
                                                               name="Name_Punishment_en" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="Amount"
                                                               class="mr-sm-2">{{ trans('employees-trans.Deducted_Amount') }}
                                                            : </label>
                                                        <input type="number" class="form-control"
                                                               value="{{ $Punishment->Deducted_Amount }}"
                                                               name="amount" >
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <label for=""
                                                        class="mr-sm-2">{{ trans('employees-trans.Punishment_Description') }}
                                                        :</label>
                                                        <textarea class="form-control" rows="2" name="description" >{{ $Punishment->Description }}</textarea>
                                                    </div>
                                                </div>


                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('employees-trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('employees-trans.Submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- delete_modal_Punishment -->
                            <div class="modal fade" id="delete{{ $Punishment->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('employees-trans.delete_Punishment') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('punishment.destroy', 'test') }}"
                                                  method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('employees-trans.Warning_Punishment') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $Punishment->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('departments-trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('departments-trans.Delete') }}</button>
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


<!-- add_modal_Department -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('employees-trans.add_Punishment') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('punishment.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Punishments">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="Name_ar"
                                                class="mr-sm-2">{{ trans('employees-trans.P_Name_ar') }}
                                                : <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="Name_Punishment_ar" />
                                        </div>


                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('employees-trans.P_Name_en') }}
                                                : <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="Name_Punishment_en" />
                                        </div>


                                        <div class="col">
                                            <label for="Amount"
                                                   class="mr-sm-2">{{ trans('employees-trans.Deducted_Amount') }}
                                                : </label>
                                            <input type="number" class="form-control"
                                                   name="amount" required>
                                        </div>
                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('employees-trans.Processes') }}
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="{{ trans('departments-trans.delete_row') }}" />
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <label for=""
                                            class="mr-sm-2">{{ trans('employees-trans.Punishment_Description') }}
                                            :</label>
                                            <textarea class="form-control" rows="2" name="description" ></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('departments-trans.add_row') }}"/>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('departments-trans.Close') }}</button>
                                <button type="submit"
                                    class="btn btn-success">{{ trans('departments-trans.Submit') }}</button>
                            </div>

                        </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>




<!--delete_Group_Of_Departments -->
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

       <form action="{{ route('delete_all_Punishments') }}" method="POST">
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
