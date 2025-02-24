@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-heading card-title">
        <h3>@lang('backend.SslCommerze Marchant Credentials') </h3>
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
                                                                action="{{ route('admin.payment.credentials.sslcommerz.update') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="store_id">@lang('backend.Store ID')</label>
                                                                    <input type="text" class="form-control"
                                                                        id="store_id" name="credentials[store_id]"
                                                                        value="{{ old('credentials.store_id', $paymentCredentials->store_id) }}"
                                                                        required>
                                                                    @error('credentials.store_id')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="store_password">@lang('backend.Store Password')</label>
                                                                    <input type="text" class="form-control"
                                                                        id="store_password"
                                                                        name="credentials[store_password]"
                                                                        value="{{ old('credentials.store_password', $paymentCredentials->store_password) }}"
                                                                        required>
                                                                    @error('credentials.store_password')
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
                                                                            @lang('backend.Action')</option>
                                                                        <option value="0"
                                                                            {{ old('status', $allPaymentCredentials->status) == 0 ? 'selected' : '' }}>
                                                                            @lang('backend.Inactive')</option>
                                                                    </select>
                                                                    @error('status')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary">@lang('backend.Update Credentials')</button>
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
