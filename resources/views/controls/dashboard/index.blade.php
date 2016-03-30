@extends('layouts.control')

@section('content')

    <div class="graphs">
        <div class="col_3">

            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="fa fa-users"></i>
                    <div class="stats">
                        <h5>500<span>/Week</span></h5>
                        <div class="grow grow1">
                            <p>Customers</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="fa fa-usd"></i>
                    <div class="stats">
                        <h5>15000 <span>AED/Week</span></h5>
                        <div class="grow">
                            <p>sales</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="fa fa-eye"></i>
                    <div class="stats">
                        <h5>12000 <span>/Week</span></h5>
                        <div class="grow grow3">
                            <p>Visitors</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget">
                <div class="r3_counter_box">
                    <i class="fa fa-bar-chart-o"></i>
                    <div class="stats">
                        <h5>70 <span>%</span></h5>
                        <div class="grow grow2">
                            <p>Profit</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>


@endsection