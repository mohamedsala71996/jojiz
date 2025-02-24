@extends('frontend.layouts.master')

@section('frontend_content')
    <!--====== Section 1 ======-->

    <div class="u-s-p-y-0">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">
                                <a href="{{ route('index') }}">@lang('frontend.Home')</a>
                            </li>
                            <li class="is-marked">
                                <a href="javascript:void(0)">@lang('frontend.Signin')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->

    <!--====== Section 2 ======-->

    <div class="u-s-p-b-10">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row row--center">
                    <div class="col-lg-6 col-md-8 u-s-m-b-30">

                        <div class="login-part">
                            <div class=" login-text1">
                                <h1>@lang('backend.Welcome Back')</h1>
                                <p class="gl-text u-s-m-b-30">@lang('frontend.Sign in to access your account and manage your orders')</p>
                                <a class="google-btn" href="{{ route('user.login.provider', ['provider' => 'google']) }}">
                                    <div class="google-text ">
                                        <img src="{{ asset('public/frontend/images/google.png') }}" alt="Google">
                                        <span>@lang('frontend.Signin with Google')</span>
                                    </div>
                                </a>
                                <a class="google-btn" href="{{ route('user.login.provider', ['provider' => 'facebook']) }}">
                                    <div class="google-text ">
                                        <img src="{{ asset('public/frontend/images/facebook.png') }}" alt="Facebook">
                                        <span>@lang('frontend.Signin with Facebook')</span>
                                    </div>
                                </a>
                                <div class="divider"> @lang('backend.OR CONTINUE WITH')</div>
                            </div>
                            <div class="input-box">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="login-input-part">
                                        <label class="login-text" for="login-email">@lang('backend.Email')</label>

                                        <input class="login-input" type="text" name="email" id="login-email"
                                            placeholder="@lang('backend.Enter Email')" />
                                        @error('password')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="login-input-part">
                                        <label class="login-text" for="login-password">@lang('backend.Password')</label>

                                        <input class="login-input" name="password" type="text" id="login-password"
                                            placeholder="@lang('frontend.Enter Password')" />
                                        @error('password')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="log-btn-main">
                                        <button class="log-btn" type="submit">
                                            @lang('backend.Sign In')
                                        </button>

                                    </div>
                                    <div class="create-main">
                                        <div class="create-part">
                                            <a class="create-btn" href="{{ route('register') }}">@lang('backend.Create an account')</a>
                                        </div>
                                        <div class="forgot-part">
                                            <a class="forgot-btn"
                                                href="{{ route('user.forget.password') }}">@lang('frontend.Forget Password')
                                                ?</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 2 ======-->
@endsection
