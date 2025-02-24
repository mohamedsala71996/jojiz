@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-content">
        <div class="row">
            <div class="content-body">
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                            <div class="modal-content  rounded h-100">
                                <div class="modal-body">
                                    <form method="POST"
                                        action="{{ route('admin.profile.password.update', auth()->user()->id) }}"
                                        id="UpdateProfile" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <div class="card">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title card-title">
                                                            @lang('backend.Password Update')
                                                        </h5>
                                                    </div>
                                                    <div class="card-body custom-card-body Product-body">
                                                        <div>
                                                            <div class="form-group mb-3">
                                                                <label for="floatingInput">@lang('backend.Old Password')
                                                                    <span style="color: red">:</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="old_password" value="" id="old_password"
                                                                    placeholder="@lang('backend.Enter old password')" required="" />
                                                            </div>
                                                            @error('old_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div>
                                                            <div class="form-group mb-3">
                                                                <label for="floatingInput">{{ __('backend.New Password') }}
                                                                    <span style="color: red">:</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="new_password" value="" id="new_password"
                                                                    placeholder="@lang('backend.Enter new password')" required="" />
                                                            </div>
                                                            @error('new_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div>
                                                            <div class="form-group mb-3">
                                                                <label for="floatingInput">@lang('backend.Confirm Password')
                                                                    <span style="color: red">:</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="confirm_password" value=""
                                                                    id="confirm_password" placeholder="@lang('frontend.Enter Confirm Password')"
                                                                    required="" />
                                                            </div>
                                                            @error('confirm_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="info-button">
                                                            <button type="submit">@lang('backend.Submit')</button>
                                                        </div>

                                                    </div>
                                                </div>
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
    </div>
@endsection
