@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-heading card-title">
        <h3>@lang('backend.Razorpay Marchant Credentials')</h3>
    </div>
    <div class="page-content">
        <!-- Contextual classes start -->
        <div class="section">
            <div class="row" id="table-contexual">
                <div class="col-12">
                    <div class="content-body">
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body custom-card-body">

                                                    <div class="table-responsive">
                                                        <div class="card-body custom-card-body Product-body general-form">
                                                            <form
                                                                action="{{ route('admin.payment.credentials.razorpay.update') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="RAZORPAY_ID_KEY">@lang('backend.RAZORPAY ID KEY') </label>
                                                                    <input type="text" class="form-control"
                                                                        id="RAZORPAY_ID_KEY"
                                                                        name="credentials[RAZORPAY_ID_KEY]"
                                                                        value="{{ old('credentials.RAZORPAY_ID_KEY', $paymentCredentials->RAZORPAY_ID_KEY) }}"
                                                                        required>
                                                                    @error('credentials.RAZORPAY_ID_KEY')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="RAZORPAY_SECRET_KEY">
                                                                        @lang('backend.RAZORPAY SECRET KEY')</label>
                                                                    <input type="text" class="form-control"
                                                                        id="RAZORPAY_SECRET_KEY"
                                                                        name="credentials[RAZORPAY_SECRET_KEY]"
                                                                        value="{{ old('credentials.RAZORPAY_SECRET_KEY', $paymentCredentials->RAZORPAY_SECRET_KEY) }}"
                                                                        required>
                                                                    @error('credentials.RAZORPAY_SECRET_KEY')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="image">@lang('backend.Image')</label>
                                                                    <input type="file" class="form-control dropify"
                                                                        id="image" name="image"
                                                                        data-default-file="{{ asset($image) }}">
                                                                    @error('image')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="is_localhost">@lang('backend.Mode')</label>
                                                                    <select id="is_localhost"
                                                                        name="credentials[is_localhost]"
                                                                        class="form-control">
                                                                        <option value="live"
                                                                            {{ old('credentials.is_localhost', $paymentCredentials->is_localhost) == 'live' ? 'selected' : '' }}>
                                                                            @lang('backend.Live')</option>
                                                                        <option value="sandbox"
                                                                            {{ old('credentials.is_localhost', $paymentCredentials->is_localhost) == 'sandbox' ? 'selected' : '' }}>
                                                                            @lang('backend.Sandbox')</option>
                                                                    </select>
                                                                    @error('credentials.is_localhost')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="status"> @lang('backend.Status')</label>

                                                                    <select id="status" name="status"
                                                                        class="form-control">
                                                                        <option value="1"
                                                                            {{ old('status', $allPaymentCredentials->status) == 1 ? 'selected' : '' }}>
                                                                            @lang('backend.Active')</option>
                                                                        <option value="0"
                                                                            {{ old('status', $allPaymentCredentials->status) == 0 ? 'selected' : '' }}>
                                                                            @lang('backend.Inactive')</option>
                                                                    </select>
                                                                    @error('status')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary">@lang('backend.Update Credentials') </button>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- Contextual classes end -->
    </div>
@endsection
