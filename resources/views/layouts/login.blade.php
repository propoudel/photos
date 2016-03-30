<!DOCTYPE HTML>
<html>
<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/control/css/bootstrap.min.css') }}" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="{{ asset('assets/control/css/style.css') }}" rel='stylesheet' type='text/css'/>
    <!-- Graph CSS -->
    <link href="{{ asset('assets/control/css/font-awesome.css') }}" rel="stylesheet">
    <!-- jQuery -->
    <!-- lined-icons -->
    <link rel="stylesheet" href="{{ asset('assets/control/css/icon-font.min.css') }}" type='text/css'/>
    <!-- //lined-icons -->
    <!-- chart -->
    <script src="{{ asset('assets/control/js/Chart.js') }}"></script>
    <!-- //chart -->
    <!--animate-->
    <link href="{{ asset('assets/control/css/animate.css') }}" rel="stylesheet" type="text/css" media="all">

    <!----webfonts--->
    <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic'
          rel='stylesheet' type='text/css'>
    <!---//webfonts--->
    <!-- Meters graphs -->
    <script src="{{ asset('assets/control/js/jquery-1.10.2.min.js') }}"></script>
    <!-- Placed js at the end of the document so the pages load faster -->

</head>

<body class="sign-in-up">
<section>
    <div id="page-wrapper" class="sign-in-wrapper">
        <div class="graphs">
            <div class="sign-in-form">

                <div class="signin">
                    @if(Session::has('message'))

                        <div id="message">
                            <div class="alert alert-danger fade in">
                                <strong>{!! session('message') !!}</strong>
                            </div>
                        </div>
                    @endif

                    <form role="form" method="post" action="{{ URL::action('Control\AdminController@postLogin') }}"
                          role="form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="log-input">
                            <div class="log-input-left">
                                {!!  $errors->login->first('email', '<span class="error" style="padding:0 0 0 0">:message</span>') !!}
                                <input type="text" name="email" value="{{ old('email') }}" class="user" placeholder="Email address:"/>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="log-input">
                            <div class="log-input-left">
                                {!!  $errors->login->first('password', '<span class="error" style="padding:0 0 0 0">:message</span>') !!}
                                <input type="password" name="password" value="{{ old('password') }}" class="lock" placeholder="password"/>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <input type="submit" value="Login to your account">
                    </form>
                </div>

            </div>
        </div>
    </div>

</section>

<script src="{{ asset('assets/control/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/control/js/scripts.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/control/js/bootstrap.min.js') }}"></script>
</body>
</html>