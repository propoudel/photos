<div class="left-side-inner">

    <!--sidebar nav start-->
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="@if(Route::current()->getName() == "admin.dashboard")act @endif">
            <a href="{{ URL::route('admin.dashboard') }}"><i class="lnr lnr-power-switch"></i><span>Dashboard</span></a></li>
        <li class="menu-list @if(Route::current()->getName() == "admin.item" or Route::current()->getName() == "admin.category")act @endif">
            <a href="#">
                <i class="fa fa-picture-o"></i>
                <span>Manage Items</span></a>
            <ul class="sub-menu-list">
                <li><a href="{{ URL::route('admin.item') }}">Item</a></li>
                <li><a href="{{ URL::route('admin.category') }}">Category</a></li>
            </ul>
        </li>
        <li  class="@if(Route::current()->getName() == "admin.banner")act @endif"><a href="{{ URL::route('admin.banner') }}"><i class="fa fa-file-image-o"></i> <span>Banners</span></a></li>
        <li><a href="#"><i class="fa fa-users"></i> <span>Customers</span></a></li>
        <li><a href="#"><i class="fa fa-comments"></i> <span>Comments</span></a></li>
        <li class="menu-list"><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a>
            <ul class="sub-menu-list">
                <li><a href="#">Inbox</a></li>
                <li><a href="#">Compose Mail</a></li>
            </ul>
        </li>
        <li><a href="#"><i class="lnr lnr-select"></i> <span>Media</span></a></li>
        <li class="menu-list"><a href="#"><i class="lnr lnr-book"></i> <span>Blog</span></a> </li>
    </ul>
    <!--sidebar nav end-->
</div>