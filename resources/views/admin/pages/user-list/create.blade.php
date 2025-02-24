@extends('admin.layouts.master')
@push('style')
@endpush
@section('admin_content')
    <div class="page-heading card-title">
        <h3>@lang('backend.Collection')</h3>
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


                                                    <form method="post"
                                                        action="{{ route('admin.offer.collection.store') }}"
                                                        id="offerCollectionForm" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="card">
                                                                <div class="add-top-header">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="row">
                                                                                <div class="col-lg-3">
                                                                                    <div class="add-header-content">
                                                                                        <h4>@lang('backend.Overview')</h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="product-header">

                                                                </div>
                                                                <div class="card-body custom-card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 ">
                                                                            <div class="product-input">
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <div class="upload-product">
                                                                                            <div class="row ">
                                                                                                <div
                                                                                                    class="col-lg-12 border-round">
                                                                                                    <h5>@lang('backend.Uploading Image')
                                                                                                    </h5>
                                                                                                    <div
                                                                                                        class="modal-product-image">
                                                                                                        <img id="offer_image_preview"
                                                                                                            src="{{ asset('public') }}/dumy.jpg"
                                                                                                            alt="Image">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <span>@lang('backend.Supported'):(jpeg,jpg,png)</span>
                                                                                                <span>@lang('backend.Size'):5MB</span>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <div
                                                                                                        class="xzoom-thumbs">
                                                                                                        <div class="row">
                                                                                                            <div
                                                                                                                class="col-lg-12 col-4">
                                                                                                                <div
                                                                                                                    class="modal-product-image4">
                                                                                                                    <i
                                                                                                                        class="fa fa-plus plus"></i>

                                                                                                                    <input
                                                                                                                        type="file"
                                                                                                                        onchange="imagePriview(event)"
                                                                                                                        name="image"
                                                                                                                        id="image"
                                                                                                                        class=" form-control" />
                                                                                                                </div>
                                                                                                                @error('image')
                                                                                                                    <span
                                                                                                                        class="text-danger">{{ $message }}</span>
                                                                                                                @enderror
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-8">
                                                                                        <div class="general-main">
                                                                                            <div class="general-text">

                                                                                            </div>
                                                                                            <div>
                                                                                                <div
                                                                                                    class="form-group general-form mb-3">
                                                                                                    <label
                                                                                                        for="floatingInput">@lang('backend.Title')
                                                                                                    </label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="title"
                                                                                                        id="title"
                                                                                                        placeholder="Ex: Sale Summer"
                                                                                                        required="" />
                                                                                                </div>
                                                                                                @error('title')
                                                                                                    <span
                                                                                                        class="text-danger">{{ $message }}</span>
                                                                                                @enderror
                                                                                            </div>
                                                                                            <div>
                                                                                                <div
                                                                                                    class="form-group general-form mb-3">
                                                                                                    <label
                                                                                                        for="floatingInput">@lang('backend.Sub Title')

                                                                                                    </label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="sub_title"
                                                                                                        id="sub_title"
                                                                                                        placeholder="Ex: The best offer"
                                                                                                        required="" />
                                                                                                </div>
                                                                                                @error('sub_title')
                                                                                                    <span
                                                                                                        class="text-danger">{{ $message }}</span>
                                                                                                @enderror
                                                                                            </div>
                                                                                            <div>
                                                                                                <div
                                                                                                    class="form-group general-form mb-3">
                                                                                                    <label
                                                                                                        for="floatingInput">@lang('backend.Select Product')
                                                                                                    </label>
                                                                                                    <select
                                                                                                        class="js-example-basic-multiple form-control"
                                                                                                        name="procuctCollection[]"
                                                                                                        multiple="multiple">
                                                                                                        @foreach ($products as $product)
                                                                                                            <option
                                                                                                                value="{{ $product->id }}">
                                                                                                                {{ $product->product_name }}
                                                                                                            </option>
                                                                                                        @endforeach

                                                                                                    </select>
                                                                                                </div>
                                                                                                @error('sub_title')
                                                                                                    <span
                                                                                                        class="text-danger">{{ $message }}</span>
                                                                                                @enderror
                                                                                            </div>

                                                                                        </div>


                                                                                    </div>
                                                                                </div>


                                                                                <button type="submit "
                                                                                    class="btn btn-primary" name="action"
                                                                                    value="publish">@lang('backend.Add Item')

                                                                                </button>

                                                                            </div>
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
