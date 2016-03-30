@extends('layouts.app')

@section('content')
    <section id="dashboard" class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>
                        <div class="panel-body">
                            <div class="bs-callout bs-callout-info" id="callout-navbar-breakpoint">
                                <ul class="list-unstyled">
                                    <li class="current">
                                        <a href="#">My account</a>
                                    </li>
                                    <li>
                                        <a href="#">Purchase history</a>
                                    </li>

                                </ul>
                            </div>

                        </div>
                    </div>

                </div>



                <div class="col-xs-12 col-md-9 ui-light">
                    <div class="row">
                        <div class="col-xs-10 col-xs-offset-1">
                            <div class="pbs">
                                <h1 class="h2 mbx">
                                    My account
                                </h1>
                                <p class="text-lighter pbm">
                                    Sagar Poudel
                                </p>
                                <p class="text-lighter pbm">
                                    Email: sagar@sagar.com
                                </p>
                                <p class="text-lighter mbn">
                                    Password:
                                    ••••••••••&nbsp;

                                    <a class="text-small" href="https://accounts.offset.com/credentials/change?next=%2Foauth%2Fauthorize%3Fstate%3D08455419ce62ed8a1fdae0566acd241a%26redirect_uri%3Dhttps%253A%252F%252Fwww.offset.com%252Foauth%252Fcallback_offset%253Flanding_page%253D%25252Faccount%2526realm%253Doffset%26scope%3Duser.email%2520user.name%26hl%3Den%26client_id%3D51d3655b11f53d503357%26type%3Dweb_server">Change password</a>

                                </p>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection