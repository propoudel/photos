<section id="categories">
    <div class="container">
        <div class="row">
            <?php $i = 1 ?>
            @if($categories->count() > 0)
                @foreach($categories as $category)
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <div class="item category-item">
                            @if($category->thumbnail)
                                <a href="{{ URL::route('category.item') }}/{{ $category->slug }}" title="{{ $category->name }}">
                                    <img src="{{ asset('uploads/thumbnail').'/'.$category->thumbnail }}"
                                         class="img-responsive" alt="{{ $category->name }}">
                                </a>
                            @endif

                            <h3 class="cat-name">
                                <a href="{{ URL::route('category.item') }}/{{ $category->slug }}" class="text-uppercase"
                                   title="{{ $category->name }}">{{ $category->name }} </a>
                            </h3>


                        </div>
                    </div>
                    <?php $i++; ?>
                @endforeach
            @endif
        </div>
    </div>
</section>