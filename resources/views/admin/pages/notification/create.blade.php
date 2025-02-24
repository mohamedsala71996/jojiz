@extends('admin.layouts.master')

@section('admin_content')
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
                                                    <div class="page-heading card-title">
                                                        <h3>@lang('backend.Send Notification')</h3>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <div class="card-body custom-card-body Product-body">
                                                            <form action="{{ route('admin.notification.send') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                <!-- CSRF Token -->
                                                                @csrf

                                                                <!-- User Type -->
                                                                <div class="form-group">
                                                                    <label for="user_type">@lang('backend.User Type')<span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control" id="user_type"
                                                                        name="user_type">
                                                                        <option disabled value="">@lang('backend.Select One')
                                                                        </option>
                                                                        <option value="all">@lang('backend.All User')</option>
                                                                        <option value="new_user">@lang('backend.New User')</option>
                                                                        <!-- Add more options as needed -->
                                                                    </select>
                                                                    @error('user_type')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Title -->
                                                                <div class="form-group">
                                                                    <label for="title">@lang('backend.Title') <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="title" name="title"
                                                                        placeholder="@lang('backend.Title')" required>
                                                                    @error('title')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Description -->
                                                                <div class="form-group">
                                                                    <label for="description">@lang('backend.Description')</label>
                                                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="@lang('backend.Description')"></textarea>
                                                                    @error('description')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Image -->
                                                                <div class="form-group">
                                                                    <label for="image">@lang('backend.Image')</label>
                                                                    <input type="file" class="form-control dropify"
                                                                        id="image" name="image"
                                                                        placeholder="@lang('backend.Enter Image URL')">
                                                                    @error('image')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Link -->
                                                                <div class="form-group">
                                                                    <label for="link">@lang('backend.Link')</label>
                                                                    <input type="url" class="form-control"
                                                                        id="link" name="link"
                                                                        placeholder="@lang('backend.Enter Link')">
                                                                    @error('link')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- URL -->
                                                                <div class="form-group">
                                                                    <label for="url">@lang('backend.URL')</label>
                                                                    <input type="url" class="form-control"
                                                                        id="url" name="url"
                                                                        placeholder="@lang('backend.Enter URL')">
                                                                    @error('url')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary">@lang('backend.Submit')</button>
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
