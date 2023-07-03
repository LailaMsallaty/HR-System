<?php

use Spatie\Permission\Models\Permission;

 ?>
@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('employees-trans.E_Profile') }}
@stop
@endsection
@section('page-header')
@endsection
@section('PageTitle')
{{ trans('employees-trans.title_page') }}
@stop

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ trans('employees-trans.E_Profile') }}</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main-trans.Home')}}</a></li>
                    <li  class="breadcrumb-item "><a href="{{route('employee.index')}}">{{trans('employees-trans.title_page')}}</a></li>
                    <li class="breadcrumb-item active">
                            <a href="{{route('employee.show',$Employee->id)}}">{{trans('employees-trans.E_Profile')}}</a>
                    </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="text-center mt-2" style="font-family: 'Cairo', sans-serif;color: #8b008b">{{trans('employees-trans.Profile').' '.$Employee->FName.' '.$Employee->LName}}</h5>

                    </div>
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">{{trans('employees-trans.personal_information')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{trans('employees-trans.Attachments')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="advance-02-tab" data-toggle="tab" href="#advance-02"
                                       role="tab" aria-controls="advance-02"
                                       aria-selected="false">{{trans('salaries-trans.Advance_Payments')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                     <div class="row mb-3">
                                        <div class="col text-center mx-auto">
                                            @if (file_exists('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName))
                                                <img src='{{ URL::asset('attachments/employees/'.$Employee->FName.'_'.$Employee->LName.'/'.$Employee->ImageName) }}' width='300' height='300' class="img-fluid rounded-circle d-block m-auto"
                                                style="box-shadow: 2px 4px rgba(0,0,0,0.1) width: 300px; height: 300px;" id ="imagepreview" />


                                                @else
                                                <img src='{{ URL::asset('assets/images/385-3856300_no-avatar-png.png') }}' class="img-fluid rounded-circle d-block m-auto"
                                                style="box-shadow: 2px 4px rgba(0,0,0,0.1) width: 300px; height: 300px;" />

                                            @endif

                                        </div>

                                    </div>
                         <div class="text-center mx-auto">
                                    <form action="{{ route('upload_personal_photo') }}" method="POST" enctype="multipart/form-data" id="idForm">
                                        @csrf
                                        <div class="form-group">
                                            <label for="academic_year">{{trans('employees-trans.Photo')}} : </label>
                                            <input id="idupload" type="file" accept="image/*" name="photo" >
                                            <input  type="hidden"  name="id" value="{{ $Employee->id }}" >
                                        </div>
                                    <button type="submit"
                                    class="btn btn-success">{{ trans('employees-trans.Submit_Photo') }}</button>
                                </form>
                          </div>
                                <br>
                            <table class="table table-striped table-hover" style="text-align:center">

                            <tr>
                                <td>{{trans('employees-trans.FName')}}</td>
                                <td>{{ $Employee->FName }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.LName')}}</td>
                                <td>{{ $Employee->LName }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.BirthDate')}}</td>
                                <td>{{ $Employee->BirthDate }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.Gender')}}</td>
                                <td>{{ $Employee->Gender }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.Nationality')}}</td>
                                <td>{{ $Employee->Nationality->Name }}</td>
                            </tr>

                            <tr>
                                <td>{{trans('employees-trans.HireDate')}}</td>
                                <td>{{ $Employee->HireDate }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.Skills')}}</td>
                                <td>{{ $Employee->Skills }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.Degree')}}</td>
                                <td>{{ $Employee->degree->Level }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.Positions')}}</td>
                                <td>
                                    @foreach ($positions as $position)
                                     -   {{ $position->Role }}   <br>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.Address')}}</td>
                                <td>{{ $Employee->Address }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.Number')}}</td>
                                <td>{{ $Employee->Number }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.Trainee')}}</td>
                                <td>{{ $Employee->Trainee }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.YearsOfExp')}}</td>
                                <td>{{ $Employee->Years_Of_Experience }}</td>
                            </tr>
                            <tr>
                                <td>{{trans('employees-trans.Salary')}}</td>
                                <td>

                                    {{ $Employee->Salary }}
                                <td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="profile-02" role="tabpanel"
                    aria-labelledby="profile-02-tab">
                   <div class="card card-statistics">
                       <div class="card-body">
                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','العمليات_على_الموظف')->first())

                           <form method="post" action="{{route('Upload_attachment')}}" enctype="multipart/form-data">
                               {{ csrf_field() }}
                               <div class="col-md-3">
                                   <div class="form-group">
                                       <label
                                           for="academic_year">{{trans('employees-trans.Attachments')}}
                                           : <span class="text-danger">*</span></label>
                                       <input type="file"  name="attachments[]" multiple required>
                                       <input type="hidden" name="employee_fname" value="{{$Employee->FName}}">
                                       <input type="hidden" name="employee_lname" value="{{$Employee->LName}}">
                                       <input type="hidden" name="employee_id" value="{{$Employee->id}}">
                                   </div>
                               </div>
                               <br><br>
                                <button type="submit" class="button button-border x-small">
                                    {{trans('employees-trans.Submit')}}
                                </button>

                           </form>
                           @endcan
                       </div>
                       <br>
                       <table class="table table-striped table-hover"
                              style="text-align:center">
                           <thead>
                           <tr class="table-secondary">
                               <th scope="col">#</th>
                               <th scope="col">{{trans('employees-trans.filename')}}</th>
                               <th scope="col">{{trans('employees-trans.created_at')}}</th>
                               <th scope="col">{{trans('employees-trans.Processes')}}</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($Employee->attachments()->orderby('id','desc')->get() as $attachment)
                               <tr style='text-align:center;vertical-align:middle'>
                                   <td>{{$loop->iteration}}</td>
                                   <td>{{$attachment->filename}}</td>
                                   <td>{{$attachment->created_at->diffForHumans()}}</td>
                                   <td colspan="2">

                                       <a class="btn btn-outline-info btn-sm"
                                          href="{{url('Download_attachment')}}/{{ $attachment->attachmentable->FName.'_'.$attachment->attachmentable->LName }}/{{$attachment->filename}}"
                                          role="button"><i class="fa fa-download"></i>&nbsp; {{trans('employees-trans.Download')}}</a>

                                    @can(Permission::select("name->".\App::getLocale())->where('name->ar','العمليات_على_الموظف')->first())

                                       <button type="button" class="btn btn-outline-danger btn-sm"
                                               data-toggle="modal"
                                               data-target="#Delete_file{{ $attachment->id }}"
                                               title="{{ trans('employees-trans.Delete') }}">{{ trans('employees-trans.Delete') }}
                                       </button>
                                    @endcan

                                       <a href="{{url('showAttachment')}}/{{ $attachment->attachmentable->FName.'_'.$attachment->attachmentable->LName }}/{{$attachment->filename}}/{{$attachment->attachmentable->id}}" class="btn btn-outline-warning btn-sm " role="button" ><i class="fa fa-eye"></i></a>


                                   </td>
                               </tr>
                                @include('pages.Employees.Delete_file')
                           @endforeach
                           </tbody>
                       </table>
                   </div>
               </div>


               <div class="tab-pane fade" id="advance-02" role="tabpanel"
               aria-labelledby="advance-02-tab">
              <div class="card card-statistics">

    @can(Permission::select("name->".\App::getLocale())->where('name->ar','دفع_سلفة')->first())

         <a class="btn btn-light" href="{{route('Show_Pay_Advance',$Employee->id)}}"><i style="color: #0000cc" class="fa fa-money"></i>&nbsp; &nbsp;  {{trans('salaries-trans.Pay_Advance')}}&nbsp;</a>

    @endcan
                  <br><br>
                  <table class="table table-striped table-hover"
                         style="text-align:center">
                      <thead>
                      <tr class="table-secondary">
                          <th scope="col">#</th>
                          <th scope="col">{{trans('salaries-trans.Initial_Salary')}}</th>
                          <th scope="col">{{trans('salaries-trans.Amount')}}</th>
                          <th scope="col">{{trans('salaries-trans.Remaining_Amount')}}</th>
                          <th scope="col">{{trans('employees-trans.created_at')}}</th>
                          <th scope="col">{{trans('employees-trans.updated_at')}}</th>
                          <th scope="col">{{trans('salaries-trans.Statement')}}</th>
                          <th scope="col">{{trans('employees-trans.Processes')}}</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($Employee->advancePayments()->orderby('id','desc')->get() as $advance)
                          <tr style='text-align:center;vertical-align:middle'>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$advance->Previous_Salary}}</td>
                              <td>{{$advance->Advance_Amount}}</td>
                              <td>{{$advance->Remaining_Amount}}</td>
                              <td>{{$advance->created_at->diffForHumans()}}</td>
                              <td>{{$advance->updated_at->diffForHumans()}}</td>
                              <td>{{$advance->Statement}}</td>
                              <td colspan="2">
                                @can(Permission::select("name->".\App::getLocale())->where('name->ar','تعديل_سلفة')->first())

                                  <a class="btn btn-outline-info btn-sm"
                                     href="{{ url('edit_employee_advance')}}/{{$advance->id}}/{{ $Employee->id }}"
                                     role="button"><i class="fa fa-edit"></i>&nbsp; {{trans('salaries-trans.Edit_Advance')}}</a>

                                @endcan

                                @can(Permission::select("name->".\App::getLocale())->where('name->ar','حذف_سلفة')->first())

                                  <button type="button" class="btn btn-outline-danger btn-sm"
                                          data-toggle="modal"
                                          data-target="#delete{{ $advance->id }}"
                                          title="{{ trans('employees-trans.Delete') }}">{{ trans('employees-trans.Delete') }}
                                  </button>

                                @endcan


                              </td>
                          </tr>


                          <div class="modal fade" id="delete{{ $advance->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                           id="exampleModalLabel">
                                           {{ trans('employees-trans.Delete') }}
                                       </h5>
                                       <button type="button" class="close" data-dismiss="modal"
                                               aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body">
                                       <form action="{{ route('advance_destroy') }}" method="POST">
                                        @csrf
                                           {{ trans('salaries-trans.Warning_Advance') }}
                                           <input id="id" type="hidden" name="id" class="form-control"
                                                  value="{{ $advance->id }}">
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
                      </tbody>
                  </table>
              </div>
          </div>



           </div>
       </div>
   </div>

</div>
</div>

<!-- row closed -->
                </div>
            </div>



    <br>
    <br>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.content-wrapper -->

@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
