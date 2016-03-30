@extends('layouts.control')

@section('content')

    <form class="form-horizontal" method="post"
          action="{{ URL::action('Control\ItemController@update', $product->id) }}"
          enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a>
            </li>
            <li role="presentation">
                <a href="#price" aria-controls="price" role="tab" data-toggle="tab">Price</a>
            </li>
            <li role="presentation">
                <a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">Attributes</a>
            </li>

            <li role="presentation">
                <a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">SEO</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="general" class="tab-pane active" id="general">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="editor" class="form-control">{{ $product->description }}</textarea>
                </div>

                <div class="form-group">
                    <p>
                        <img width="50" src="{{ asset('uploads/thumbnail').'/'.$product->thumbnail }}"/>
                    </p>
                    <label>Thumbnail</label>
                    <input type="file" id="thumbnail" name="thumbnail">
                </div>

                <div class="form-group-sm">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" @if($product->status == "1") selected="selected" @endif>
                                    Publish
                                </option>
                                <option value="0" @if($product->status == "0") selected="selected" @endif>
                                    Save
                                </option>
                            </select>
                        </div>
                    </div>
                </div>


            </div>
            <?php
            $prices = \App\Models\Price::all();
            ?>
            <div role="price" class="tab-pane" id="price">
                <div class="row input_fields_wrap">
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-9">
                            <p>
                                <a href="#" id="addMoreField" class="btn btn-primary  add_field_button">Add
                                    More</a>
                            </p>
                        </div>
                    </div>
                    <hr>

                    <?php $i = 1; ?>
                    @foreach($prices as $price)

                        <div class="row">
                            <div class="col-lg-3">
                                <p>
                                    <img width="50" src="{{ asset('uploads/meroitem').'/'.$price->file->name }}"/>
                                </p>

                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <select class="form-control input-select" name="size[]" readonly>
                                        @foreach($size as $s)
                                            @if($price->size_id == $s->id)
                                                <option  selected="selected" value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="price" name="price[]"
                                           value="{{ $price->price }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="checkbox" name="remove_me[{{ $price->id }}]">Remove
                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php $i++; ?>
                    @endforeach
                </div>


                <script>
                    $(document).ready(function () {
                        var max_fields = 10; //maximum input boxes allowed
                        var wrapper = $(".input_fields_wrap"); //Fields wrapper
                        var add_button = $(".add_field_button"); //Add button ID

                        var x = 1; //initlal text box count
                        $(add_button).click(function (e) { //on add input button click
                            e.preventDefault();
                            if (x < max_fields) { //max input box allowed
                                x++; //text box increment
                                $(wrapper).append('<div class="" id="moreFieldRow">' +
                                        '<div class="col-lg-3"><input type="file" name="file[]"></div>' +
                                        '<div class="col-lg-3"><div class="form-group">' +
                                        '<select class="form-control input-select" name="size[]">' +
                                        '<option value="">Size</option> @foreach($size as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option> @endforeach
                                                </select></div></div>' +
                                        '<div class="col-lg-3"><div class="form-group">' +
                                        '<input type="text" class="form-control" id="price" name="price[]" placeholder="Price">' +
                                        '</div></div>' +
                                        ' <div class="col-lg-3"><div class="form-group">' +
                                        '<a href="#" id="remove_field" class="btn btn-warning remove_field">Remove</a>' +
                                        '</div></div>' +
                                        ' </div>');
                            }
                        });

                        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                            e.preventDefault();
                            $('#moreFieldRow').remove();
                            x--;
                        })
                    });
                </script>
            </div>

            <div role="attributes" class="tab-pane" id="attributes">
                <div class="form-group">

                    <select class="form-control input-select" name="category">
                        <option value="">Category</option>
                        @if(count($categories) > 0)
                            @foreach($categories as $cat)
                                <option @if($product->category_id == $cat->id) selected="selected"
                                        @endif value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control input-select" name="color">
                        <option value="">Color</option>
                        @if(count($colors) > 0)
                            @foreach($colors as $item)
                                <option @if($product->color_id == $item->id) selected="selected"
                                        @endif value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control input-select" name="file_type">
                        <option value="">File Type</option>
                        @if(count($filetypes) > 0)
                            @foreach($filetypes as $item)
                                <option @if($product->file_type_id == $item->id) selected="selected"
                                        @endif value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control input-select" name="media_type">
                        <option value="">Media Type</option>
                        @if(count($mediatypes) > 0)
                            @foreach($mediatypes as $item)
                                <option @if($product->media_type_id == $item->id) selected="selected"
                                        @endif value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control input-select" name="orientation">
                        <option value="">Orientation</option>
                        @if(count($orientations) > 0)
                            @foreach($orientations as $item)
                                <option @if($product->orientation_id == $item->id) selected="selected"
                                        @endif value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control input-select" name="publisher">
                        <option value="">Publisher</option>
                        @if(!empty($publishers) > 0)
                            @foreach($publishers as $item)
                                <option @if($product->publisher_id == $item->id) selected="selected"
                                        @endif value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

            </div>
            <div role="seo" class="tab-pane" id="seo">
                <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" class="form-control" id="metaTitle" name="metaTitle"
                           value="{{ $product->metaTitle }}">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <textarea class="form-control" id="metaDescription"
                              name="metaDescription">{{ $product->metaDescription }}</textarea>
                </div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <p>
                        <button type="submit" name="submit" class="btn btn-primary btn-lg text-uppercase">Submit
                        </button>
                    </p>

                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        window.onload = function () {
            CKEDITOR.replace('editor');
        };
    </script>

@endsection