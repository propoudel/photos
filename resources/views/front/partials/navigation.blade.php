<nav class="navbar navbar-default navbar-fixed-top top-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6">
                <div class="navbar-header">
                    <a class="logo" href="{{ URL::to('/') }}">
                        <img src="{{ asset('assets/front/images/logo.png') }}" alt="Photoslia">
                    </a>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-3 col-xs-2 text-right">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse-header" aria-expanded="true">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-collapse-header">
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::guard('customers')->check())
                            <li>
                                <a href="{{ URL::route('customer.logout') }}">Logout</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ URL::route('customer.register') }}">New Account</a>
                            </li>
                            <li>
                                <a href="{{ URL::route('customer.login') }}">Login</a>
                            </li>
                        @endif

                    </ul>
                </div>


            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right pull-right">
                <a href="{{ URL::route('basket.basket') }}" class="cart-icon">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="badge">{{ Cart::count() }}</span> <span class="hidden-xs">Item(s)</span>
                </a>
            </div>
        </div>
    </div>
</nav>

