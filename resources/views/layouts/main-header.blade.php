<!--=================================
header start-->
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- logo -->
    <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}"><img src="{{ URL::asset('assets/images/photo_2021-07-29_01-09-05.jpg') }}"  alt=""></a>

    </div>
    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item ">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
        </li>
        <li class="nav-item">
            <div class="search">
                <a class="search-btn not_click" href="javascript:void(0);"></a>
                <div class="search-box not-click">
                    <input type="text" class="not-click form-control" placeholder="Search" value=""
                        name="search">
                    <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                </div>
            </div>
        </li>
    </ul>
    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">
        <div class="btn-group mb-1">
            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
             @if (App::getLocale() == 'ar')
             {{trans('main-trans.Language')}}
               <img src="{{ URL::asset('assets/images/flags/sysyriaflag_111908.png') }}" alt="">
             @else
             {{trans('main-trans.Language')}}
                <img src="{{ URL::asset('assets/images/flags/usunitedstatesflag_111929.png') }}" alt="">
             @endif
             </button>
            <div class="dropdown-menu">
               @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                       <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                           {{ $properties['native'] }}
                       </a>
               @endforeach
            </div>
        </div>


        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="ti-bell"></i>
                <span class="badge badge-danger notification-status"> </span>
            </a>
            <div style="overflow-y: scroll; height:300px" class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                <div class="menu-header-content  alert-secondary text-right pt-3 " >
                    <div class="d-flex">
                        <h6 class="dropdown-title mb-1 tx-15 text-black font-weight-semibold m-auto ">{{ trans('notifications-trans.Notifications') }}</h6>
                        <span class="badge badge-pill badge-warning mr-auto my-auto float-left m-auto "><a
                                href="{{ route('MarkAsRead_all') }}">{{ trans('notifications-trans.All_Read') }}</a></span>
                    </div>
                    <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">
                    <h6 class="ml-5 mr-5" style="color: black" id="notifications_count">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </h6>
                    </p>
                </div>
                <div id="unreadNotifications">
                    @foreach (auth()->user()->unreadNotifications as $notification)
                        <div onMouseOver="this.style.backgroundColor='#d7dadd'"  onMouseOut="this.style.backgroundColor='#FFF'"  class="main-notification-list Notification-scroll">
                            <a class="d-flex p-3 "
                                href="{{ route('messages.show',$notification->data['id'])}}">
                                <div class="notifyimg bg-pink">
                                    <i class="la la-file-alt text-white"></i>
                                </div>
                                <div class="mr-3">
                                    <h5 class="notification-label mb-1">{{ trans('notifications-trans.'.$notification->data['title']) }}
                                       <span style='color: #008080; font-size:15px'>{{ $notification->data['user'] }}</span>
                                    </h5>
                                    <div class="notification-subtext">{{ $notification->created_at }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>


        </li>
        {{-- <li class="nav-item dropdown ">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big">
                <div class="dropdown-header">
                    <strong>Quick Links</strong>
                </div>
                <div class="dropdown-divider"></div>
                <div class="nav-grid">
                    <a href="#" class="nav-grid-item"><i class="ti-files text-primary"></i>
                        <h5>New Task</h5>
                    </a>
                    <a href="#" class="nav-grid-item"><i class="ti-check-box text-success"></i>
                        <h5>Assign Task</h5>
                    </a>
                </div>
                <div class="nav-grid">
                    <a href="#" class="nav-grid-item"><i class="ti-pencil-alt text-warning"></i>
                        <h5>Add Orders</h5>
                    </a>
                    <a href="#" class="nav-grid-item"><i class="ti-truck text-danger "></i>
                        <h5>New Orders</h5>
                    </a>
                </div>
            </div>
        </li> --}}
        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">

                <?php
                $employee = Auth::user()->employee;

                 ?>
                @if ($employee)
                <img src='{{ URL::asset('attachments/employees/'.$employee->FName.'_'.$employee->LName.'/'.$employee->ImageName) }}' /> --}}
                @else
                <img src='{{ URL::asset('assets/images/385-3856300_no-avatar-png.png') }}' height="80" width="80"  id ="imagepreview" alt="Image Preview" />
                @endif


            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                   {{-- <a class="dropdown-item" href="#"><i class="text-info ti-settings"></i>Settings</a> --}}
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="text-danger ti-unlock"></i>{{ trans('main-trans.Log_Out')}}</a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
