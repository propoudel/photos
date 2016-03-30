@extends('layouts.app')

@section('content')

    <section id="inner" class="item-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>
                        <span class="result-title text-upper-first">{{ $item->name }}</span>
                    </h1>
                </div>
            </div>
            <div itemtype="http://schema.org/ImageObject" itemscope="" class="row">
                <div class="col-lg-8">
                    <div class="ui-light item-wrapper">
                        <div class="images text-center">
                            <img itemprop="contentUrl" alt="{{ $item->name }}"
                                 src="{{ asset('uploads/thumbnail').'/'.$item->thumbnail }}" class="landscape">
                        </div>
                    </div>

                </div>


                <div class="col-lg-4">
                    <div class="ui-light item-sidebar">
                        <h3>
                                <span itemprop="name" data-expand-description="false"
                                      data-description="{!! $item->description !!}">
                                    {!! $item->description !!}
                                </span>
                        </h3>

                        <div class="asset-add-to-cart">
                            <form method="post" action="{{ URL::action('Front\BasketController@add') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @if($item->price->count() > 0)
                                    @foreach($item->price as $price)

                                        <p>
                                            <input type="radio" class="price" value="{{ $price->id }}" name="price">
                                            <label>
                                                <strong>${{ $price->price }}</strong>
                                            </label>
                                             <span class="text-small">
                                                &nbsp;&nbsp;
                                                 {{ $price->size->name }}
                                                 <span data-definition="{{ $price->size->name }}">px</span>
                                            </span>
                                        </p>
                                    @endforeach

                                    {!!  $errors->price->first('price', '<span class="error alert alert-danger" style="padding:0 0 0 0">:message</span>') !!}


                                @endif

                                <input type="hidden" value="{{ $item->id }}" name="item">

                                <button class="btn btn-primary btn-large btn-block" type="submit">
                                    <span class="fa fa-shopping-cart"></span> Add to Cart
                                </button>

                                <button class="btn btn-success btn-large btn-block" type="submit">
                                    <span class="fa fa-download"></span> Free Download
                                </button>


                            </form>


                            <div class="mtl text-center">
                                <a class="btn btn-link text-bright text-small" href="#">
                                    <i class="fa fa-star"></i><span> Save</span>
                                </a>
                                <a class="btn btn-link text-bright text-small" href="#">
                                    <i class="fa fa-share"></i>Share
                                </a>
                            </div>


                        </div>

                        <div class="asset-keywords">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <p>
                                <a class="btn btn-success btn-large btn-block" href="#">
                                    <i class="fa fa-share"></i>Send Customized Order
                                </a>
                            </p>
                        </div>
                    </div>


                </div>
            </div>


        </div>
    </section>


@endsection