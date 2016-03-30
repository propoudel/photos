@extends('layouts.app')

@section('content')

    <section id="inner">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>
                        <span class="result-title text-upper-first">Search Results For:</span>
                        <small><span>{{ $_GET['q'] }}</span></small>
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="row">

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