<!-- Deleted inFormation Student -->
<div class="modal fade" id="Return_Employee{{$Employee->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('employees-trans.Return_Employee') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('resigned.update','test')}}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{$Employee->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{ trans('employees-trans.Warning_Employee_Return') }}</h5>
                    <input type="text" readonly value="{{$Employee->FName.' '.$Employee->LName}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('employees-trans.Close')}}</button>
                        <button  class="btn btn-success">{{trans('employees-trans.Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
