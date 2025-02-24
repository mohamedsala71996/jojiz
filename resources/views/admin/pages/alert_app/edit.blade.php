@extends('admin.layouts.master')

@push('style')
@endpush
@section('admin_content')
    <div class="container">
        <div class="card">
            <div class="card-body custom-card-body">
                <form action="{{ route('admin.alert.app.update', $alertApp->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">@lang('backend.Title') :</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title', $alertApp->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label">@lang('backend.Discount') :</label>
                        <input type="text" class="form-control @error('discount') is-invalid @enderror" id="discount"
                            name="discount" value="{{ old('discount', $alertApp->discount) }}">
                        @error('discount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="image" class="form-label">@lang('backend.Image'):</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror dropify"
                            data-default-file="{{ asset($alertApp->image ?? 'dumy.jpg') }}" id="image" name="image">
                        <span>@lang('backend.Supported'):(jpeg,jpg,png)</span><br />
                        <span>@lang('backend.Size'):5MB</span>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="mb-3">
                        <label for="expire_time" class="form-label">@lang('backend.Expire Time'):</label>
                        <input type="datetime-local" class="form-control @error('expire_time') is-invalid @enderror"
                            id="expire_time" name="expire_time" value="{{ old('expire_time', $alertApp->expire_time) }}">
                        @error('expire_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">@lang('backend.Link')</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link"
                            name="link" value="{{ old('link', $alertApp->link) }}">
                        @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="active" class="form-label">@lang('backend.Status')</label>
                        <select class="form-select @error('active') is-invalid @enderror" id="active" name="active">
                            <option value="1" {{ old('active', $alertApp->active) == '1' ? 'selected' : '' }}>
                                @lang('backend.Action') </option>
                            <option value="0" {{ old('active', $alertApp->active) == '0' ? 'selected' : '' }}>
                                @lang('backend.Inactive') </option>
                        </select>
                        @error('active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">@lang('backend.Update Alert')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
