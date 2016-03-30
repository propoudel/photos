@extends('layouts.app')

@section('content')

    <section id="inner">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>
                        <span class="result-title text-upper-first">{{ $category->name }}</span>
                        <small><span>{{ $category->items->count() }}</span>&nbsp;Items</small>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12 col-md-9">
                            <nav class="navbar navbar-offset visible-md-block visible-lg-block">
                                <div class="collapse navbar-collapse">
                                    <ul class="nav navbar-nav">
                                        <li><a class="dropdown-toggle">Filter By</a> </li>
                                        <li class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false">
                                                Type <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="" class="active">All</a></li>
                                                <li><a data-filter-value="photography" href="">Photography</a></li>
                                                <li><a href=""> Illustration</a> </li>
                                            </ul>
                                        </li>

                                        <li class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle"aria-expanded="false">
                                                Orientation
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li> <a  href="" class="active"> All</a></li>
                                                <li><a href="">Horizontal</a></li>
                                                <li><a href="">Vertical </a></li>
                                            </ul>

                                        </li>





                                        <li class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false">
                                                Color <b class="caret"></b>
                                            </a>

                                        </li>

                                    </ul>

                                </div>
                            </nav>

                        </div>
                        <div class="col-xs-12 col-md-3 text-upper text-xs">


                            <div class="js_pjax-trigger js_search-sort visible-md-block visible-lg-block">
                                <ul class="list-inline text-xs text-muted mts d-inline pull-right-md">
                                    <li class="hidden-md hidden-lg text-xs text-muted"><span
                                                data-definition="as in order of results">Sort by</span>:
                                    </li>


                                    <li class="">
                                        <a href="/search/nature?saveSort=true"
                                           class="text-bright unstyled text-xs"><span
                                                    data-definition="best match as in search sort order">Best match</span></a>
                                    </li>

                                    <li class="">
                                        <span class="phs text-xs">|</span>
                                    </li>


                                    <li class="">
                                        <a href="/search/nature?sort=newest&amp;saveSort=true"
                                           class="text-muted-link prn unstyled text-xs"><span
                                                    data-definition="most recent as in search sort order">Most recent</span></a>
                                    </li>


                                </ul>
                            </div>


                        </div>
                    </div>


                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="blocks list-unstyled">
                        @foreach($items as $item)
                            <?php
                            $img = public_path() . '/uploads/thumbnail' . '/' . $item->thumbnail;
                            list($width, $height) = getimagesize($img);
                            ?>
                            <li style="width: {{ $width }}px; height: {{ $height }}px;">
                                <a href="{{ URL::route('show.item') }}/{{ $item->id }}">
                                    <img src="{{ asset('uploads/thumbnail').'/'.$item->thumbnail }}">
                                </a>

                                <p>Caption</p>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </section>


@endsection