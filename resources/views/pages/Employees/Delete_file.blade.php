<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_file{{$attachment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('employees-trans.Delete_attachment')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('Delete_attachment')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$attachment->id}}">

                    <input type="hidden" name="employee_fname" value="{{$attachment->attachmentable->FName}}">
                    <input type="hidden" name="employee_lname" value="{{$attachment->attachmentable->LName}}">
                    <input type="hidden" name="employee_id" value="{{$attachment->attachmentable->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('employees-trans.Delete_attachment_title')}}</h5>
                    <input type="text" name="filename" readonly value="{{$attachment->filename}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('employees-trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('employees-trans.Delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
