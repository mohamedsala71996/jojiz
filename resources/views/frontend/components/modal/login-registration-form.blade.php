<div class="modal fade" id="authenticate">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal--shadow">
            <button class="btn dismiss-button fas fa-times" type="button" data-dismiss="modal"></button>
            <div class="modal-body">
                <div class="u-s-m-b-30">
                    <ul class="nav pd-tab__list" style="justify-content: center;">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#pd-login">@lang('frontend.Login')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#pd-reg">@lang('frontend.Register')</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <!--====== Tab 1 ======-->
                    <div class="tab-pane fade show active" id="pd-login">
                        <div class="row row--center">
                            <div class="col-lg-10 col-md-10 u-s-m-b-30">

                                <div class="login-part">
                                    <div class=" login-text1">
                                        <h1>@lang('Welcome Back')</h1>
                                        <p class="gl-text u-s-m-b-30">@lang('frontend.Sign in to access your account and manage your orders')</p>
                                        <a class="google-btn"
                                            href="{{ route('user.login.provider', ['provider' => 'google']) }}">
                                            <div class="google-text ">
                                                <img src="{{ asset('public/frontend/images/google.png') }}"
                                                    alt="">
                                                <span>@lang('frontend.Signin with Google')</span>
                                            </div>
                                        </a>
                                        <a class="google-btn"
                                            href="{{ route('user.login.provider', ['provider' => 'facebook']) }}">
                                            <div class="google-text ">
                                                <img src="{{ asset('public/frontend/images/facebook.png') }}"
                                                    alt="Facebook">
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

                                                <input class="login-input" type="text" name="email"
                                                    id="login-email" placeholder="Enter Email" />
                                                @error('password')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="login-input-part">
                                                <label class="login-text" for="login-password">@lang('backend.Password')</label>

                                                <input class="login-input" name="password" type="text"
                                                    id="login-password" placeholder="@lang('frontend.Enter Password')" />
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
                                                    <a class="create-btn"
                                                        href="{{ route('register') }}">@lang('backend.Create an account')</a>
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
                    <!--====== End - Tab 1 ======-->

                    <!--====== Tab 2 ======-->
                    <div class="tab-pane" id="pd-reg">
                        <div class="row row--center">
                            <div class="col-lg-10 col-md-8 u-s-m-b-30">
                                <div class="register-part">
                                    <div class=" register-text1">
                                        <h1>@lang('Welcome Back')</h1>
                                        <p class="gl-text u-s-m-b-30">@lang('backend.Sign up to access your account and manage your orders')</p>
                                        <a class="google-btn"
                                            href="{{ route('user.login.provider', ['provider' => 'google']) }}">
                                            <div class="google-text ">
                                                <img src="{{ asset('public/frontend/images/google.png') }}"
                                                    alt="">
                                                <span>@lang('frontend.Signin with Google')</span>
                                            </div>
                                        </a>
                                        <a class="google-btn"
                                            href="{{ route('user.login.provider', ['provider' => 'facebook']) }}">
                                            <div class="google-text ">
                                                <img src="{{ asset('public/frontend/images/facebook.png') }}"
                                                    alt="Facebook">
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
                                                    id="reg-lname" placeholder="@lang('backend.Name')" />

                                                @error('name')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="register-input-part">
                                                <label class="register-text"
                                                    for="reg-email">@lang('backend.Email')</label>

                                                <input class="register-input" type="text" name="email"
                                                    id="reg-email" placeholder="Enter Email" />
                                                @error('email')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="register-input-part">
                                                <label class="register-text"
                                                    for="reg-password">@lang('backend.Password')</label>

                                                <input class="register-input" name="password" type="text"
                                                    id="reg-password" placeholder="@lang('frontend.Enter Password')" />
                                                @error('password')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="register-input-part">
                                                <label class="register-text" for="reg-password"> @lang('backend.Confirm Password')
                                                </label>

                                                <input class="register-input" name="password_confirmation"
                                                    type="text" id="reg-password"
                                                    placeholder="Confirm your password" />
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
                    <!--====== End - Tab 2 ======-->
                </div>
            </div>
        </div>
    </div>
</div>
