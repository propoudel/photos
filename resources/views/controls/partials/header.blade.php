<div class="header-section">

    <!--toggle button start-->
    <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
    <!--toggle button end-->

    <!--notification menu start -->
    <div class="menu-right">
        <div class="user-panel-top">

            <div class="profile_details">
                <ul>
                    <li class="dropdown profile_details_drop">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <div class="profile_img">
                                <div class="user-name">
                                    <p>{{ Auth::user()->email }}<span>Administrator</span></p>
                                </div>
                                <i class="lnr lnr-chevron-down"></i>
                                <i class="lnr lnr-chevron-up"></i>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu drp-mnu">
                            <li><a href="{{ URL::action('Control\AdminController@account', Auth::user()->id) }}"><i class="fa fa-user"></i>Profile</a></li>
                            <li><a href="{{ URL::route('admin.logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                    <div class="clearfix"></div>
                </ul>
            </div>
        </div>
    </div>
    <!--notification menu end -->
</div>