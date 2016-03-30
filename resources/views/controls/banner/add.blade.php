@extends('layouts.control')

@section('content')

    <form class="form-horizontal" method="post" action="{{ URL::action('Control\BannerController@store') }}"
          enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="general" class="tab-pane active" id="general">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="editor" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>Banner Image</label>
                    <input type="file" id="image" name="image">
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

@endsection