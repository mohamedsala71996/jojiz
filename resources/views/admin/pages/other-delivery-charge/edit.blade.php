@extends('admin.layouts.master')

@section('admin_content')
    <div class="container ">
        <div class="general-form ">
            <div class="card">
                <div class="card-body custom-card-body">
                    <h1>@lang('backend.Delivery Setting')</h1>
                    <form action="{{ route('admin.other.delivery.charge.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="normal_delivery_fee" class="form-label">@lang('backend.Normal Delivery Fee')</label>
                                    <input type="text"
                                        class="form-control @error('normal_delivery_fee') is-invalid @enderror"
                                        id="normal_delivery_fee" name="normal_delivery_fee"
                                        value="{{ old('normal_delivery_fee', $other_delivery_charge->normal_delivery_fee) }}"
                                        required>
                                    @error('normal_delivery_fee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="normal_delivery_duration" class="form-label">@lang('backend.Normal Delivery Duration(days)')</label>
                                    <input type="text"
                                        class="form-control @error('normal_delivery_duration') is-invalid @enderror"
                                        id="normal_delivery_duration" name="normal_delivery_duration"
                                        value="{{ old('normal_delivery_duration', $other_delivery_charge->normal_delivery_duration) }}"
                                        required>
                                    @error('normal_delivery_duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="status"> @lang('backend.Status')</label>

                                <select id="normal_delivery_status" name="normal_delivery_status" class="form-control">
                                    <option value="1"
                                        {{ old('normal_delivery_status', $other_delivery_charge->normal_delivery_status) == 1 ? 'selected' : '' }}>
                                        @lang('backend.Active')</option>
                                    <option value="0"
                                        {{ old('normal_delivery_status', $other_delivery_charge->normal_delivery_status) == 0 ? 'selected' : '' }}>
                                        @lang('backend.Inactive')</option>
                                </select>
                                @error('normal_delivery_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="express_delivery_fee" class="form-label">@lang('backend.Express Delivery Fee')</label>
                                    <input type="text"
                                        class="form-control @error('express_delivery_fee') is-invalid @enderror"
                                        id="express_delivery_fee" name="express_delivery_fee"
                                        value="{{ old('express_delivery_fee', $other_delivery_charge->express_delivery_fee) }}"
                                        required>
                                    @error('express_delivery_fee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="express_delivery_duration" class="form-label">@lang('backend.Express Delivery  Duration(days)')</label>
                                    <input type="text"
                                        class="form-control @error('express_delivery_duration') is-invalid @enderror"
                                        id="express_delivery_duration" name="express_delivery_duration"
                                        value="{{ old('express_delivery_duration', $other_delivery_charge->express_delivery_duration) }}"
                                        required>
                                    @error('express_delivery_duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="status"> @lang('backend.Status')</label>

                                <select id="express_delivery_status" name="express_delivery_status" class="form-control">
                                    <option value="1"
                                        {{ old('express_delivery_status', $other_delivery_charge->express_delivery_status) == 1 ? 'selected' : '' }}>
                                        @lang('backend.Active')</option>
                                    <option value="0"
                                        {{ old('express_delivery_status', $other_delivery_charge->express_delivery_status) == 0 ? 'selected' : '' }}>
                                        @lang('backend.Inactive')</option>
                                </select>
                                @error('express_delivery_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="pick_up_our_place_fee" class="form-label">@lang('backend.Pick Up at Our Place Fee')</label>
                                    <input type="text"
                                        class="form-control @error('pick_up_our_place_fee') is-invalid @enderror"
                                        id="pick_up_our_place_fee" name="pick_up_our_place_fee"
                                        value="{{ old('pick_up_our_place_fee', $other_delivery_charge->pick_up_our_place_fee) }}"
                                        required>
                                    @error('pick_up_our_place_fee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="pick_up_our_place_duration" class="form-label">@lang('backend.Pick Up Duration(days)')</label>
                                    <input type="text"
                                        class="form-control @error('pick_up_our_place_duration') is-invalid @enderror"
                                        id="pick_up_our_place_duration" name="pick_up_our_place_duration"
                                        value="{{ old('pick_up_our_place_duration', $other_delivery_charge->pick_up_our_place_duration) }}"
                                        required>
                                    @error('pick_up_our_place_duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="status"> @lang('backend.Status')</label>

                                <select id="pick_up_our_place_status" name="pick_up_our_place_status" class="form-control">
                                    <option value="1"
                                        {{ old('pick_up_our_place_status', $other_delivery_charge->pick_up_our_place_status) == 1 ? 'selected' : '' }}>
                                        @lang('backend.Active')</option>
                                    <option value="0"
                                        {{ old('pick_up_our_place_status', $other_delivery_charge->pick_up_our_place_status) == 0 ? 'selected' : '' }}>
                                        @lang('backend.Inactive')</option>
                                </select>
                                @error('pick_up_our_place_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="free_shipping_fee" class="form-label">@lang('backend.Free Shipping Threshold')</label>
                                    <input type="text"
                                        class="form-control @error('free_shipping_fee') is-invalid @enderror"
                                        id="free_shipping_fee" name="free_shipping_fee"
                                        value="{{ old('free_shipping_fee', $other_delivery_charge->free_shipping_fee) }}"
                                        required>
                                    @error('free_shipping_fee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="status"> @lang('backend.Status')</label>

                                <select id="free_shipping_status" name="free_shipping_status" class="form-control">
                                    <option value="1"
                                        {{ old('free_shipping_status', $other_delivery_charge->free_shipping_status) == 1 ? 'selected' : '' }}>
                                        @lang('backend.Active')</option>
                                    <option value="0"
                                        {{ old('free_shipping_status', $other_delivery_charge->free_shipping_status) == 0 ? 'selected' : '' }}>
                                        @lang('backend.Inactive')</option>
                                </select>
                                @error('free_shipping_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">@lang('backend.Update')</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body custom-card-body">
                    <h1>@lang('backend.Delivery Charge')</h1>
                    <form action="{{ url('admin/web-settings/update', $webinfo->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-lg-6">
                                <div class=" mb-3">
                                    <label for="floatingTextarea">@lang('backend.Delivery Charge Type') </label>
                                    <select name="delivery_charge_type" id="delivery_charge_type" requiblack
                                        class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                        @if ($webinfo->delivery_charge_type == 'order_wise')
                                            <option value="order_wise" selected>@lang('backend.Order Wise')
                                            </option>
                                            <option value="address_wise">@lang('backend.Address Wise')
                                            </option>
                                        @else
                                            <option value="order_wise">@lang('backend.Order Wise')</option>
                                            <option value="address_wise" selected>
                                                @lang('backend.Address Wise')
                                            </option>
                                        @endif

                                    </select>
                                </div>


                            </div>
                            <div class="col-lg-6">

                                <div class="from-group general-form mb-3">
                                    <label for="floatingInput">@lang('backend.Delivery Charge')</label>
                                    <input type="text" class="form-control" name="delivary_charge"
                                        value="{{ $webinfo->delivary_charge }}" id="delivary_charge"
                                        placeholder="@lang('backend.Delivery Charge')">
                                </div>

                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">@lang('backend.Update')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
