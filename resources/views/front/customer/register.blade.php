@extends('layouts.app')

@section('content')
<section id="register">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Sign up now</h3>
                            <p>Fill in the form below to get instant access:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="{{ URL::action('Front\CustomerController@postRegister') }}" method="post" class="registration-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="sr-only" for="first-name">First name</label>
                                <input type="text" name="first-name" placeholder="First name..." value="{{ old('first-name') }}" class="first-name form-control" id="first-name">
                                {!!  $errors->login->first('first-name', '<span class="error alert alert-danger" style="padding:0 0 0 0">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="last-name">Last name</label>
                                <input type="text" name="last-name" placeholder="Last name..." value="{{ old('last-name') }}" class="last-name form-control" id="last-name">
                                {!!  $errors->login->first('last-name', '<span class="error alert alert-danger" style="padding:0 0 0 0">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="email">Email</label>
                                <input type="text" name="email" placeholder="Email..." value="{{ old('email') }}" class="email form-control" id="email">
                                {!!  $errors->login->first('email', '<span class="error alert alert-danger" style="padding:0 0 0 0">:message</span>') !!}
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="password">Choose Password</label>
                                <input type="password" name="password" placeholder="Password..." value="{{ old('password') }}" class="password form-control" id="password">
                                {!!  $errors->login->first('password', '<span class="error alert alert-danger" style="padding:0 0 0 0">:message</span>') !!}
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign me up!</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection