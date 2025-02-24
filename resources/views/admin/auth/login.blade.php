<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $basic_setting->site_name }} - {{ $basic_setting->site_title }}</title>
    <link href="{{ asset('public/backend/images/general-setting') }}/{{ $basic_setting->site_favicon }}"
        rel="shortcut icon" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('public/backend') }}/css/app.css" />
    <link rel="stylesheet" href="{{ asset('public/backend') }}/css/auth.css" />
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('index') }}"><img
                                src="{{ asset('public/backend/images/general-setting/') }}/{{ $basic_setting->site_logo }}"
                                alt="Logo" /></a>
                    </div>
                    <h1 class="auth-title">@lang('backend.Admin Login')</h1>
                    <p class="auth-subtitle">
                        @lang("backend.Log in using the credentials provided by the system administrator.")
                    </p>

                    <form action="{{ route('admin.login.submit') }}" method="POST">
                        @csrf
                        <label for="email">@lang('backend.Email') <span class="text-danger">*</span></label>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="email" type="text" name="email" class="form-control form-control-xl"
                                placeholder="Ex:example@gmail.com" />
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <label for="password">@lang('backend.Password') <span class="text-danger">*</span></label>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="password" type="password" name="password" class="form-control form-control-xl"
                                placeholder="Ex:Password" />
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn--primary btn-block btn-lg shadow-lg mt-5">
                            @lang('frontend.Login')
                        </button>
                    </form>

                    @if (env('APP_MODE') == 'demo')
                    <div class="login-info d-flex justify-content-between mt-4">
                        <div class="info-text">
                            <span>@lang('backend.Email'): <span class="info-detail">superadmin@arcadexit.com</span></span></br>
                            <span>@lang('backend.Password'): <span class="info-detail">arcadexit</span></span>
                        </div>
                        <button class="copy-btn" onclick="copyCredentials()"><i class="fa-regular fa-copy"></i></button>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>
    </div>
    <script>
        function copyCredentials() {
            let email = "superadmin@arcadexit.com";
            let password = "arcadexit";

            let emailField = document.getElementById("email");
            let passwordField = document.getElementById("password");

            emailField.value = email;
            passwordField.value = password;

        }
    </script>
</body>

</html>
