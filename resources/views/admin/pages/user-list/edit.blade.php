@extends('admin.layouts.master')
@push('style')
@endpush
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
                                                    <h4 class="card-title product-title">
                                                        @lang('backend.Customer Info')
                                                    </h4>



                                                    <form action="{{ route('admin.user.list.update', $data->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label for="name"
                                                                    class="form-label">@lang('backend.Name')</label>
                                                                <input type="text"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    id="name" name="name"
                                                                    value="{{ old('name', $data->name) }}" required>
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label for="email"
                                                                    class="form-label">@lang('backend.Email')</label>
                                                                <input type="text"
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    id="email" name="email"
                                                                    value="{{ old('email', $data->email) }}" required>
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label for="phone"
                                                                    class="form-label">@lang('backend.Phone')</label>
                                                                <input type="text"
                                                                    class="form-control @error('phone') is-invalid @enderror"
                                                                    id="phone" name="phone"
                                                                    value="{{ old('phone', $data->phone) }}">
                                                                @error('phone')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label for="gender"
                                                                    class="form-label">@lang('backend.Gender')</label>
                                                                <select class="form-control" name="gender" id="gender">
                                                                    <option selected disabled="">@lang('backend.Select One')
                                                                    </option>
                                                                    <option {{ $data->gender == 'male' ? 'selected' : '' }}
                                                                        value="male">@lang('frontend.Male')</option>
                                                                    <option
                                                                        {{ $data->gender == 'female' ? 'selected' : '' }}
                                                                        value="female">@lang('frontend.Female')</option>
                                                                </select>
                                                                @error('gender')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label for="location"
                                                                    class="form-label">@lang('backend.Location')</label>
                                                                <input type="text"
                                                                    class="form-control @error('location') is-invalid @enderror"
                                                                    id="location" name="location"
                                                                    value="{{ old('location', $data->location) }}">
                                                                @error('location')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label for="flag" class="form-label">@lang('backend.Image')
                                                                </label>
                                                                <input type="file" name="image"
                                                                    class="form-control @error('image') is-invalid @enderror dropify"
                                                                    data-default-file="{{ asset($data->image) }}" />
                                                                @error('image')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>



                                                        <button type="submit"
                                                            class="btn btn-primary">@lang('backend.Update')</button>
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
        <!-- Contextual classes end -->
    </div>
    {{-- Details modal --}}

    @include('admin.components.modal.offer-collection.details')
    <!-------------========= Modal add category start ===========--------->
    @include('admin.components.modal.offer-collection.create')
    <!-------------========= Modal add Category End ===========--------->
    <!-------------========= Modal edit category start ===========--------->
    @include('admin.components.modal.offer-collection.edit')

    <!-------------========= Modal edit Category End ===========--------->
@endsection
@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        function imagePriview(event) {
            let previewImage = document.getElementById("offer_image_preview");
            previewImage.src = URL.createObjectURL(event.target.files[0]);
        }

        function editImagePriview(event) {
            let eidtPreviewImage = document.getElementById("offer_edit_image_preview");
            eidtPreviewImage.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endpush
