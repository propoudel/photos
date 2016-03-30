<header class="image-bg-fixed-height">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="slider-content">
                    <h1>Free <span><img src="{{ asset('assets/front/images/sketch.png') }}" alt=""/></span>Images</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <form action="{{ URL::action('Front\PageController@search') }}" id="search_form" method="get">
                    <div class="input-group search-input-group">
                        <input name="q" type="search" autocomplete="off" id="searchQuery"
                               class="search-query form-control" placeholder="Search high quality sketch images...">
                                <span class="input-group-btn search-btn">
                                    <button class="btn btn-darkorange" type="submit">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>
<style type="text/css">

    .image-bg-fixed-height {
        @if($banner->image)
         background: url('{{ asset('uploads/banner').'/'.$banner->image }}') no-repeat center center scroll;
        @endif
         height: 450px;
        padding: 150px 0;
    }
</style>