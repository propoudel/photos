@extends('layouts.app')

@section('content')
    <section id="cart" class="inner-page">
        <div class="container">

            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 text-right pull-right">
                    <a href="{{ URL::route('basket.delivery') }}"
                       class="btn btn-lg  btn-primary btn-checkout btn-block text-uppercase border-radius-none">Checkout</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="ui-light">
                        fsdfsdf
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="ui-light">
                        <table class="table table-bordered cart-table" width="100%">
                            <thead>
                            <tr>
                                <th width="56%">Description</th>
                                <th width="21%">Size</th>
                                <th width="11%">Price</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($cart as $row)

                                <tr>
                                    <td data-title="Product Description">
                                        <table width="100%" class="table">
                                            <tbody>
                                            <tr>
                                                <td width="120" class="text-center" style="border-top: 0;">
                                                    <div class="thumbnail hidden-xs">
                                                        <img src="{{ asset('uploads/thumbnail').'/'.$row->options->thumbnail }}"
                                                             alt="{{ $row->name }}" width="100">
                                                    </div>

                                                </td>
                                                <td class="text-left" style="border-top: 0;">
                                                    {{ $row->name }}
                                                    <p>
                                                        <a href="{{ URL::route('basket.remove').'/'.$row->rowid }}"
                                                           rel="nofollow" class="text-orange">Remove
                                                            item</a>
                                                    </p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>


                                    <td data-title="size">

                                        <p>

                                            <label>
                                                <strong>${{ $row->price }}</strong>
                                            </label>
                                             <span class="text-small">
                                                &nbsp;&nbsp;
                                                 {{ $row->options->size }}
                                                 <span>px</span>
                                            </span>
                                        </p>


                                    </td>


                                    <td data-title="Total">
                                        <span>AED {{ number_format($row->subtotal, 2)  }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="text-left small-only-text-center">

                                </td>

                                <td colspan="3">
                                    <table align="right" class="totals table">
                                        <tbody>

                                        <tr>
                                            <th>Total</th>
                                            <td width="40%">
                                            <span class="notranslate">
                                                 $ {{ number_format(Cart::total(), 2) }}
                                            </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </section>

@endsection