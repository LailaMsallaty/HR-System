@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('awards-trans.Give_Award') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('awards-trans.Give_Award')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                <li  class="breadcrumb-item active"><a href="{{route('Give_Award.index')}}">{{trans('awards-trans.Give_Award')}}</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('PageTitle')
{{ trans('awards-trans.Give_Award') }}
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
                {{ trans('awards-trans.Give_Award') }}
            </button>
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0" style="text-align: center">
                        <thead>
                        <tr>
                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
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
                                <td><input type="checkbox"  value="{{ $Award->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>{{ $Award->FName }} {{ $Award->LName }}</td>
                                <td>{{ $Award->Code }}</td>
                                <td>{{ $Award->Name }}</td>
                                <td>{{ $Award->Gift }}</td>
                                <td>{{ $Award->Cash_Prize }}</td>
                                <td>{{ $Award->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $Award->id }}"
                                        title="{{ trans('employees-trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $Award->id }}"
                                        title="{{ trans('employees-trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                    <a href="{{route('Give_Award.show',$Award->id)}}" class="btn btn-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>

                                </td>
                            </tr>

                            <!-- edit_modal_Award -->
                            <div class="modal fade" id="edit{{ $Award->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('awards-trans.edit_Award') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- edit_form -->
                                            <form action="{{ route('Give_Award.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="control-label" for="award"
                                                        class="mr-sm-2">{{ trans('awards-trans.Award_type') }}
                                                        : <span class="text-danger">*</span></label>
                                                        <select class="form-control form-control-lg" name="awardType" id="">
                                                            @foreach($awards as $award)
                                                            <option value="{{ $award->id }}" @if ($Award->Name == $award->Name)
                                                                selected
                                                            @endif >
                                                                {{ $award->Name }}
                                                            </option>
                                                            @endforeach

                                                </select>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for=""
                                                        class="mr-sm-2">{{ trans('awards-trans.Location') }}
                                                     :  <span class="text-danger">*</span></label>

                                                     <select class="form-control  form-control-lg"
                                                     id="exampleFormControlSelect1" name="location" onclick="console.log($(this).val())">
                                                        @foreach ($locations as $Location)
                                                            <option value="{{ $Location->id }}" @if($Award->Location_Id == $Location->id)
                                                                selected
                                                            @endif>
                                                                {{ $Location->Address }}
                                                            </option>
                                                        @endforeach
                                                     </select>
                                                     <input type="hidden" name="id" value="{{ $Award->id }}">

                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">

                                                    <div class="col">
                                                        <label for=""
                                                        class="mr-sm-2">{{ trans('awards-trans.Employee') }}
                                                     :  <span class="text-danger">*</span></label>
                                                        <select name="employee"  class="form-control form-control-lg" class="custom-select" >


                                                            @foreach($Employees->where('Location_Id',$Award->Location_Id) as $employee)
                                                            <option  value="{{$employee->id}}"
                                                                @if($Award->EmployeeID == $employee->id)
                                                                selected
                                                                @endif
                                                               >{{$employee->FName}} {{$employee->LName}}</option>

                                                       @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                        <div class="col">
                                                            <label for="Gift"
                                                            class="control-label">{{ trans('awards-trans.Gift') }} :  </label>
                                                            <input type="text" name="gift"  class="form-control form-control-lg" value="{{$Award->Gift}}">
                                                        </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="cache"
                                                            class="control-label">{{ trans('awards-trans.Cash_Prize') }} : <span class="text-danger">*</span></label>
                                                            <input type="number" name="Cash_Prize"  class="form-control form-control-lg" value="{{$Award->Cash_Prize}}">

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


                            <!-- delete_modal_Award -->
                            <div class="modal fade" id="delete{{ $Award->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('awards-trans.Delete_Award') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Give_Award.destroy', 'test') }}"
                                                  method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('employees-trans.Warning_Delete') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $Award->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('employees-trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('employees-trans.Delete') }}</button>
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

   {{--  give award  --}}
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
   aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                  id="exampleModalLabel">
                                   {{ trans('awards-trans.Give_Award') }}
                                     </h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body "  >
                                     <!-- add_form -->
                                     <form action="{{ route('Give_Award.store') }}" method="POST">
                                      @csrf
                                      <div class="row">
                                        <div class="col">
                                            <label class="control-label" for="award"
                                            class="mr-sm-2">{{ trans('awards-trans.Award_type') }}
                                            : <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-lg" name="awardType" id="">
                                                <option value="">...</option>
                                                @foreach($awards as $award)
                                                <option value="{{ $award->id }}" >
                                                    {{ $award->Name }}
                                                </option>
                                                @endforeach

                                    </select>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <label for=""
                                            class="mr-sm-2">{{ trans('awards-trans.Location') }}
                                         :  <span class="text-danger">*</span></label>

                                         <select class="form-control  form-control-lg"
                                         id="exampleFormControlSelect1" name="location" onclick="console.log($(this).val())">
                                         <option value="">...</option>
                                            @foreach ($locations as $Location)
                                                <option value="{{ $Location->id }}">
                                                    {{ $Location->Address }}
                                                </option>
                                            @endforeach
                                         </select>

                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">

                                        <div class="col">
                                            <label for=""
                                            class="mr-sm-2">{{ trans('awards-trans.Employee') }}
                                         :  <span class="text-danger">*</span></label>
                                            <select name="employee"  class="form-control form-control-lg" class="custom-select" >

                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                            <div class="col">
                                                <label for="Gift"
                                                class="control-label">{{ trans('awards-trans.Gift') }} : </label>
                                                <input type="text" name="gift"  class="form-control form-control-lg" >
                                            </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <label for="cache"
                                                class="control-label">{{ trans('awards-trans.Cash_Prize') }} : <span class="text-danger">*</span></label>
                                                <input type="number" name="Cash_Prize"  class="form-control form-control-lg">

                                        </div>
                                    </div>
                                    <br><br>


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




<!--delete_Group_Of_awards -->
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

       <form action="{{ route('delete_all_Give_Awards') }}" method="POST">
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

        $(document).ready(function () {
            $('select[name="location"]').on('click', function () {
                var location_id = $(this).val();
                if (location_id) {
                    $.ajax({
                        url: "{{ URL::to('Location_employees') }}/" + location_id,
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
