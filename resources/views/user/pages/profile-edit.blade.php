@extends('frontend.layouts.master')

@section('frontend_content')
    @include('user.include.bredcrumb', ['bredcrumb_title' => 'Profile'])

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
                                    <div class="d-flex justify-content-between">
                                        <div class="info">
                                            <h1 class="dash__h1 u-s-m-b-14">@lang('frontend.Edit Profile')</h1>
                                            <span class="dash__text u-s-m-b-30">@lang("frontend.Looks like you haven't update your profile")</span>
                                        </div>
                                        {{-- <img src="{{asset(auth()->user()->image)}}" alt="" style="    width: 80px;"> --}}

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form class="dash-edit-p" method="POST" enctype="multipart/form-data"
                                                action="{{ route('user.profile.update', auth()->user()->id) }}">
                                                @csrf
                                                <div class="gl-inline">

                                                    <div class="u-s-m-b-30">
                                                        <label class="gl-label" for="reg-lname">@lang('backend.Name') <span
                                                                class="text-danger">*</span></label>

                                                        <input class="input-text input-text--primary-style" type="text"
                                                            name="name" value="{{ auth()->user()->name }}" id="reg-lname"
                                                            placeholder="Ex:Jhon Doe">
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="gl-inline">

                                                    <div class="u-s-m-b-30">
                                                        <label class="gl-label" for="gender">@lang('frontend.Birthday')</label>
                                                        <input type="date" value="{{ auth()->user()->birthday }}"
                                                            class="select-box select-box--primary-style u-w-100"
                                                            name="birthday">
                                                        @error('birthday')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="u-s-m-b-30">
                                                        <label class="gl-label" for="gender">@lang('frontend.GENDER')</label>
                                                        <select class="select-box select-box--primary-style u-w-100"
                                                            name="gender" id="gender">
                                                            <option selected="">@lang('backend.Select One')</option>
                                                            <option {{ auth()->user()->gender == 'male' ? 'selected' : '' }}
                                                                value="male">@lang('frontend.Male')</option>
                                                            <option
                                                                {{ auth()->user()->gender == 'famale' ? 'selected' : '' }}
                                                                value="female">@lang('frontend.Female')</option>
                                                        </select>
                                                        @error('gender')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">
                                                        <h2 class="dash__h2 u-s-m-b-8">@lang('frontend.E-MAIL')<span
                                                                class="text-danger">*</span></h2>
                                                        <div class="dash__link dash__link--secondary">

                                                            <input class="input-text input-text--primary-style"
                                                                type="text" name="email"
                                                                value="{{ auth()->user()->email }}" id="reg-lname"
                                                                placeholder="Ex:example@example.com">
                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="u-s-m-b-30">
                                                        <h2 class="dash__h2 u-s-m-b-8">@lang('backend.Phone')</h2>

                                                        <div class="dash__link dash__link--secondary">

                                                            <input class="input-text input-text--primary-style"
                                                                type="text" name="phone"
                                                                value="{{ auth()->user()->phone ?? '' }}" id="reg-lname"
                                                                placeholder="Ex:01531180095">
                                                            @error('phone')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="u-s-m-b-30">
                                                        <h2 class="dash__h2 u-s-m-b-8">@lang('frontend.Profile Image')</h2>

                                                        <div class="dash__link dash__link--secondary edit-image">

                                                            <input class="input-text input-text--primary-style"
                                                                type="file" name="image">
                                                        </div>
                                                    </div>
                                                </div>

                                                <button class="btn btn--e-brand-b-2 --primary text-white" type="submit">
                                                    @lang('backend.Update')
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
