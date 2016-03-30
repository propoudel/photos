<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="HandheldFriendly" content="true"/>
    <meta name="MobileOptimized" content="320"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="Photoslia"/>
    <title>Photoslia</title>
    <link rel="shortcut icon" href="images/photoslia.png">
    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/front/js/jquery-1.12.1.min.js') }}" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="application-wrapper">
    @include('front.partials.navigation')

    @yield('content')


    <section id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-center">&copy; 2016  PHOTOSLIA<br></p>
                </div>
            </div>
        </div>
    </section>

</div>

<script src="{{ asset('assets/front/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/front/js/jquery.jMosaic.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/front/js/app.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function () {
        //$('.blocks').jMosaic({items_type: "li", margin: 8});
        $('.blocks').jMosaic({
            items_type: "li",
            min_row_height: 250,
            margin: 5,
            is_first_big: true
        });

        $(function () {
            $('#categoriestab').responsivetab({
                text: 'More',
            });
        })

        $(window).on('resize', function () {
            $('#categoriestab').responsivetab({
                text: 'More',
            });
        });
    });



</script>
</body>
</html>