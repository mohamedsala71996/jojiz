@extends('admin.layouts.master');

@section('admin_content')
    <style>
        .size-input .extra-large {
            padding: 15px;
            margin-right: 4px;
        }

        .size-input .extra-size {
            padding: 15px;
            margin-right: 4px;
        }

        .size-input .extra-color {
            padding: 15px;
            margin-right: 4px;
        }

        .size-input .extra-weight {
            padding: 15px;
            margin-right: 4px;
        }

        .size-input .extra-code {
            padding: 15px;
            margin-right: 4px;
        }

        .note-editable p {
            text-align: left !important;
        }
    </style>
    <div class="page-content">
        <div class="row">
            <div class="content-body">
                <div class=" mt-3">
                    <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                        <div class="modal-content rounded h-100">
                            <div class="modal-body modal-part">
                                <form method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div class="card">
                                                <div class="add-top-header">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="add-header-content">
                                                                        <h4>View Details</h4>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-header">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <h5 class="modal-title card-title">
                                                                @lang('backend.View Details Of') - {{ $product->product_name }}
                                                            </h5>
                                                        </div>

                                                        <div class="col-lg-4">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="tab-part-main">
                                                                    <ul class="nav nav-pills mb-3" id="pills-tab"
                                                                        role="tablist">
                                                                        <li class="nav-item" role="presentation">
                                                                            <button class="nav-link active"
                                                                                id="pills-information-tab"
                                                                                data-bs-toggle="pill"
                                                                                data-bs-target="#pills-information"
                                                                                type="button" role="tab"
                                                                                aria-controls="pills-home"
                                                                                aria-selected="true">Product
                                                                                Information</button>
                                                                        </li>
                                                                        <li class="nav-item" role="presentation">
                                                                            <button class="nav-link"
                                                                                id="pills-variation-tab"
                                                                                data-bs-toggle="pill"
                                                                                data-bs-target="#pills-variation"
                                                                                type="button" role="tab"
                                                                                aria-controls="pills-profile"
                                                                                aria-selected="false">Variation</button>
                                                                        </li>
                                                                        <li class="nav-item" role="presentation">
                                                                            <button class="nav-link" id="pills-shipping-tab"
                                                                                data-bs-toggle="pill"
                                                                                data-bs-target="#pills-shipping"
                                                                                type="button" role="tab"
                                                                                aria-controls="pills-shipping"
                                                                                aria-selected="false"
                                                                                href="#shipping&return">Shippint &
                                                                                Return</button>
                                                                        </li>
                                                                        <li class="nav-item" role="presentation">
                                                                            <button class="nav-link" id="pills-offer-tab"
                                                                                data-bs-toggle="pill"
                                                                                data-bs-target="#pills-offer" type="button"
                                                                                role="tab" aria-controls="pills-offer"
                                                                                aria-selected="false"
                                                                                href="#offer">Offers</button>
                                                                        </li>
                                                                        <li class="nav-item" role="presentation">
                                                                            <button class="nav-link" id="pills-video-tab"
                                                                                data-bs-toggle="pill"
                                                                                data-bs-target="#pills-video" type="button"
                                                                                role="tab" aria-controls="pills-video"
                                                                                aria-selected="false"
                                                                                href="#video">Video</button>
                                                                        </li>
                                                                        <li class="nav-item" role="presentation">
                                                                            <button class="nav-link" id="pills-seo-tab"
                                                                                data-bs-toggle="pill"
                                                                                data-bs-target="#pills-seo" type="button"
                                                                                role="tab" aria-controls="pills-seo"
                                                                                aria-selected="false"
                                                                                href="#seo">SEO</button>
                                                                        </li>

                                                                    </ul>
                                                                    <div class="tab-content" id="pills-tabContent">
                                                                        <div class="tab-pane fade show active"
                                                                            id="pills-information" role="tabpanel"
                                                                            aria-labelledby="pills-information-tab">
                                                                            <div class="card">
                                                                                <div class="add-top-header">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-3">
                                                                                                    <div
                                                                                                        class="add-header-content pills-header">
                                                                                                        <h5>Product
                                                                                                            Information</h5>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body Product-body">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 ">
                                                                                            <div class="product-input">
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-12">
                                                                                                        <div
                                                                                                            class="general-main">
                                                                                                            <div
                                                                                                                class="general-text">
                                                                                                                <h5>General
                                                                                                                    Information
                                                                                                                </h5>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="row">
                                                                                                                <div
                                                                                                                    class="col-lg-6">
                                                                                                                    <div
                                                                                                                        class="form-group general-form mb-3">
                                                                                                                        <label
                                                                                                                            for="floatingInput">Product
                                                                                                                            Name
                                                                                                                            <span
                                                                                                                                style="color: red">:</span></label>
                                                                                                                        <input
                                                                                                                            type="text"
                                                                                                                            class="form-control"
                                                                                                                            name="product_name"
                                                                                                                            id="product_name"
                                                                                                                            placeholder="@lang('backend.Product Name')"
                                                                                                                            value="{{ $product->product_name }}"
                                                                                                                            required="" />
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="col-lg-6">
                                                                                                                    <div
                                                                                                                        class="form-group general-form mb-3">
                                                                                                                        <label
                                                                                                                            for="floatingInput">Product
                                                                                                                            Sku
                                                                                                                            <span
                                                                                                                                style="color: red">:</span></label>
                                                                                                                        <input
                                                                                                                            type="text"
                                                                                                                            class="form-control"
                                                                                                                            name="product_sku"
                                                                                                                            id="product_sku"
                                                                                                                            placeholder="@lang('backend.Product Sku')"
                                                                                                                            value="{{ $product->product_sku }}"
                                                                                                                            required="" />
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="col-lg-6">
                                                                                                                    <div
                                                                                                                        class="size-part">
                                                                                                                        <div
                                                                                                                            class="form-group general-form category-form mb-3">
                                                                                                                            <label
                                                                                                                                for="floatingInput">Product
                                                                                                                                Category
                                                                                                                                <span
                                                                                                                                    style="color: red">:</span></label>
                                                                                                                            <select
                                                                                                                                name="category_id"
                                                                                                                                id="category_id"
                                                                                                                                onchange="setsubcategory()"
                                                                                                                                class="form-control">
                                                                                                                                <option
                                                                                                                                    value="">
                                                                                                                                    Select
                                                                                                                                    Category
                                                                                                                                </option>
                                                                                                                                @foreach ($categories as $category)
                                                                                                                                    <option
                                                                                                                                        value="{{ $category->id }}"
                                                                                                                                        @if ($product->category_id == $category->id) selected @endif>
                                                                                                                                        {{ $category->category_name }}
                                                                                                                                    </option>
                                                                                                                                @endforeach

                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="col-lg-6">
                                                                                                                    <div
                                                                                                                        class="size-part">
                                                                                                                        <div
                                                                                                                            class="form-group general-form category-form mb-3">
                                                                                                                            <label
                                                                                                                                for="floatingInput">Product
                                                                                                                                Sub-Category
                                                                                                                                <span
                                                                                                                                    style="color: red">:</span></label>
                                                                                                                            <select
                                                                                                                                name="sub_category_id"
                                                                                                                                id="sub_category_id"
                                                                                                                                onchange="setchildcategory()"
                                                                                                                                class="form-control">
                                                                                                                                @if (isset($product->sub_category_id))
                                                                                                                                    <option
                                                                                                                                        value="{{ $product->sub_category_id }}">
                                                                                                                                        {{ App\Models\Admin\SubCategory::where('id', $product->sub_category_id)->first()->name }}
                                                                                                                                    </option>
                                                                                                                                @else
                                                                                                                                    <option
                                                                                                                                        value="">
                                                                                                                                        Select
                                                                                                                                        Sub-Category
                                                                                                                                    </option>
                                                                                                                                @endif
                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="col-lg-6">
                                                                                                                    <div
                                                                                                                        class="size-part">
                                                                                                                        <div
                                                                                                                            class="form-group general-form category-form mb-3">
                                                                                                                            <label
                                                                                                                                for="floatingInput">Product
                                                                                                                                Child-Category
                                                                                                                                <span
                                                                                                                                    style="color: red">:</span></label>
                                                                                                                            <select
                                                                                                                                name="child_category_id"
                                                                                                                                id="child_category_id"
                                                                                                                                class="form-control">
                                                                                                                                @if (isset($product->child_category_id))
                                                                                                                                    <option
                                                                                                                                        value="{{ $product->child_category_id }}">
                                                                                                                                        {{ App\Models\Admin\ChildCategory::where('id', $product->child_category_id)->first()->name }}
                                                                                                                                    </option>
                                                                                                                                @else
                                                                                                                                    <option
                                                                                                                                        value="">
                                                                                                                                        Select
                                                                                                                                        Child-Category
                                                                                                                                    </option>
                                                                                                                                @endif

                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="col-lg-6">
                                                                                                                    <div
                                                                                                                        class="size-part">
                                                                                                                        <div
                                                                                                                            class="form-group general-form category-form mb-3">
                                                                                                                            <label
                                                                                                                                for="floatingInput">Choose
                                                                                                                                Brand
                                                                                                                                <span
                                                                                                                                    style="color: red">:</span></label>
                                                                                                                            <select
                                                                                                                                name="brand_id"
                                                                                                                                id="brand_id"
                                                                                                                                class="form-control">
                                                                                                                                <option
                                                                                                                                    value="">
                                                                                                                                    Select
                                                                                                                                    Brand
                                                                                                                                </option>
                                                                                                                                @foreach ($brands as $brand)
                                                                                                                                    <option
                                                                                                                                        @if ($brand->id == $product->brand_id) selected @endif
                                                                                                                                        value="{{ $brand->id }}">
                                                                                                                                        {{ $brand->name }}
                                                                                                                                    </option>
                                                                                                                                @endforeach

                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            <div
                                                                                                                class="form-group general-form mb-3">
                                                                                                                <label
                                                                                                                    for="floatingInput">Description
                                                                                                                    Product
                                                                                                                    <span
                                                                                                                        style="color: red; height: 150px;">:</span></label>
                                                                                                                <textarea rows="3" style="padding-bottom: 70px;height:80px padding-top:20px;" class="form-control"
                                                                                                                    name="product_description" id="product_description" required="">{{ $product->product_description }}</textarea>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="row">
                                                                                                                <div
                                                                                                                    class="col-lg-12 mt-4 ">
                                                                                                                    <div
                                                                                                                        class="row">

                                                                                                                        <div
                                                                                                                            class="gender-part">
                                                                                                                            <div
                                                                                                                                class="col-lg-6">
                                                                                                                                <div
                                                                                                                                    class="size-part ">
                                                                                                                                    <div
                                                                                                                                        class="form-group">
                                                                                                                                        <label>Gender
                                                                                                                                            <span
                                                                                                                                                class="text-danger">:</span></label>
                                                                                                                                        <p>Pick
                                                                                                                                            Available
                                                                                                                                            Gander
                                                                                                                                        </p>
                                                                                                                                        <div
                                                                                                                                            class="col-12 row">
                                                                                                                                            <div
                                                                                                                                                class="genter-input">
                                                                                                                                                <div
                                                                                                                                                    class="form-check form-check-inline mt-3">
                                                                                                                                                    <label
                                                                                                                                                        class="form-check-label">
                                                                                                                                                        <input
                                                                                                                                                            type="radio"
                                                                                                                                                            class="form-check-input"
                                                                                                                                                            name="gander"
                                                                                                                                                            id="medium_1"
                                                                                                                                                            value="Men"
                                                                                                                                                            @if ($product->gander == 'Men') Checked @endif />
                                                                                                                                                        Men
                                                                                                                                                        <i
                                                                                                                                                            class="input-helper"></i></label>
                                                                                                                                                </div>
                                                                                                                                                <div
                                                                                                                                                    class="form-check form-check-inline">
                                                                                                                                                    <label
                                                                                                                                                        class="form-check-label">
                                                                                                                                                        <input
                                                                                                                                                            type="radio"
                                                                                                                                                            class="form-check-input"
                                                                                                                                                            name="gander"
                                                                                                                                                            id="medium_2"
                                                                                                                                                            value="Women"
                                                                                                                                                            @if ($product->gander == 'Women') Checked @endif />
                                                                                                                                                        Women
                                                                                                                                                        <i
                                                                                                                                                            class="input-helper"></i></label>
                                                                                                                                                </div>
                                                                                                                                                <div
                                                                                                                                                    class="form-check form-check-inline">
                                                                                                                                                    <label
                                                                                                                                                        class="form-check-label">
                                                                                                                                                        <input
                                                                                                                                                            type="radio"
                                                                                                                                                            class="form-check-input"
                                                                                                                                                            name="gander"
                                                                                                                                                            id="medium_3"
                                                                                                                                                            value="Unisex"
                                                                                                                                                            @if ($product->gander == 'Unisex') Checked @endif />
                                                                                                                                                        Unisex
                                                                                                                                                        <i
                                                                                                                                                            class="input-helper"></i></label>
                                                                                                                                                </div>
                                                                                                                                                <input
                                                                                                                                                    type="hidden"
                                                                                                                                                    name="product_id"
                                                                                                                                                    id="product_id"
                                                                                                                                                    value="{{ $product->id }}">
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
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="pills-variation"
                                                                            role="tabpanel"
                                                                            aria-labelledby="pills-variation-tab">
                                                                            <div class="top-header-main">
                                                                                <div class="add-top-header">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-3">
                                                                                                    <div
                                                                                                        class="add-header-content pills-header">
                                                                                                        <h5>Product
                                                                                                            Variation</h5>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mt-2">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="variation-part">
                                                                                            <table
                                                                                                class="table header-border">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>@lang('backend.ID')
                                                                                                        </th>
                                                                                                        <th>@lang('backend.Image')
                                                                                                        </th>
                                                                                                        <th> @lang('backend.Color')
                                                                                                        </th>
                                                                                                        <th> @lang('backend.Code')
                                                                                                        </th>
                                                                                                        <th>@lang('backend.Size')
                                                                                                        </th>
                                                                                                        <th>@lang('backend.Status')
                                                                                                        </th>
                                                                                                        <th>@lang('backend.Action')
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody id="variationpart">
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
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
                                                                                                        <img src="../../../public/dumy.jpg"
                                                                                                            class="big-image"
                                                                                                            id="productImage"
                                                                                                            xoriginal="../../../public/dumy.jpg"
                                                                                                            style="visibility: visible;">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <div
                                                                                                        class="xzoom-thumbs">
                                                                                                        <div
                                                                                                            class="row">
                                                                                                            <div
                                                                                                                class="col-lg-12 col-4">
                                                                                                                <div class="modal-product-image4"
                                                                                                                    id="imagePreviewContainer">
                                                                                                                    <i
                                                                                                                        class="fa fa-plus plus"></i>
                                                                                                                    <input
                                                                                                                        type="file"
                                                                                                                        class="form-control"
                                                                                                                        onchange="loadFile(event)"
                                                                                                                        name="photo"
                                                                                                                        id="photo">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-8 mt-0">

                                                                                        <div
                                                                                            class="pricing-part pricing-pb mt-0">
                                                                                            <div class="pricing-part2">
                                                                                                <h5><a type="button"
                                                                                                        id="addvarition"
                                                                                                        style="color:white">@lang('backend.Add Variation')
                                                                                                    </a></h5>
                                                                                            </div>

                                                                                            <div class="row">
                                                                                                <div class="col-lg-6 mb-4">
                                                                                                    <div class="size-part">
                                                                                                        <h5>Color</h5>
                                                                                                        <p class="m-0">
                                                                                                            @lang('backend.Pick Available Color')
                                                                                                        </p>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="color_id"
                                                                                                            id="color_id"
                                                                                                            class="form-control">
                                                                                                        <div
                                                                                                            class="size-input d-flex justify-content-between pt-2">

                                                                                                            <div
                                                                                                                class="form-group">
                                                                                                                <select
                                                                                                                    name="color"
                                                                                                                    id="choosecolor"
                                                                                                                    onchange="setcolor()"
                                                                                                                    class="form-control"
                                                                                                                    style="width: 230px;">
                                                                                                                    <option
                                                                                                                        value="">
                                                                                                                        @lang('backend.Select Color From The Box')
                                                                                                                    </option>
                                                                                                                    @forelse (App\Models\ProductAttribute::where('value',1)->get() as $color)
                                                                                                                        <option
                                                                                                                            style="color:{{ $color->name }}"
                                                                                                                            value="{{ $color->id }}">
                                                                                                                            {{ $color->name }}
                                                                                                                        </option>
                                                                                                                    @empty
                                                                                                                        <option
                                                                                                                            value="">
                                                                                                                            @lang('frontend.No Data Found !')
                                                                                                                        </option>
                                                                                                                    @endforelse
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-6">
                                                                                                    <div class="size-part">
                                                                                                        <h5>@lang('backend.Code')
                                                                                                        </h5>
                                                                                                        <p class="m-0">
                                                                                                            @lang('backend.Pick Available Code')
                                                                                                        </p>
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="code_id"
                                                                                                            id="code_id"
                                                                                                            class="form-control">
                                                                                                        <div
                                                                                                            class="size-input d-flex justify-content-between pt-2">
                                                                                                            <select
                                                                                                                name="code"
                                                                                                                id="choosecode"
                                                                                                                onchange="setcode()"
                                                                                                                class="form-control"
                                                                                                                style="width: 230px;">
                                                                                                                <option
                                                                                                                    value="">
                                                                                                                    @lang('backend.Select Product Code From The Box')
                                                                                                                </option>
                                                                                                                @forelse (App\Models\ProductAttribute::where('value',4)->get() as $code)
                                                                                                                    <option
                                                                                                                        value="{{ $code->id }}">
                                                                                                                        {{ $code->name }}
                                                                                                                    </option>
                                                                                                                @empty
                                                                                                                    <option
                                                                                                                        value="">
                                                                                                                        @lang('frontend.No Data Found !')
                                                                                                                    </option>
                                                                                                                @endforelse
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-lg-12 mb-4">
                                                                                                    <div class="card">
                                                                                                        <div class="card-header p-0"
                                                                                                            id="headingOne">
                                                                                                            <h5
                                                                                                                class="mb-0">
                                                                                                                <button
                                                                                                                    style="display: flex;justify-content: space-between;width: 100%;text-decoration: none;"
                                                                                                                    type="button"
                                                                                                                    id="collupshead"
                                                                                                                    class="btn btn-link"
                                                                                                                    data-bs-toggle="collapse"
                                                                                                                    data-bs-target="#collapseSize"
                                                                                                                    aria-expanded="true"
                                                                                                                    aria-controls="collapseOne">
                                                                                                                    <h5
                                                                                                                        class="text-uppercase m-0">
                                                                                                                        @lang('backend.Product Size')

                                                                                                                    </h5>
                                                                                                                    <h5
                                                                                                                        class="text-uppercase m-0">
                                                                                                                        +
                                                                                                                    </h5>
                                                                                                                </button>
                                                                                                            </h5>
                                                                                                        </div>

                                                                                                        <div id="collapseSize"
                                                                                                            class="collapse show"
                                                                                                            aria-labelledby="headingOne"
                                                                                                            data-parent="#accordion">
                                                                                                            <div class="card-body custom-card-body"
                                                                                                                style="padding: 10px;">
                                                                                                                <table
                                                                                                                    id="sizeTable"
                                                                                                                    style="width: 100% !important;margin:0px"
                                                                                                                    class="table table-bordered table-striped">
                                                                                                                    <thead>
                                                                                                                        <tr>
                                                                                                                            <th>@lang('backend.ID')
                                                                                                                            </th>
                                                                                                                            <th>@lang('backend.Size')
                                                                                                                            </th>
                                                                                                                            <th>@lang('backend.Regular Price')
                                                                                                                            </th>
                                                                                                                            <th>@lang('backend.Discount')
                                                                                                                            </th>
                                                                                                                            <th>@lang('backend.Stock')
                                                                                                                            </th>
                                                                                                                            <th>
                                                                                                                                @lang('backend.Action')
                                                                                                                            </th>
                                                                                                                        </tr>
                                                                                                                    </thead>
                                                                                                                    <tbody
                                                                                                                        id="sizeTableData">
                                                                                                                    </tbody>
                                                                                                                    <tfoot>
                                                                                                                        <tr>
                                                                                                                            <td
                                                                                                                                colspan="6">
                                                                                                                                <select
                                                                                                                                    id="sizevariantID"
                                                                                                                                    style="width: 100%;">
                                                                                                                                    <option
                                                                                                                                        value="">
                                                                                                                                        @lang('backend.Select Product Size')
                                                                                                                                    </option>
                                                                                                                                </select>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </tfoot>

                                                                                                                </table>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                                {{-- <div
                                                                                                    class="col-lg-12 mb-4">
                                                                                                    <div class="card">
                                                                                                        <div class="card-header p-0"
                                                                                                            id="headingOne">
                                                                                                            <h5
                                                                                                                class="mb-0">
                                                                                                                <button type="button" style="display: flex;justify-content: space-between;width: 100%;text-decoration: none;" id="collupshead" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseWeight" aria-expanded="true" aria-controls="collapseOne">
                                                                                                                    <h5 class="text-uppercase m-0"> Product Weight </h5>
                                                                                                                    <h5 class="text-uppercase m-0"> + </h5>
                                                                                                                </button>
                                                                                                            </h5>
                                                                                                        </div>

                                                                                                        <div id="collapseWeight"
                                                                                                            class="collapse show"
                                                                                                            aria-labelledby="headingOne"
                                                                                                            data-parent="#accordion">
                                                                                                            <div class="card-body custom-card-body"
                                                                                                                style="padding: 10px;">
                                                                                                                <table
                                                                                                                    id="weightTable"
                                                                                                                    style="width: 100% !important;margin:0"
                                                                                                                    class="table table-bordered table-striped">
                                                                                                                    <thead>
                                                                                                                        <tr>
                                                                                                                            <th>ID
                                                                                                                            </th>
                                                                                                                            <th>Weight
                                                                                                                            </th>
                                                                                                                            <th>Regular
                                                                                                                                Price
                                                                                                                            </th>
                                                                                                                            <th>Discount
                                                                                                                            </th>
                                                                                                                            <th>Stock
                                                                                                                            </th>
                                                                                                                            <th>
                                                                                                                                Action
                                                                                                                            </th>
                                                                                                                        </tr>
                                                                                                                    </thead>
                                                                                                                    <tbody id="weightTableData">
                                                                                                                    </tbody>
                                                                                                                    <tfoot>
                                                                                                                        <tr>
                                                                                                                            <td
                                                                                                                                colspan="6">
                                                                                                                                <select
                                                                                                                                    id="weightvariantID"
                                                                                                                                    style="width: 100%;">
                                                                                                                                    <option
                                                                                                                                        value="">
                                                                                                                                        Select
                                                                                                                                        Product
                                                                                                                                        Weight
                                                                                                                                    </option>
                                                                                                                                </select>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </tfoot>

                                                                                                                </table>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> --}}

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="tab-pane fade" id="pills-shipping"
                                                                            role="tabpanel"
                                                                            aria-labelledby="pills-shipping-tab">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <div class="card">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">
                                                                                                    @lang()
                                                                                                    Shipping & Return
                                                                                                </h5>
                                                                                            </div>
                                                                                            <div
                                                                                                class="card-body custom-card-body student-body">

                                                                                                <div class="row">
                                                                                                    <div class="col-lg-6">
                                                                                                        <div
                                                                                                            class="form-group">
                                                                                                            <label>Shipping
                                                                                                                Type
                                                                                                                <span
                                                                                                                    class="text-danger">:</span></label>
                                                                                                            <div
                                                                                                                class="col-12 d-flex row">
                                                                                                                <div
                                                                                                                    class="form-check form-check-inline">
                                                                                                                    <label
                                                                                                                        class="form-check-label">
                                                                                                                        <input
                                                                                                                            type="radio"
                                                                                                                            class="form-check-input"
                                                                                                                            name="shipping_type"
                                                                                                                            id="medium_1"
                                                                                                                            value="Free"
                                                                                                                            @if ($product->shipping_type == 'Free') checked @endif />
                                                                                                                        Free
                                                                                                                        <i
                                                                                                                            class="input-helper"></i></label>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="form-check form-check-inline">
                                                                                                                    <label
                                                                                                                        class="form-check-label">
                                                                                                                        <input
                                                                                                                            type="radio"
                                                                                                                            class="form-check-input"
                                                                                                                            name="shipping_type"
                                                                                                                            id="medium_2"
                                                                                                                            value="Flat Sale"
                                                                                                                            @if ($product->shipping_type == 'Flat Sale') checked @endif />
                                                                                                                        Flat
                                                                                                                        Sale
                                                                                                                        <i
                                                                                                                            class="input-helper"></i></label>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-6">
                                                                                                        <div
                                                                                                            class="form-group mb-3">
                                                                                                            <label
                                                                                                                for="floatingInput">Shipping
                                                                                                                Cost
                                                                                                                <span>:</span></label>
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                class="form-control"
                                                                                                                name="shippig_cost"
                                                                                                                id="shippig_cost"
                                                                                                                placeholder="@lang('backend.Cost')"
                                                                                                                required=""
                                                                                                                value="{{ $product->shipping_cost }}" />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="row">
                                                                                                    <div class="col-lg-12">
                                                                                                        <label
                                                                                                            for="">Shipping
                                                                                                            &
                                                                                                            Return<span
                                                                                                                class="text-danger">:</span></label>
                                                                                                        <div
                                                                                                            class="shipping-return-part">
                                                                                                            <section
                                                                                                                id="description"
                                                                                                                class="!h-80 textarea-border-radius ql-container ql-snow">
                                                                                                                <textarea rows="3" style="padding-bottom: 70px;height:80px padding-top:20px;" class="form-control"
                                                                                                                    name="shipping_rtn_policy" id="shipping_rtn_policy" required="">{{ $product->shipping_rtn_policy }}</textarea>
                                                                                                            </section>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                        <div class="tab-pane fade" id="pills-offer"
                                                                            role="tabpanel"
                                                                            aria-labelledby="pills-offer-tab">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <div class="card">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">
                                                                                                    Offers
                                                                                                </h5>
                                                                                            </div>
                                                                                            <div
                                                                                                class="card-body custom-card-body student-body">

                                                                                                <div class="row">
                                                                                                    <div class="col-lg-6">
                                                                                                        <div
                                                                                                            class="form-group mb-3">
                                                                                                            <label
                                                                                                                for="floatingInput">Offer
                                                                                                                Start
                                                                                                                Date
                                                                                                                <span>:</span></label>
                                                                                                            <input
                                                                                                                type="date"
                                                                                                                class="form-control"
                                                                                                                name="offer_start"
                                                                                                                id="offer_start"
                                                                                                                placeholder="@lang('backend.Offer Start Date')"
                                                                                                                required=""
                                                                                                                value="{{ $product->offer_start }}" />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-6">
                                                                                                        <div
                                                                                                            class="form-group mb-3">
                                                                                                            <label
                                                                                                                for="floatingInput">Offer
                                                                                                                End Date
                                                                                                                <span>:</span></label>
                                                                                                            <input
                                                                                                                type="date"
                                                                                                                class="form-control"
                                                                                                                name="offer_end"
                                                                                                                id="offer_end"
                                                                                                                placeholder="@lang('backend.Offer End Date')"
                                                                                                                required=""
                                                                                                                value="{{ $product->offer_end }}" />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-6">
                                                                                                        <div
                                                                                                            class="form-group mb-3">
                                                                                                            <label
                                                                                                                for="floatingInput">Discount
                                                                                                                @lang('backend.Percentage')
                                                                                                                <span>:</span></label>
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                class="form-control"
                                                                                                                name="discount_percent"
                                                                                                                id="discount_percent"
                                                                                                                placeholder="@lang('backend.discount')"
                                                                                                                required=""
                                                                                                                value="{{ $product->discount_percent }}" />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-6">
                                                                                                        <div
                                                                                                            class="form-group">
                                                                                                            <label>Is
                                                                                                                Product
                                                                                                                Quantity
                                                                                                                Multiply
                                                                                                                <span
                                                                                                                    class="text-danger">:</span></label>
                                                                                                            <div
                                                                                                                class="col-12 d-flex row">
                                                                                                                <div
                                                                                                                    class="form-check form-check-inline">
                                                                                                                    <label
                                                                                                                        class="form-check-label">
                                                                                                                        <input
                                                                                                                            type="radio"
                                                                                                                            class="form-check-input"
                                                                                                                            name="multiple_qty"
                                                                                                                            id="medium_1"
                                                                                                                            value="Yes"
                                                                                                                            @if ($product->multiple_qty == 'Yes') checked @endif />
                                                                                                                        Yes
                                                                                                                        <i
                                                                                                                            class="input-helper"></i></label>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="form-check form-check-inline">
                                                                                                                    <label
                                                                                                                        class="form-check-label">
                                                                                                                        <input
                                                                                                                            type="radio"
                                                                                                                            class="form-check-input"
                                                                                                                            name="multiple_qty"
                                                                                                                            id="medium_2"
                                                                                                                            value="No"
                                                                                                                            @if ($product->multiple_qty == 'No') checked @endif />
                                                                                                                        No
                                                                                                                        <i
                                                                                                                            class="input-helper"></i></label>
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
                                                                        <div class="tab-pane fade" id="pills-video"
                                                                            role="tabpanel"
                                                                            aria-labelledby="pills-video-tab">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="card">
                                                                                        <div class="modal-header">
                                                                                            <div class="form-group w-100">
                                                                                                <label
                                                                                                    for="">Video</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    value="{{ $product->youtube_embadecode }}"
                                                                                                    name="youtube_embadecode"
                                                                                                    id="youtube_embadecode">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="tab-pane fade" id="pills-seo"
                                                                            role="tabpanel"
                                                                            aria-labelledby="pills-seo-tab">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <div class="card">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">
                                                                                                    SEO
                                                                                                </h5>
                                                                                            </div>
                                                                                            <div
                                                                                                class="card-body custom-card-body student-body">

                                                                                                <div class="row">
                                                                                                    <div
                                                                                                        class="col-lg-6 text-center">
                                                                                                        <img @if (isset($product->meta_image)) src="{{ asset($product->meta_image) }}" @else src="{{ asset('public/dumy.jpg') }}" @endif
                                                                                                            alt=""
                                                                                                            id="metaimage"
                                                                                                            width="200PX">
                                                                                                    </div>
                                                                                                    <div class="col-lg-6">
                                                                                                        <div
                                                                                                            class="form-group mb-3">
                                                                                                            <label
                                                                                                                for="floatingInput">Meta
                                                                                                                Image
                                                                                                                <span>:</span></label>
                                                                                                            <input
                                                                                                                type="file"
                                                                                                                name="meta_image"
                                                                                                                id="meta_image"
                                                                                                                onchange="loadMeta(event)"
                                                                                                                class="form-control">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-6">
                                                                                                        <div
                                                                                                            class="form-group mb-3">
                                                                                                            <label
                                                                                                                for="floatingInput">Meta
                                                                                                                Name
                                                                                                                <span>:</span></label>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="meta_name"
                                                                                                                id="meta_name"
                                                                                                                placeholder="@lang('backend.name')"
                                                                                                                value="{{ $product->meta_name }}" />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-6">
                                                                                                        <div
                                                                                                            class="form-group mb-3">
                                                                                                            <label
                                                                                                                for="floatingInput">Meta
                                                                                                                Title
                                                                                                                <span>:</span></label>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="meta_title"
                                                                                                                id="meta_title"
                                                                                                                placeholder="@lang('backend.Title')"
                                                                                                                value="{{ $product->meta_title }}" />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-6">
                                                                                                        <div
                                                                                                            class="form-group mb-3">
                                                                                                            <label
                                                                                                                for="floatingInput">Meta
                                                                                                                Keywords
                                                                                                                <span>:</span></label>
                                                                                                            <textarea class="form-control" rows="2" name="meta_keywords" id="meta_keywords">{{ $product->meta_keywords }}</textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-lg-6">
                                                                                                        <div
                                                                                                            class="form-group mb-3">
                                                                                                            <label
                                                                                                                for="floatingInput">Meta
                                                                                                                Description
                                                                                                                <span>:</span></label>
                                                                                                            <textarea class="form-control" rows="2" name="meta_description" id="meta_description">{{ $product->meta_description }}</textarea>
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

    <div class="modal fade" id="editvariation" aria-labelledby="editvariation" aria-hidden="true">
        <div class="modal-dialog">
            <form action=" " id="editvariationForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content" id="editvariationmodel">

                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="viewvariation" aria-labelledby="viewvariation" aria-hidden="true">
        <div class="modal-dialog">
            <form action=" " id="viewvariationForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content" id="viewvariationmodel">

                </div>
            </form>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#product_description').summernote({
                    placeholder: 'Write Product Description',
                    tabsize: 2,
                    height: 100
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                loadvariation($('#product_id').val());
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#choosecolor').select2();
                $('#choosecode').select2();
                $(document).on("click", "#submit", function() {
                    var product_id = $("#product_id");
                    var product_sku = $("#product_sku");
                    var product_name = $("#product_name");
                    var category_id = $("#category_id");
                    var sub_category_id = $("#sub_category_id");
                    var child_category_id = $("#child_category_id");
                    var brand_id = $("#brand_id");
                    var product_description = $("#product_description");
                    var gander = $('input[name="gander"]:checked').val();
                    var shipping_type = $('input[name="shipping_type"]:checked').val();
                    var shippig_cost = $("#shippig_cost");
                    var shipping_rtn_policy = $("#shipping_rtn_policy");
                    var offer_start = $("#offer_start");
                    var offer_end = $("#offer_end");
                    var discount_percent = $("#discount_percent");
                    var multiple_qty = $('input[name="multiple_qty"]:checked').val();
                    var meta_name = $("#meta_name");
                    var meta_title = $("#meta_title");
                    var meta_keywords = $("#meta_keywords");
                    var meta_description = $("#meta_description");
                    var youtube_embadecode = $("#youtube_embadecode");

                    var formData = new FormData();

                    formData.append('product_id', product_id.val());
                    formData.append('product_sku', product_sku.val());
                    formData.append('product_name', product_name.val());
                    formData.append('category_id', category_id.val());
                    formData.append('sub_category_id', sub_category_id.val());
                    formData.append('child_category_id', child_category_id.val());
                    formData.append('brand_id', brand_id.val());
                    formData.append('product_description', product_description.val());
                    formData.append('gander', gander);
                    formData.append('shipping_type', shipping_type);
                    formData.append('shippig_cost', shippig_cost.val());
                    formData.append('shipping_rtn_policy', shipping_rtn_policy.val());
                    formData.append('offer_start', offer_start.val());
                    formData.append('offer_end', offer_end.val());
                    formData.append('discount_percent', discount_percent.val());
                    formData.append('multiple_qty', multiple_qty);
                    formData.append('meta_name', meta_name.val());
                    formData.append('meta_title', meta_title.val());
                    formData.append('meta_keywords', meta_keywords.val());
                    formData.append('meta_description', meta_description.val());
                    formData.append('youtube_embadecode', youtube_embadecode.val());
                    formData.append('meta_image', $('#meta_image')[0].files[0]);


                    $.ajax({
                        type: "POST",
                        url: '{{ url('admin/product/store') }}',
                        data: formData,
                        contentType: false,
                        processData: false,

                        success: function(data) {
                            $('#product_id').val(data.id);
                            toastr.success("@lang('backend.Product Update successfully')");
                        }
                    });
                });


                $(document).on("click", "#addvarition", function() {
                    var product_id = $("#product_id");
                    var color_id = $("#color_id");
                    var code_id = $("#code_id");

                    var size = [];
                    var sizeCount = 0;
                    var sizeValidationFailed = false;
                    $("#sizeTable tbody tr").each(function(index, value) {
                        var currentRow = $(this);
                        var obj = {};

                        var sizeID = currentRow.find("#sizeID").val();
                        var sizeValue = currentRow.find("#size").val();
                        var regularPrice = currentRow.find("#RegularPrice").val();
                        var discount = currentRow.find("#Discount").val();
                        var stock = currentRow.find("#Stock").val();
                        var buy_price = currentRow.find("#buy_price").val();


                        // Check each field for specific validation
                        if (!sizeID) {
                            toastr.error("@lang('backend.Size ID cannot be empty.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (!sizeValue) {
                            toastr.error("@lang('backend.Size cannot be empty.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (!regularPrice || regularPrice == 0) {
                            toastr.error("@lang('backend.Regular Price cannot be empty or zero.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (isNaN(regularPrice)) {
                            toastr.error("@lang('backend.Regular Price should be number.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (!discount) {
                            toastr.error("@lang('backend.Discount cannot be empty.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (isNaN(discount)) {
                            toastr.error("@lang('backend.Discount should be number.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (!stock || stock == 0) {
                            toastr.error("@lang('backend.Stock cannot be empty or zero.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (isNaN(stock)) {
                            toastr.error("@lang('backend.Stock should be number.')");
                            sizeValidationFailed = true;
                            return false;
                        }
                        if (isNaN(buy_price)) {
                            toastr.error("@lang('backend.Buy price should be number.')");
                            sizeValidationFailed = true;
                            return false;
                        }

                        obj.sizeID = sizeID;
                        obj.size = sizeValue;
                        obj.RegularPrice = regularPrice;
                        obj.Discount = discount;
                        obj.Stock = stock;
                        obj.buy_price = buy_price;

                        size.push(obj);
                        sizeCount++;
                    });

                    if (sizeValidationFailed) return; // Prevent form s
                    // $("#sizeTable tbody tr").each(function(index, value) {
                    //     var currentRow = $(this);
                    //     var obj = {};
                    //     obj.sizeID = currentRow.find("#sizeID").val();
                    //     obj.size = currentRow.find("#size").val();
                    //     obj.RegularPrice = currentRow.find("#RegularPrice").val();
                    //     obj.Discount = currentRow.find("#Discount").val();
                    //     obj.Stock = currentRow.find("#Stock").val();
                    //     size.push(obj);
                    //     sizeCount++;
                    // });

                    var weight = [];
                    var weightCount = 0;
                    $("#weightTable tbody tr").each(function(index, value) {
                        var currentRow = $(this);
                        var obj = {};
                        obj.weightID = currentRow.find("#weightID").val();
                        obj.weight = currentRow.find("#weight").val();
                        obj.RegularPrice = currentRow.find("#RegularPrice").val();
                        obj.Discount = currentRow.find("#Discount").val();
                        obj.Stock = currentRow.find("#Stock").val();
                        weight.push(obj);
                        weightCount++;
                    });

                    if (product_id.val() == '') {
                        toastr.error("@lang('backend.Product ID Should Not Be Empty')");
                        return;
                    }

                    if ($('#photo').val() == '') {
                        toastr.error("@lang('backend.Photo Should Not Be Empty')");
                        return;
                    }
                    if ($('#color_id').val() == '') {
                        toastr.error("@lang('backend.Variation Color Should Not Be Empty')");
                        return;
                    }
                    if (sizeCount == 0) {
                        toastr.error("@lang('backend.At least one size should be added.')");
                        return;
                    }



                    var formData = new FormData();

                    formData.append('product_id', product_id.val());
                    formData.append('color_id', color_id.val());
                    formData.append('code_id', code_id.val());
                    formData.append('photo', $('#photo')[0].files[0]);
                    size.forEach((item, index) => {
                        Object.entries(item).forEach(([key, value]) => {
                            formData.append(`size[${index}][${key}]`, value);
                        });
                    });
                    weight.forEach((item, index) => {
                        Object.entries(item).forEach(([key, value]) => {
                            formData.append(`weight[${index}][${key}]`, value);
                        });
                    });

                    $.ajax({
                        type: "POST",
                        url: '{{ url('admin/product/variation') }}',
                        data: formData,
                        contentType: false,
                        processData: false,

                        success: function(data) {
                            $('#sizeTableData').find("tr").remove();
                            $('#weightTableData').find("tr").remove();
                            $('#photo').val('');
                            $('#productImage').attr('src', '../../../public/dumy.jpg');
                            $('.big-image').attr('src', '../../../public/dumy.jpg');

                            // Clear other form inputs for color and code
                            $('#color_id').val('');
                            $('#code_id').val('');
                            // Update the select2 display text for the color selection
                            var updatedColorText =
                                "Select Color From The Box"; // Replace with your dynamic color name if available
                            $('#select2-choosecolor-container').text(updatedColorText);
                            $('#select2-choosecolor-container').attr('title', updatedColorText);

                            toastr.success("@lang('backend.Variation added successfully')");

                            loadvariation(product_id.val());
                        }
                    });
                });

                $(document).on("click", "#updatevariation", function() {
                    var product_id = $("#product_id");
                    var variation_id = $("#variation_id");
                    var color_id = $("#editcolor_id");
                    var code_id = $("#editcode_id");

                    var size = [];
                    var sizeCount = 0;
                    $("#editsizeTable tbody tr").each(function(index, value) {
                        var currentRow = $(this);
                        var obj = {};
                        obj.sID = currentRow.find("#sID").val();
                        obj.sizeID = currentRow.find("#sizeID").val();
                        obj.size = currentRow.find("#size").val();
                        obj.RegularPrice = currentRow.find("#RegularPrice").val();
                        obj.Discount = currentRow.find("#Discount").val();
                        obj.Stock = currentRow.find("#Stock").val();
                        obj.buy_price = currentRow.find("#buy_price").val();
                        size.push(obj);
                        sizeCount++;
                    });

                    var weight = [];
                    var weightCount = 0;
                    $("#editweightTable tbody tr").each(function(index, value) {
                        var currentRow = $(this);
                        var obj = {};
                        obj.wID = currentRow.find("#wID").val();
                        obj.weightID = currentRow.find("#weightID").val();
                        obj.weight = currentRow.find("#weight").val();
                        obj.RegularPrice = currentRow.find("#RegularPrice").val();
                        obj.Discount = currentRow.find("#Discount").val();
                        obj.Stock = currentRow.find("#Stock").val();
                        weight.push(obj);
                        weightCount++;
                    });

                    if (variation_id.val() == '') {
                        toastr.error("@lang('backend.Product ID Should Not Be Empty')");
                        return;
                    }

                    var formData = new FormData();

                    formData.append('variation_id', variation_id.val());
                    formData.append('color_id', color_id.val());
                    formData.append('code_id', code_id.val());
                    size.forEach((item, index) => {
                        Object.entries(item).forEach(([key, value]) => {
                            formData.append(`size[${index}][${key}]`, value);
                        });
                    });
                    weight.forEach((item, index) => {
                        Object.entries(item).forEach(([key, value]) => {
                            formData.append(`weight[${index}][${key}]`, value);
                        });
                    });
                    // formData.append('photo', $('#editphoto')[0].files[0]);

                    // Handle multiple image upload for update
                    var photos = $('#editphoto')[0].files;
                    for (var i = 0; i < photos.length; i++) {
                        formData.append('photos[]', photos[i]); // Using 'photos[]' to handle multiple files
                    }


                    $.ajax({
                        type: "POST",
                        url: '{{ url('admin/product/variation-update') }}',
                        data: formData,
                        contentType: false,
                        processData: false,

                        success: function(data) {
                            $('#editsizeTableData').find("tr").remove();
                            $('#editweightTableData').find("tr").remove();
                            $('#photo').val('');
                            $('#productImageEdit').attr('src', '../../../public/dumy.jpg');
                            toastr.success("@lang('backend.Variation updated successfully')");
                            loadvariation(product_id.val());
                        }
                    });
                });

                //variation Details
                $(document).on('click', '#variationDetails', function() {
                    $variation_id = $(this).data('id');

                    $.ajax({
                        type: "GET",
                        url: "../variation/view/" + $variation_id,
                        success: function(res) {
                            $('#viewvariation').modal('show');
                            $('#viewvariationmodel').empty().append(res);
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });

                });

                //variation edit
                $(document).on('click', '#variationEdit', function(e) {
                    $variation_id = $(this).data('id');
                    $.ajax({
                        type: "GET",
                        url: "../variation/edit/" + $variation_id,
                        success: function(res) {
                            $('#editvariation').modal('show');
                            $('#editvariationmodel').empty().append(res);

                            $('#editchoosecolor').select2({
                                dropdownParent: $("#editcolorpart")
                            });
                            $('#editchoosecode').select2({
                                dropdownParent: $("#editcodepart")
                            });

                            $("#editsizevariantID").select2({
                                dropdownParent: $("#editsizeTable"),
                                placeholder: "@lang('backend.Select a Product Size')",
                                templateResult: function(state) {
                                    if (!state.id) {
                                        return state.text;
                                    }
                                    var $state = $(
                                        '<span>' +
                                        state.text +
                                        "</span>"
                                    );
                                    return $state;
                                },
                                ajax: {
                                    type: 'GET',
                                    url: '{{ url('admin/get/sizes') }}',
                                    processResults: function(data) {
                                        var data = $.parseJSON(data);
                                        return {
                                            results: data.data
                                        };
                                    }
                                }
                            }).trigger("change").on("select2:select", function(e) {
                                $("#editsizeTable tbody").append(
                                    "<tr>" +
                                    '<td><input type="text" id="sizeID" style="width:15px;border: none;color: black;" value="' +
                                    e.params.data.id + '" disabled></td>' +
                                    '<td><input type="text" name="size" id="size" style="width:45px;border: none;color: black;" value="' +
                                    e.params.data.text + '" disabled> </td>' +
                                    '<td><input type="text" name="RegularPrice" id="RegularPrice" class="form-control" style="width:80px;float:left;">  <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->c }}</span></td>' +
                                    '<td><input type="text" name="Discount" id="Discount" class="form-control" style="width:80px;float:left;"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->c }}</span></td>' +
                                    '<td><input type="text" name="Stock" id="Stock" class="form-control" style="width:80px;float:left;"> </td>' +
                                    '<td><input type="text" name="buy_price" id="buy_price" class="form-control" style="width:80px;float:left;" value="0"><span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span> </td>' +
                                    '<td><button type="button" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                                    "</tr>"
                                );
                            });

                            $("#editweightvariantID").select2({
                                dropdownParent: $("#editweightTable"),
                                placeholder: "@lang('backend.Select a Product Weight')",
                                templateResult: function(state) {
                                    if (!state.id) {
                                        return state.text;
                                    }
                                    var $state = $(
                                        '<span>' +
                                        state.text +
                                        "</span>"
                                    );
                                    return $state;
                                },
                                ajax: {
                                    type: 'GET',
                                    url: '{{ url('admin/get/weights') }}',
                                    processResults: function(data) {
                                        var data = $.parseJSON(data);
                                        return {
                                            results: data.data
                                        };
                                    }
                                }
                            }).trigger("change").on("select2:select", function(e) {
                                $("#editweightTable tbody").append(
                                    "<tr>" +
                                    '<td><input type="text" id="weightID" style="width:80px;border: none;color: black;" value="' +
                                    e
                                    .params.data.id + '" disabled></td>' +
                                    '<td><input type="text" name="weight" id="weight" style="width:80px;border: none;color: black;" value="' +
                                    e.params.data.text + '" disabled> </td>' +
                                    '<td><input type="text" name="RegularPrice" id="RegularPrice" class="form-control" style="width:80px;float:left;">  <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->c }}</span></td>' +
                                    '<td><input type="text" name="Discount" id="Discount" class="form-control" style="width:80px;float:left;"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->c }}</span></td>' +
                                    '<td><input type="text" name="Stock" id="Stock" class="form-control" style="width:80px;float:left;"> </td>' +
                                    '<td><button type="button" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                                    "</tr>"
                                );
                            });
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });


                });


                $(document).on('click', '.confirmDelete', function(e) {
                    e.preventDefault();
                    let variation_id = $(this).data('id');

                    Swal.fire({
                        title: "@lang('backend.Are you sure?')",
                        text: "@lang('backend.You won\'t be able to revert this!')",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "@lang('backend.Yes, delete it!')",
                        cancelButtonText: "@lang('backend.No, cancel!')",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "DELETE",
                                url: "../veriation-destroy/" + variation_id,
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(res) {
                                    if (res.status == 'success') {
                                        Swal.fire({
                                            title: "@lang('backend.Deleted!')!",
                                            text: "@lang('backend.Your file has been deleted.')",
                                            icon: "success"
                                        });
                                        var product_id = $("#product_id");
                                        loadvariation(product_id.val());
                                    }
                                },
                                error: function(err) {
                                    console.log('err');
                                }
                            });

                        }
                    });
                });

                $("#sizevariantID").select2({
                    placeholder: "@lang('backend.Select a Product Size')",
                    templateResult: function(state) {
                        if (!state.id) {
                            return state.text;
                        }
                        var $state = $(
                            '<span>' +
                            state.text +
                            "</span>"
                        );
                        return $state;
                    },
                    ajax: {
                        type: 'GET',
                        url: '{{ url('admin/get/sizes') }}',
                        processResults: function(data) {
                            var data = $.parseJSON(data);
                            return {
                                results: data.data
                            };
                        }
                    }
                }).trigger("change").on("select2:select", function(e) {
                    $("#sizeTable tbody").append(
                        "<tr>" +
                        '<td><input type="text" id="sizeID" style="width:15px;border: none;color: black;" value="' +
                        e.params.data.id + '" disabled></td>' +
                        '<td><input type="text" name="size" id="size" style="width:45px;border: none;color: black;" value="' +
                        e.params.data.text + '" disabled> </td>' +
                        '<td><input type="text" name="RegularPrice" id="RegularPrice" class="form-control" style="width:80px;float:left;">  <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></td>' +
                        '<td><input type="text" name="Discount" id="Discount" class="form-control" style="width:80px;float:left;"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></td>' +
                        '<td><input type="text" name="Stock" id="Stock" class="form-control" style="width:80px;float:left;"> </td>' +
                        '<td><input type="text" name="buy_price" id="buy_price" class="form-control" style="width:80px;float:left;" value="0"><span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span> </td>' +
                        '<td><button type="button" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                        "</tr>"
                    );
                });

                $("#weightvariantID").select2({
                    placeholder: "@lang('backend.Select a Product Weight')",
                    templateResult: function(state) {
                        if (!state.id) {
                            return state.text;
                        }
                        var $state = $(
                            '<span>' +
                            state.text +
                            "</span>"
                        );
                        return $state;
                    },
                    ajax: {
                        type: 'GET',
                        url: '{{ url('admin/get/weights') }}',
                        processResults: function(data) {
                            var data = $.parseJSON(data);
                            return {
                                results: data.data
                            };
                        }
                    }
                }).trigger("change").on("select2:select", function(e) {
                    $("#weightTable tbody").append(
                        "<tr>" +
                        '<td><input type="text" id="weightID" style="width:80px;border: none;color: black;" value="' +
                        e
                        .params.data.id + '" disabled></td>' +
                        '<td><input type="text" name="weight" id="weight" style="width:80px;border: none;color: black;" value="' +
                        e.params.data.text + '" disabled> </td>' +
                        '<td><input type="text" name="RegularPrice" id="RegularPrice" class="form-control" style="width:80px;float:left;">  <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></td>' +
                        '<td><input type="text" name="Discount" id="Discount" class="form-control" style="width:80px;float:left;"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span></td>' +
                        '<td><input type="text" name="Stock" id="Stock" class="form-control" style="width:80px;float:left;"> </td>' +
                        '<td><button type="button" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>\n' +
                        "</tr>"
                    );
                });

                $(document).on("click", ".delete-btn", function() {
                    $(this).closest("tr").remove();
                });


            });

            function loadvariation(id) {
                $.ajax({
                    type: 'GET',
                    url: '../../../admin/product/load-variation',
                    data: {
                        product_id: id,
                    },

                    success: function(response) {
                        $('#variationpart').empty().append(response)
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            }

            function setsubcategory() {
                var sub_id = $('#category_id').val();
                $.ajax({
                    type: 'GET',
                    url: '../../get/subcategory/' + sub_id,

                    success: function(data) {
                        $('#sub_category_id').html('');

                        for (var i = 0; i < data.length; i++) {
                            $('#sub_category_id').append(`
                            <option value="` + data[i].id + `" >` + data[i].name + `</option>
                        `)
                        }
                        setchildcategory();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            }

            function setchildcategory() {
                var sub_category_id = $('#sub_category_id').val();
                $.ajax({
                    type: 'GET',
                    url: '../../get/childcategory/' + sub_category_id,

                    success: function(data) {
                        $('#child_category_id').html('');

                        for (var i = 0; i < data.length; i++) {
                            $('#child_category_id').append(`
                            <option value="` + data[i].id + `" >` + data[i].name + `</option>
                        `)
                        }
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            }


            // var loadFile = function(event) {
            //     var output = document.getElementById('productImage');
            //     console.log(output, event);
            //     output.src = URL.createObjectURL(event.target.files[0]);
            //     output.onload = function() {
            //         URL.revokeObjectURL(output.src) // free memory
            //     }
            // };

            var loadFile = function(event) {
                var files = event.target.files;
                var imagePreviewContainer = document.getElementById('productImage');

                // Clear previous image and previews
                imagePreviewContainer.innerHTML = '';

                // Loop through selected files and display each image
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    let img = document.createElement('img');
                    img.classList.add('big-image'); // Add class for styling
                    img.style.width = '100px'; // Adjust size as needed
                    img.style.margin = '5px';
                    img.src = URL.createObjectURL(file);

                    img.onload = function() {
                        URL.revokeObjectURL(img.src); // Free memory
                    };

                    imagePreviewContainer.appendChild(img);
                }
            };

            // var loadFileEdit = function(event) {
            //     var output = document.getElementById('productImageEdit');
            //     console.log(output, event);
            //     output.src = URL.createObjectURL(event.target.files[0]);
            //     output.onload = function() {
            //         URL.revokeObjectURL(output.src) // free memory
            //     }
            // };

            var loadFileEdit = function(event) {
                var files = event.target.files;
                var imagePreviewContainerEdit = document.getElementById(
                    'productImageEdit'); // Assuming a container for edit previews

                // Clear previous image previews
                imagePreviewContainerEdit.innerHTML = '';

                // Loop through selected files and display each image
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    let img = document.createElement('img');
                    img.classList.add('big-image'); // Add class for styling
                    img.style.width = '100px'; // Adjust size as needed
                    img.style.margin = '5px';
                    img.src = URL.createObjectURL(file);

                    img.onload = function() {
                        URL.revokeObjectURL(img.src); // Free memory
                    };

                    // Append each image to the container
                    imagePreviewContainerEdit.appendChild(img);
                }
            };


            var loadMeta = function(event) {
                var output = document.getElementById('metaimage');
                console.log(output, event);
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };

            function setcode(id) {
                $('.extra-large').css('background', '#EEEEEE');
                var id = $('#choosecode').val();
                $('#var' + id).css('background', '#9bbeff');
                $('#code_id').val(id);
            }

            function setcolor() {
                $('.extra-color').css('background', '#EEEEEE');
                var id = $('#choosecolor').val();
                $('#var' + id).css('background', '#9bbeff');
                $('#color_id').val(id);
            }

            function editsetcode(id) {
                var id = $('#editchoosecode').val();
                $('#editcode_id').val(id);
                console.log(id);
            }

            function editsetcolor() {
                var id = $('#editchoosecolor').val();
                $('#editcolor_id').val(id);
                console.log(id);
            }
        </script>
    @endpush
@endsection
