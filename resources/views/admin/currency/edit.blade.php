@extends('admin.layouts.master')

@section('admin_content')
    <div class="container ">
        <div class="general-form ">
            <div class="card">
                <div class="card-body custom-card-body">
                    <h1>@lang('backend.Edit Currency')</h1>
                    <form action="{{ route('admin.currency.update', $currency) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 ">
                            <label for="country" class="form-label">@lang('backend.Country')</label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" id="country"
                                name="country" value="{{ old('country', $currency->country) }}" required>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">@lang('backend.Currency Name')</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $currency->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="code" class="form-label">@lang('backend.Currency Code')</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                                name="code" value="{{ old('code', $currency->code) }}" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="symbol" class="form-label">@lang('backend.Symbol')</label>
                            <input type="text" class="form-control @error('symbol') is-invalid @enderror" id="symbol"
                                name="symbol" value="{{ old('symbol', $currency->symbol) }}" required>
                            @error('symbol')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="symbol_position" class="form-label">@lang('backend.Symbol Position')</label>
                            <select name="symbol_position" id="symbol_position" requiblack
                                        class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                        @if ($currency->symbol_position == 'left')
                                            <option value="left" selected>@lang('backend.Left')
                                            </option>
                                            <option value="right">@lang('backend.Right')
                                            </option>
                                        @else
                                            <option value="right" selected>@lang('backend.Right')</option>
                                            <option value="left">
                                                @lang('backend.Left')
                                            </option>
                                        @endif

                                    </select>
                        </div>

                        <div class="mb-3">
                            <label for="flag" class="form-label">@lang('backend.Flag') </label>
                            <input type="file" name="image"
                                class="form-control @error('image') is-invalid @enderror dropify"
                                data-default-file="{{ asset($currency->image) }}" />
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">@lang('backend.Update Currency')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
