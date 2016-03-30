<!DOCTYPE HTML>
<html>
<head>
    <title>Admin @if($title)- {{ $title }} @endif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link href="{{ asset('assets/control/css/bootstrap.min.css') }}" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="{{ asset('assets/control/css/style.css') }}" rel='stylesheet' type='text/css'/>
    <!-- Graph CSS -->
    <link href="{{ asset('assets/control/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/control/css/icon-font.min.css') }}" type='text/css'/>
    <script src="{{ asset('assets/control/js/Chart.js') }}"></script>
    <link href="{{ asset('assets/control/css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic'
          rel='stylesheet' type='text/css'>

    <script src="{{ asset('assets/control/js/jquery-1.10.2.min.js') }}"></script>


</head>

<body class="sticky-header">
<section>
    <div class="left-side sticky-left-side">
        <div class="logo">
            <h1><a href="{{ URL::route('admin.dashboard') }}">Photoslia</a></h1>
        </div>
        <div class="logo-icon text-center">
            <a href="{{ URL::route('admin.dashboard') }}"><i class="lnr lnr-home"></i> </a>
        </div>

        <!--logo and iconic logo end-->
       @include('controls.partials.sidebar')
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <div class="main-content">
        <!-- header-starts -->
        @include('controls.partials.header')
        <!-- //header-ends -->
        <div id="page-wrapper">
            @if(isset($title))
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header text-uppercase">{{ $title }}</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            @endif

            @if(isset($errors))
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endif



            @if(Session::has('message'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success"><em> {!! Session::get('message') !!}</em></div>
                    </div>
                </div>
            @endif


            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
</section>

<script src="{{ asset('assets/control/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/control/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/control/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/control/js/scripts.js') }}"></script>
</body>
</html>