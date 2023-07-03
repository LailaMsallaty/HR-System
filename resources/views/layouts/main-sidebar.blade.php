<?php
 use App\Employee;
 use App\Http\Controllers\ReportController;
use Spatie\Permission\Models\Permission;



 ?>
<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed ">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main-trans.Dashboard')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ url('/dashboard') }}">{{trans('main-trans.Dashboard')}}</a> </li>

                        </ul>
                    </li>

                    <?php
                         $employee = Auth::user()->employee;

                    ?>
                             <!-- menu item Profile-->
                             @if($employee)
                             <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#profile">
                                    <div class="pull-left"><i class="fa fa-address-book"></i><span class="right-nav-text">{{trans('main-trans.Profile')}}</span>
                                    </div>
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>


                                 <ul id="profile" class="collapse" data-parent="#sidebarnav">

                                    <li> <a href="{{route('employee.show',$employee->id)}}">{{trans('main-trans.My_Profile')}}</a> </li>

                                 </ul>


                            </li>
                            @can(Permission::select("name->".\App::getLocale())->where('name->ar','صلاحية_عرض_تقويم_الدوام')->first())

                                                         <!-- menu item my attendance -->
                                                         <li>
                                                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#myattendance">
                                                                <div class="pull-left"><i class="fa fa-calendar"></i><span class="right-nav-text">{{trans('main-trans.Attendance_Calendar')}}</span>
                                                                </div>
                                                                <div class="pull-right"><i class="ti-plus"></i></div>
                                                                <div class="clearfix"></div>
                                                            </a>

                                                            <ul id="myattendance" class="collapse" data-parent="#sidebarnav">

                                                                <li> <a href="{{route('MY_Attendance')}}">{{trans('main-trans.MY_Attendance')}}</a> </li>

                                                            </ul>
                                                        </li>

                                                        @endcan

                                                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','صلاحية_عرض_تقويم_المهام')->first())

                                                         <!-- menu item my attendance -->

                                                         <li>
                                                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#mytasks">
                                                                <div class="pull-left"><i class="fa fa-calendar"></i><span class="right-nav-text">{{trans('main-trans.Tasks_Calendar')}}</span>
                                                                </div>
                                                                <div class="pull-right"><i class="ti-plus"></i></div>
                                                                <div class="clearfix"></div>
                                                            </a>

                                                            <ul id="mytasks" class="collapse" data-parent="#sidebarnav">

                                                                <li> <a href="{{route('MY_Tasks')}}">{{trans('main-trans.My_Tasks')}}</a> </li>

                                                            </ul>
                                                        </li>

                                                        @endcan
                                                        @endif

                                                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','صلاحية_عرض_تقويم_المناسبات')->first())

                                                        <!-- menu item event -->
                                                        <li>
                                                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#event">
                                                                <div class="pull-left"><i class="fa fa-calendar"></i><span class="right-nav-text">{{trans('main-trans.Events')}}</span>
                                                                </div>
                                                                <div class="pull-right"><i class="ti-plus"></i></div>
                                                                <div class="clearfix"></div>
                                                            </a>

                                                            <ul id="event" class="collapse" data-parent="#sidebarnav">

                                                                <li> <a href="{{ route('Events') }}">{{trans('main-trans.Calendar')}}</a> </li>

                                                            </ul>
                                                        </li>
                                                        @endcan
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main-trans.Components')}} </li>

                    @can(Permission::select("name->".\App::getLocale())->where('name->ar','إدارة_عامة')->first())

                     <!-- menu item system management-->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#system-menu">
                            <div class="pull-left"><i class="fa fa-wrench" aria-hidden="true"></i>
                                <span
                                    class="right-nav-text">{{trans('system-trans.title_page')}}</span></div>
                            <div class="pull-right "><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="system-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('country.index')}}">{{trans('system-trans.Countries_list')}}</a> </li>
                            <li> <a href="{{route('city.index')}}">{{trans('system-trans.Cities_list')}}</a> </li>
                            <li> <a href="{{route('department.index')}}">{{trans('departments-trans.Departments_list')}}</a></li>
                            <li> <a href="{{route('event.index')}}">{{trans('events-trans.Events_list')}}</a></li>
                            <li><a href="{{route('employeeleave.index')}}">{{trans('leaves-trans.List_Of_Leaves')}}</a></li>
                            <li><a href="{{route('employeeaward.index')}}">{{trans('awards-trans.List_Of_Awards')}}</a></li>
                            <li><a href="{{route('punishment.index')}}">{{trans('employees-trans.List_Of_Punishments')}}</a></li>
                            <li> <a href="{{route('location.index')}}">{{trans('locations-trans.Locations_list')}}</a> </li>
                            <li><a href="{{route('position.index')}}">{{trans('positions-trans.Positions_list')}}</a></li>

                        </ul>

                    </li>
                    @endcan
                     <!-- menu item employees-->

                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#employees-menu">
                            <div class="pull-left"><i class="fa fa-user"></i><span
                                    class="right-nav-text">{{trans('employees-trans.title_page')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>

                      <ul id="employees-menu" class="collapse" data-parent="#sidebarnav">
                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','إدارة_الموظفين')->first())

                         <li>

                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Employees_Management">
                                <div class="pull-left"><span
                                    class="right-nav-text">{{trans('employees-trans.Employees_Management')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div></a>
                            <ul id="Employees_Management" class="collapse" >
                                <li><a href="{{route('employee.index')}}">{{trans('employees-trans.Employees_list')}}</a> </li>
                                <li><a href="{{route('employee.create')}}" >{{ trans('employees-trans.add_Employee') }}</a></li>
                            </ul>
                         </li>
                         @endcan

                         @can(Permission::select("name->".\App::getLocale())->where('name->ar','طلبات_الاستقالة')->first())

                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Resign employees">
                                <div class="pull-left"><span
                                    class="right-nav-text">{{trans('employees-trans.Resign_Requests')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div></a>
                            <ul id="Resign employees" class="collapse" >

                                @can(Permission::select("name->".\App::getLocale())->where('name->ar','إضافة_استقالة')->first())

                                <li> <a href="{{route('resigned.create')}}">{{trans('employees-trans.accept_Resign')}}</a> </li>

                                @endcan

                                @can(Permission::select("name->".\App::getLocale())->where('name->ar','عرض_الموظفين_المستقيلين')->first())

                                <li> <a href="{{route('resigned.index')}}">{{trans('employees-trans.list_Resign')}}</a> </li>

                                @endcan
                            </ul>
                        </li>
                        @endcan

                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','العقوبات')->first())

                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#punishments">
                                <div class="pull-left"><span
                                    class="right-nav-text">{{trans('employees-trans.Punishments')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div></a>
                            <ul id="punishments" class="collapse" >
                                @can(Permission::select("name->".\App::getLocale())->where('name->ar','فرض_عقوبة')->first())

                                <li> <a href="{{route('Employee_punishment.create')}}">{{trans('employees-trans.Impose_Punishment')}}</a> </li>

                                @endcan
                                @can(Permission::select("name->".\App::getLocale())->where('name->ar','الموظفين_المعاقبين')->first())

                                <li> <a href="{{route('Employee_punishment.index')}}">{{trans('employees-trans.list_Punishments')}}</a> </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
                        </ul>
                    </li>
               <!-- menu Salary-->
               @can(Permission::select("name->".\App::getLocale())->where('name->ar','الرواتب')->first())

               <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#salary">
                    <div class="pull-left"><i class="ti-money"></i><span class="right-nav-text">{{trans('salaries-trans.title_page')}}</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="salary" class="collapse" data-parent="#sidebarnav">

                    @can(Permission::select("name->".\App::getLocale())->where('name->ar','قائمة_الرواتب')->first())

                    <li><a href="{{route('employeesalary.index')}}">{{trans('salaries-trans.Salary_list')}}</a> </li>

                    @endcan

                    @can(Permission::select("name->".\App::getLocale())->where('name->ar','دفع_راتب')->first())

                    <li><a href="{{route('employeesalary.create')}}" >{{trans('salaries-trans.Pay_Salary')}}</a> </li>

                    @endcan
                </ul>
            </li>
            @endcan
               <!-- menu Attendance-->
            @can(Permission::select("name->".\App::getLocale())->where('name->ar','تسجيل_الدوام')->first())

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendance">
                    <div class="pull-left"><i class="fa fa-calendar"></i></i><span
                            class="right-nav-text">{{trans('attendance-trans.title_page')}}</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="attendance" class="collapse" data-parent="#sidebarnav">
                    <li><a href="{{route('employeeattendance.index')}}">{{trans('attendance-trans.Recording_Attendance')}}</a></li>

                </ul>
            </li>
            @endcan
                <!-- menu Leave-->
                @can(Permission::select("name->".\App::getLocale())->where('name->ar','الإجازات')->first())

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#leave">
                        <div class="pull-left"><i class="fa fa-sign-out"></i></i><span
                                class="right-nav-text">{{trans('leaves-trans.title_page')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="leave" class="collapse" data-parent="#sidebarnav">

                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','عرض_طلبات_الإجازة')->first())

                        <li><a href="{{route('Employee_Leave_Requests')}}">{{trans('leaves-trans.Employee_Leave_Requests')}}</a></li>

                        @endcan

                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','تقديم_طلب_إجازة')->first())

                        @if ($employee)
                        <li><a href="{{route('Leave_Request.index')}}">{{trans('leaves-trans.Leave_Request')}}</a></li>

                        @endif

                        @endcan

                    </ul>
                </li>
                @endcan
                 <!-- menu Award-->
                 @can(Permission::select("name->".\App::getLocale())->where('name->ar','الجوائز')->first())

                 <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#award">
                        <div class="pull-left"><i class="fa fa-trophy"></i></i><span
                                class="right-nav-text">{{trans('awards-trans.title_page')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="award" class="collapse" data-parent="#sidebarnav">
                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','جوائز_الموظف')->first())
                        @if ($employee)
                        <li><a href="{{route('Employee_Awards')}}">{{trans('awards-trans.Employee_Awards')}}</a></li>
                        @endif
                        @endcan

                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','إضافة_جائزة')->first())

                        <li><a href="{{route('Give_Award.index')}}">{{trans('awards-trans.Give_Award')}}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can(Permission::select("name->".\App::getLocale())->where('name->ar','الطلبات')->first())

                   <!-- menu Requests-->
                   <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#request">
                        <div class="pull-left"><i class="fa fa-send"></i></i><span
                                class="right-nav-text">{{trans('requests-trans.title_page')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="request" class="collapse" data-parent="#sidebarnav">
                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','عرض_طلبات_الموظفين')->first())

                        <li><a href="{{route('Employee_Requests')}}">{{trans('requests-trans.Employees_Requests')}}</a></li>

                        @endcan

                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','ارسال_طلبات')->first())

                        @if ($employee)
                        <li><a href="{{route('Send_Request.index')}}">{{trans('requests-trans.Employee_Requests')}}</a></li>
                        @endif
                        @endcan
                    </ul>
                </li>
                @endcan

                @can(Permission::select("name->".\App::getLocale())->where('name->ar','المهام')->first())

                   <!-- menu tasks-->
                   <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#task">
                        <div class="pull-left"><i class="fa fa-tasks"></i></i><span
                                class="right-nav-text">{{trans('tasks-trans.title_page')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="task" class="collapse" data-parent="#sidebarnav">
                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','عرض_مهام_الموظفين')->first())

                        <li><a href="{{route('Send_Task.index')}}">{{trans('tasks-trans.Employees_Tasks')}}</a></li>

                        @endcan
                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','مهام_الموظف')->first())

                        @if ($employee)
                        <li><a href="{{route('Receive_Task.index')}}">{{trans('tasks-trans.Employee_Tasks')}}</a></li>
                        @endif
                        @endcan
                    </ul>
                </li>
                @endcan
                 <!-- menu Reports-->
                 @can(Permission::select("name->".\App::getLocale())->where('name->ar','التقارير')->first())

                 <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#report">
                        <div class="pull-left"><i class="fa fa-file"></i></i><span
                                class="right-nav-text">{{trans('reports-trans.title_page')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="report" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{ route('Company_Report') }}">{{trans('reports-trans.Company')}}</a></li>
                        <li><a href="{{ route('Employees') }}">{{trans('reports-trans.Employees')}}</a></li>
                        <li><a href="{{route('View_Attendances')}}">{{trans('attendance-trans.View_Attendances')}}</a></li>
                        <li> <a href="{{route('View_Advances')}}" >{{trans('salaries-trans.Advance_Payments')}}</a> </li>
                        <li> <a href="{{ route('Payments') }}">{{trans('reports-trans.Payments')}}</a></li>
                        <li> <a href="{{ route('Leaves') }}">{{trans('reports-trans.Leaves')}}</a></li>
                        <li> <a href="{{ route('Awards_Punishments') }}">{{trans('reports-trans.Awards_Punishments')}}</a></li>
                    </ul>
                </li>
                @endcan

                @can(Permission::select("name->".\App::getLocale())->where('name->ar','المستخدمين')->first())

                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('system-trans.Settings')}}</li>

                    <!-- menu users-->

                   <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#user">
                        <div class="pull-left"><i class="fa fa-users"></i></i><span
                                class="right-nav-text">{{trans('system-trans.Users')}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="user" class="collapse" data-parent="#sidebarnav">

                        <li><a href="{{route('users.index')}}">{{trans('system-trans.Users_List')}}</a></li>

                        @can(Permission::select("name->".\App::getLocale())->where('name->ar','الأدوار')->first())

                        <li><a href="{{route('roles.index')}}">{{trans('system-trans.User_Roles')}}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <br>
                <br>
                <br>
                <br>
                </ul>

            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
