@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-content">
        <div class="row">
            <div class="content-body">
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                            <div class="modal-content rounded h-100">
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('admin.profile.update', auth()->user()->id) }}"
                                        id="UpdateProfile" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <div class="card">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title card-title">
                                                            @lang('backend.Profile Update')
                                                        </h5>
                                                    </div>
                                                    <div class="card-body custom-card-body Product-body">
                                                        <div>
                                                            <div class="form-group mb-3">
                                                                <label for="floatingInput">@lang('backend.Name')
                                                                    <span style="color: red">:</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="display_name"
                                                                    value="{{ auth()->user()->display_name }}"
                                                                    id="display_name" placeholder="@lang('backend.Name')"
                                                                    required="" />
                                                            </div>
                                                            @error('display_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div>
                                                            <div class="form-group mb-3">
                                                                <label for="floatingInput">@lang('backend.Email')
                                                                    <span style="color: red">:</span></label>
                                                                <input type="email" class="form-control" name="email"
                                                                    value="{{ auth()->user()->email }}" id="email"
                                                                    placeholder="@lang('backend.Email')" required="" />
                                                            </div>
                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div>
                                                            <div class="form-group mb-3">
                                                                <label for="floatingInput">@lang('backend.Phone')
                                                                    <span style="color: red">:</span></label>
                                                                <input type="number" class="form-control" name="phone"
                                                                    value="{{ auth()->user()->phone }}" id="phone"
                                                                    placeholder="@lang('backend.Phone')" required="" />
                                                            </div>
                                                            @error('phone')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div>
                                                            <div class="form-group mb-3">
                                                                <label for="floatingInput">@lang('backend.Image')
                                                                    <span style="color: red">:</span></label>
                                                                <input type="file" class="form-control dropify"
                                                                    data-default-file="{{ asset(auth()->user()->image) }}"
                                                                    name="image" id="image" />
                                                            </div>
                                                            @error('image')
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
