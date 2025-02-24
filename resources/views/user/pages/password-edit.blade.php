@extends('frontend.layouts.master')

@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'Password'])

    <div class="u-s-p-b-60">
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="dash">
                <div class="container">
                    <div class="row">

                        @include('user.include.left-sidebar')

                        <div class="col-lg-9 col-md-12">
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                <div class="dash__pad-2">
                                    <h1 class="dash__h1 u-s-m-b-14">@lang("backend.Change Password")</h1>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form class="dash-edit-p" method="POST"
                                                action="{{ route('user.password.update', auth()->user()->id) }}">
                                                @csrf
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">
                                                        <label class="gl-label" for="reg-fname">@lang("frontend.Current Password")</label>
                                                        <input class="input-text input-text--primary-style"
                                                             type="text"
                                                            id="reg-fname" placeholder="@lang('backend.Enter Current Password')" name="current_password">
                                                        @error('current_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="u-s-m-b-30">
                                                        <label class="gl-label" for="reg-fname">@lang("backend.New Password")</label>
                                                        <input class="input-text input-text--primary-style"
                                                             type="text"
                                                            id="reg-fname" placeholder="@lang('backend.Enter new password')" name="password">
                                                        @error('new_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="u-s-m-b-30">
                                                        <label class="gl-label" for="reg-fname">@lang("backend.Confirm Password")</label>
                                                        <input class="input-text input-text--primary-style"
                                                             type="text"
                                                            id="reg-fname" placeholder="@lang('backend.Enter confirm password')" name="password_confirmation">
                                                        @error('password_confirmation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>


                                                <button class="btn btn--e-brand-b-2 --primary text-white" type="submit">
                                                    @lang("backend.Update")
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
@endsection
