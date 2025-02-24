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
                                <a href="javascript:void(0)">@lang('frontend.Signup')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->

    <!--====== Section 2 ======-->

    <div class="u-s-p-b-0">
        <div class="u-s-p-b-10">
            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row row--center">
                        <div class="col-lg-6 col-md-8 u-s-m-b-30">
                            <div class="register-part">
                                <div class=" register-text1">
                                    <h1>@lang('backend.Welcome Back')</h1>
                                    <p class="gl-text u-s-m-b-30">@lang('backend.Sign up to access your account and manage your orders')</p>
                                    <a class="google-btn"
                                        href="{{ route('user.login.provider', ['provider' => 'google']) }}">
                                        <div class="google-text ">
                                            <img src="{{ asset('public/frontend/images/google.png') }}" alt="">
                                            <span>@lang('frontend.Signin with Google')</span>
                                        </div>
                                    </a>
                                    <a class="google-btn"
                                        href="{{ route('user.login.provider', ['provider' => 'facebook']) }}">
                                        <div class="google-text ">
                                            <img src="{{ asset('public/frontend/images/facebook.png') }}" alt="Facebook">
                                            <span>@lang('frontend.Signin with Facebook')</span>
                                        </div>
                                    </a>
                                    <div class="divider">@lang('backend.OR CONTINUE WITH')</div>
                                </div>
                                <div class="input-box">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="register-input-part">
                                            <label class="register-text" for="reg-lname">@lang('backend.Name')</label>

                                            <input class="register-input" name="name" type="text"
                                                value="{{ old('name') }}" id="reg-lname"
                                                placeholder="@lang('backend.Name')" />

                                            @error('name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="register-input-part">
                                            <label class="register-text" for="reg-email">@lang('backend.Email')</label>

                                            <input class="register-input" type="text" name="email"
                                                value="{{ old('email') }}" id="reg-email"
                                                placeholder="@lang('backend.Enter Email')" />
                                            @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="register-input-part">
                                            <label class="register-text" for="reg-password">@lang('backend.Password')</label>

                                            <input class="register-input" name="password" type="text" id="reg-password"
                                                placeholder="@lang('frontend.Enter Password')" />
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="register-input-part">
                                            <label class="register-text" for="reg-password"> @lang('backend.Confirm Password') </label>

                                            <input class="register-input" name="password_confirmation" type="text"
                                                id="reg-password" placeholder="@lang('backend.Confirm Password')" />
                                            @error('password_confirmation')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="reg-btn-main">
                                            <button class="reg-btn" type="submit">
                                                @lang('frontend.CREATE AN ACCOUNT')
                                            </button>

                                        </div>
                                        <div class="have-main">
                                            <div class="have-part">
                                                <h5>@lang('backend.Already have an account?')<a class="create-btn"
                                                        href="{{ route('login') }}">@lang('backend.Sign In')</a></h5>
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
