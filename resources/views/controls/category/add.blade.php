@extends('layouts.control')

@section('content')

    <form class="form-horizontal" method="post" action="{{ URL::action('Control\CategoryController@store') }}"
          enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a>
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
                    <label>Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="default-page">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="editor" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Thumbnail Image</label>
                    <input type="file" id="thumbnail" name="thumbnail">
                </div>
                <div class="form-group">
                    <label>Banner Image</label>
                    <input type="file" id="bannerImage" name="bannerImage">
                </div>

                <div class="form-group">
                    <label>Banner Video</label>
                    <input type="text" class="form-control" id="bannerVideo" name="bannerVideo">
                </div>

                <div class="form-group">
                    <label>Position</label>
                    <input type="text" class="form-control" style="width: 100px;" value="0" id="position"
                           name="position"
                           placeholder="">
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
            <div role="seo" class="tab-pane" id="seo">
                <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" class="form-control" id="metaTitle" name="metaTitle" placeholder="">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <input type="text" class="form-control" id="metaDescription" name="metaDescription" placeholder="">
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