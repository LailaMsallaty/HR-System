<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered p-0 " style="text-align: center">
    <thead>
        <tr class="table-secondary">
            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
            <th>#</th>
            <th>{{ trans('awards-trans.Employee') }}</th>
            <th>{{ trans('employees-trans.Code') }}</th>
            <th>{{ trans('employees-trans.Punishment_Name') }}</th>
            <th>{{ trans('employees-trans.Punishment_Description') }}</th>
            <th>{{ trans('employees-trans.Deducted_Amount') }}</th>
            <th>{{ trans('employees-trans.Punishment_Statement') }}</th>
            <th>{{ trans('employees-trans.Punishment_Date') }}</th>
            <th>{{ trans('employees-trans.Processes') }}</th>

    </tr>
    </thead>
    <tbody>
        @if ($Punishments->count())
        <?php $i = 0; ?>
        @foreach ($Punishments as $Punishment)
            <tr>
                <?php $i++; ?>
                <td><input type="checkbox"  value="{{ $Punishment->id }}" class="box1" ></td>
                <td>{{ $i }}</td>
                <td>{{ $Punishment->FName }} {{ $Punishment->LName }}</td>
                <td>{{ $Punishment->Code }}</td>
                <td>{{ $Punishment->Name }}</td>
                <td>{{ $Punishment->Description }}</td>
                <td>{{ $Punishment->Deducted_Amount }}</td>
                <td>{{ $Punishment->Statement }}</td>
                <td>{{ $Punishment->created_at }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#edit{{ $Punishment->id }}"
                        title="{{ trans('employees-trans.Edit') }}"><i class="fa fa-edit"></i></button>
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
                                           <form action="{{ route('Punishment_employee_update', 'test') }}" method="POST">
                                            @csrf
                                               <div class="row">
                                                       <div class="col">
                                                           <label for=""
                                                           class="mr-sm-2">{{ trans('awards-trans.Location') }}
                                                        :  <span class="text-danger">*</span></label>

                                                        <select class="form-control  form-control-lg"
                                                        id="exampleFormControlSelect1" name="location_id" onclick="console.log($(this).val())">
                                                           @foreach ($locations as $Location)
                                                               <option value="{{ $Location->id }}" @if($Punishment->Location_Id == $Location->id)
                                                                   selected
                                                               @endif>
                                                                   {{ $Location->Address }}
                                                               </option>
                                                           @endforeach
                                                        </select>
                                                        <input type="hidden" name="id" value="{{ $Punishment->id }}">

                                                       </div>
                                                       <div class="col">
                                                           <label for=""
                                                           class="mr-sm-2">{{ trans('employees-trans.Department') }}
                                                        :  <span class="text-danger">*</span></label>
                                                           <select name="department_id"  class="form-control form-control-lg" class="custom-select" >


                                                               @foreach($Departments->where('id',$Punishment->DepartmentID) as $department)
                                                               <option  value="{{$department->id}}"
                                                                   @if($Punishment->DepartmentID == $department->id)
                                                                   selected
                                                                   @endif
                                                                  >{{$department->Name}}</option>

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


                                                       @foreach($Employees->where('Location_Id',$Punishment->Location_Id) as $employee)
                                                       <option  value="{{$employee->id}}"
                                                           @if($Punishment->EmployeeID == $employee->id)
                                                           selected
                                                           @endif
                                                          >{{$employee->FName}} {{$employee->LName}}</option>

                                                  @endforeach
                                                   </select>
                                               </div>

                                                   <div class="col">
                                                       <label class="control-label" for="award"
                                                       class="mr-sm-2">{{ trans('awards-trans.Award_type') }}
                                                       : <span class="text-danger">*</span></label>
                                                       <select class="form-control form-control-lg" name="punishment_id" id="">
                                                           @foreach($punishments as $punishment)
                                                           <option value="{{ $punishment->id }}" @if ($Punishment->Name == $punishment->Name)
                                                               selected
                                                           @endif >
                                                               {{ $punishment->Name }}
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
                                                    :</label>
                                                    <textarea class="form-control" rows="2" name="statement" >{{ $Punishment->Statement }}</textarea>
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

    @endforeach
    @else
    {{-- if there are no employees then show this message --}}
    <tr>
        <td colspan="10"><h6 class="grey-text text-center">{{trans('attendance-trans.No_Employees_Found')}}</h6></td>
    </tr>
    @endif
    </tbody>
</table>
<button type="button" class="btn x-small  btn-danger " id="btn_delete_all">
    {{ trans('employees-trans.delete_checkbox') }}
    </button>
</div>


<!--delete_Group_Of_employees -->
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

       <form action="{{ route('delete_all_Impose_Punishments') }}" method="POST">
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


