@extends('layouts.app')

@section('content')
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Login to our site</h3>
                                <p>Enter username and password to log on:</p>
                                <label>Don't have an account?<a href="{{ URL::route('customer.register') }}" title="Create New Account"> Register here</a></label>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-key"></i>
                            </div>
                            <div class="clearfix"></div>
                            @if(Session::has('message'))
                                <div id="message">
                                    <div class="alert alert-danger fade in">
                                        <strong>{!! session('message') !!}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-bottom">
                            <form role="form" action="{{ URL::action('Front\CustomerController@postLogin') }}" method="post" class="login-form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="sr-only" for="email">Email</label>
                                    <input type="text" name="email" placeholder="Email..." value="{{ old('email') }}" class="email form-control" id="email">
                                    {!!  $errors->login->first('email', '<span class="error alert alert-danger" style="padding:0 0 0 0">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-password">Password</label>
                                    <input type="password" name="password" placeholder="Password..." value="{{ old('password') }}" class="password form-control" id="password">
                                    {!!  $errors->login->first('password', '<span class="error alert alert-danger" style="padding:0 0 0 0">:message</span>') !!}
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in!</button>
                            </form>
                        </div>
                    </div>

                    <div class="social-login">
                        <h3>Or login with:</h3>
                        <div class="social-login-buttons">
                            <a class="btn btn-link-1 btn-link-1-facebook" href="{{ URL::to('facebook/authorize') }}">
                                <i class="fa fa-facebook"></i> Facebook
                            </a>

                            <a class="btn btn-link-1 btn-link-1-google-plus" href="{{ URL::to('google/authorize') }}">
                                <i class="fa fa-google-plus"></i> Google Plus
                            </a>

                            <a class="btn btn-link-1 btn-link-1-google-plus" href="{{ URL::to('github/authorize') }}">
                                <i class="fa fa-github-square"></i> Github
                            </a>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>

@endsection