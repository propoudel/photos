@extends('layouts.control')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-6">
                            Information
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                    </ul>

                    <form method="post" action="{{ URL::action('Control\AdminController@accountUpdate', $user->id) }}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="tab-content">

                            <div class="tab-pane fade in active" id="general">
                                <h4></h4>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ $user->email }}"  placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="">
                                </div>



                            </div>

                            <hr>
                            <button type="submit" class="btn text-uppercase btn-primary">Update</button>

                        </div>
                    </form>

                </div>


                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

@endsection