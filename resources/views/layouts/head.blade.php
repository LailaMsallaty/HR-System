<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.png') }}" type="image/x-icon" />

<!-- Font -->
<link href="{{URL::asset('assets/css/main.min.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
@yield('css')
{{-- <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/materialize.css') }}"  media="screen,projection"/> --}}
<!--- Style css -->
<link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">

{{--
<link href="{{ URL::asset('assets/css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/jquery.datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" rel="stylesheet"> --}}

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <!--Import Google Icon Font-->
 <!--Import materialize.css-->

<!--- Style css -->
@if (App::getLocale() == 'en')
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
@endif

<style>

    .right-nav-text{

        font-size: 13px;

    }


</style>
