@extends('layouts.control')

@section('content')

    <form class="form-horizontal" method="post" action="{{ URL::action('Control\ItemController@store') }}"
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
                    <input type="text" class="form-control" id="name" name="name" placeholder="">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="editor" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>Thumbnail</label>
                    <input type="file" id="thumbnail" name="thumbnail">
                </div>

                <div class="form-group-sm">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Publish</option>
                                <option value="0">Save</option>
                            </select>
                        </div>
                    </div>
                </div>


            </div>
            <div role="price" class="tab-pane" id="price">
                <div class="row input_fields_wrap">

                    <div class="col-lg-3">
                        <input type="file" name="file[]">
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <select class="form-control input-select" name="size[]">
                                <option value="">Size</option>
                                @foreach($size as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="text" class="form-control" id="price" name="price[]" placeholder="Price">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <a href="#" id="addMoreField" class="btn btn-primary  add_field_button">Add More</a>
                        </div>
                    </div>
                </div>


                <script>
                    $(document).ready(function() {
                        var max_fields      = 10; //maximum input boxes allowed
                        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
                        var add_button      = $(".add_field_button"); //Add button ID

                        var x = 1; //initlal text box count
                        $(add_button).click(function(e){ //on add input button click
                            e.preventDefault();
                            if(x < max_fields){ //max input box allowed
                                x++; //text box increment
                                $(wrapper).append('<div class="" id="moreFieldRow">' +
                                        '<div class="col-lg-3"><input type="file" name="file[]"></div>' +
                                        '<div class="col-lg-3"><div class="form-group">' +
                                        '<select class="form-control input-select" name="size[]">' +
                                        '<option value="">Size</option> @foreach($size as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option> @endforeach
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

                        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
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
                        @foreach($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control input-select" name="color">
                        <option value="">Color</option>
                        @foreach($colors as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control input-select" name="file_type">
                        <option value="">File Type</option>
                        @foreach($filetypes as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control input-select" name="media_type">
                        <option value="">Media Type</option>
                        @foreach($mediatypes as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control input-select" name="orientation">
                        <option value="">Orientation</option>
                        @foreach($orientations as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control input-select" name="publisher">
                        <option value="">Publisher</option>
                        @foreach($publishers as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div role="seo" class="tab-pane" id="seo">
                <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" class="form-control" id="metaTitle" name="metaTitle" placeholder="">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <textarea class="form-control" id="metaDescription" name="metaDescription"></textarea>
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