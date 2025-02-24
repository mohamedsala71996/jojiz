<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-information" role="tabpanel" aria-labelledby="pills-information-tab">
        <div class="card">
            <div class="add-top-header">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="add-header-content pills-header">

                                    <h5>@lang('backend.Product Information')</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body custom-card-body Product-body">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="product-input">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="general-main">
                                        <div class="general-text">

                                            <h5>@lang('backend.General Information')
                                            </h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group general-form mb-3">

                                                    <label for="floatingInput">@lang('backend.Product Name')
                                                        <span style="color: red">*</span></label>
                                                    <input type="text" class="form-control" name="product_name"
                                                        id="product_name" placeholder="@lang('backend.Product Name')"
                                                        value="{{ $product->product_name }}" required="" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group general-form mb-3">

                                                    <label for="floatingInput">@lang('backend.Product Sku')
                                                        <span style="color: red"></span></label>
                                                    <input type="text" class="form-control" name="product_sku"
                                                        id="product_sku" placeholder="@lang('backend.Product Sku')"
                                                        value="{{ $product->product_sku }}" required="" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="size-part">
                                                    <div class="form-group general-form category-form mb-3">
                                                        <label for="floatingInput">@lang('backend.Product Category')
                                                            <span style="color: red">*</span></label>
                                                        <select name="category_id" id="category_id"
                                                            onchange="setsubcategory()" class="form-control">

                                                            @lang('backend.Select Category')
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    @if ($product->category_id == $category->id) selected @endif>
                                                                    {{ $category->category_name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="size-part">
                                                    <div class="form-group general-form category-form mb-3">

                                                        <label for="floatingInput">@lang('backend.Product Sub-Category')
                                                            <span style="color: red">*</span></label>
                                                        <select name="sub_category_id" id="sub_category_id"
                                                            onchange="setchildcategory()" class="form-control">
                                                            @if (isset($product->sub_category_id))
                                                                <option value="{{ $product->sub_category_id }}">
                                                                    {{ App\Models\Admin\SubCategory::where('id', $product->sub_category_id)->first()->name }}
                                                                </option>
                                                            @else
                                                                <option value="">

                                                                    @lang('backend.Select Sub-Category')
                                                                </option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="size-part">
                                                    <div class="form-group general-form category-form mb-3">

                                                        <label for="floatingInput">@lang('backend.Product Child-Category')
                                                        </label>
                                                        <select name="child_category_id" id="child_category_id"
                                                            class="form-control">
                                                            @if (isset($product->child_category_id))
                                                                <option value="{{ $product->child_category_id }}">
                                                                    {{ App\Models\Admin\ChildCategory::where('id', $product->child_category_id)->first()->name }}
                                                                </option>
                                                            @else
                                                                <option value="">

                                                                    @lang('backend.Select Child-Category')

                                                                </option>
                                                            @endif

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="size-part">
                                                    <div class="form-group general-form category-form mb-3">

                                                        <label for="floatingInput">@lang('backend.Choose Brand')
                                                        </label>
                                                        <select name="brand_id" id="brand_id" class="form-control">
                                                            <option value="">
                                                                @lang('backend.Select Brand')
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

                                        <div class="form-group general-form mb-3">

                                            <label for="floatingInput">@lang('backend.Description Product')

                                                <span style="color: red; height: 150px;">*</span></label>
                                            <textarea rows="3" style="padding-bottom: 70px;height:80px padding-top:20px;" class="form-control"
                                                name="product_description" id="product_description" required="">{{ $product->product_description }}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-4 ">
                                                <div class="row">

                                                    <div class="gender-part">
                                                        <div class="col-lg-6">
                                                            <div class="size-part ">
                                                                <div class="form-group">

                                                                    <label>@lang('backend.Gender')
                                                                    </label>
                                                                    <p>@lang('backend.Pick Available Gender')
                                                                    </p>
                                                                    <div class="col-12 row">
                                                                        <div class="genter-input">
                                                                            <div
                                                                                class="form-check form-check-inline mt-3">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio"
                                                                                        class="form-check-input"
                                                                                        name="gander" id="medium_1"
                                                                                        value="Men"
                                                                                        @if ($product->gander == 'Men') Checked @endif />

                                                                                    @lang('backend.Men')

                                                                                    <i
                                                                                        class="input-helper"></i></label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio"
                                                                                        class="form-check-input"
                                                                                        name="gander" id="medium_2"
                                                                                        value="Women"
                                                                                        @if ($product->gander == 'Women') Checked @endif />

                                                                                    @lang('backend.Women')
                                                                                    <i
                                                                                        class="input-helper"></i></label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio"
                                                                                        class="form-check-input"
                                                                                        name="gander" id="medium_3"
                                                                                        value="Unisex"
                                                                                        @if ($product->gander == 'Unisex') Checked @endif />

                                                                                    @lang('backend.Unisex')

                                                                                    <i
                                                                                        class="input-helper"></i></label>
                                                                            </div>
                                                                            <input type="hidden" name="product_id"
                                                                                id="product_id"
                                                                                value="{{ $product->id }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">

                                                            <label for="">@lang('backend.Select Status')</label>
                                                            <select name="status" id="status"
                                                                class="form-control">
                                                                <option value="Active"
                                                                    @if ($product->status == 'Active') selected @endif>

                                                                    @lang('backend.Active')
                                                                </option>
                                                                <option value="Inactive"
                                                                    @if ($product->status == 'Inactive') selected @endif>
                                                                    @lang('backend.Inactive')
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">

                                                            <label for="">@lang('backend.Select Type')</label>
                                                            <select name="type" id="type"
                                                                class="form-control">
                                                                <option value="new_arrival"
                                                                    @if ($product->type == 'new_arrival') selected @endif>

                                                                    @lang('backend.New Arrival')

                                                                </option>

                                                                <option value="flash_sale"
                                                                    @if ($product->type == 'flash_sale') selected @endif>

                                                                    @lang('backend.Flash Sale')
                                                                </option>

                                                                <option value="trending"
                                                                    @if ($product->type == 'trending') selected @endif>

                                                                    @lang('backend.Trending')
                                                                </option>
                                                                <option value="feature"
                                                                    @if ($product->type == 'feature') selected @endif>
                                                                    @lang('backend.Feature')
                                                                </option>
                                                                <option value="special_offer"
                                                                    @if ($product->type == 'special_offer') selected @endif>
                                                                    @lang('backend.Special Offer')
                                                                </option>
                                                            </select>


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
            <div class="next-button pb-4">
                <div class="save-text">
                    <button type="button" id="submit" class="btn btn-success"><i
                            class="fa-solid fa-check mr-2"></i>@lang('backend.Update')
                    </button>

                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-variation" role="tabpanel" aria-labelledby="pills-variation-tab">
        <div class="top-header-main">
            <div class="add-top-header">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="add-header-content pills-header">

                                    <h5>@lang('backend.Product Variation')</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="variation-part">
                        <div class="table-responsive">
                            <table class="table header-border">
                                <thead>
                                    <tr>
                                        <th>@lang('backend.ID')</th>
                                        <th> @lang('backend.Image')</th>
                                        <th>@lang('backend.Color')</th>
                                        <th>@lang('backend.Code')</th>
                                        <th>@lang('backend.Size')</th>

                                        <th>@lang('backend.Status')</th>
                                        <th>@lang('backend.Action')</th>
                                    </tr>
                                </thead>
                                <tbody id="variationpart">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="upload-product">
                        <div class="row ">
                            <div class="col-lg-12 border-round">

                                <h5>@lang('backend.Uploading Image')</h5>

                                <div class="modal-product-image" id="imagePreviewContainer">
                                    <img src="../../../public/dumy.jpg" class="big-image" id="productImage"
                                        xoriginal="../../../public/dumy.jpg" style="visibility: visible;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="xzoom-thumbs">
                                    <div class="row">
                                        <div class="col-lg-12 col-4">
                                            <div id="imagePreviewContainer" class="modal-product-image4">
                                                <i class="fa fa-plus plus"></i>
                                                <input type="file" class="form-control" onchange="loadFile(event)"
                                                    name="photos[]" id="photo" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-0">

                    <div class="pricing-part pricing-pb mt-0">
                        <div class="pricing-part2">
                            <h5><a type="button" id="addvarition" style="color:white">@lang('backend.Add Variation')</a></h5>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="size-part">
                                    <h5>@lang('backend.Color')</h5>
                                    <p class="m-0">
                                        @lang('backend.Pick Available Color')</p>
                                    <input type="hidden" name="color_id" id="color_id" class="form-control">
                                    <div class="size-input d-flex justify-content-between pt-2">

                                        <div class="form-group">
                                            <select name="color" id="choosecolor" onchange="setcolor()"
                                                class="form-control" style="width: 230px;">
                                                <option value="">
                                                    @lang('backend.Select Color From The Box')
                                                </option>
                                                @forelse (App\Models\ProductAttribute::where('value',1)->get() as $color)
                                                    <option style="color:{{ $color->name }}"
                                                        value="{{ $color->id }}">
                                                        {{ $color->name }}
                                                    </option>
                                                @empty
                                                    <option value="">
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
                                    <h5>@lang('backend.Code')</h5>
                                    <p class="m-0">
                                        @lang('backend.Pick Available Code')</p>
                                    <input type="hidden" name="code_id" id="code_id" class="form-control">
                                    <div class="size-input d-flex justify-content-between pt-2">
                                        <select name="code" id="choosecode" onchange="setcode()"
                                            class="form-control" style="width: 230px;">
                                            <option value="">
                                                @lang('backend.Select Product Code From The Box')
                                            </option>
                                            @forelse (App\Models\ProductAttribute::where('value',4)->get() as $code)
                                                <option value="{{ $code->id }}">
                                                    {{ $code->name }}
                                                </option>
                                            @empty
                                                <option value="">
                                                    @lang('frontend.No Data Found !')
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <div class="card">
                                    <div class="card-header p-0" id="headingOne">
                                        <h5 class="mb-0">
                                            <button
                                                style="display: flex;justify-content: space-between;width: 100%;text-decoration: none;"
                                                type="button" id="collupshead" class="btn btn-link"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSize"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                <h5 class="text-uppercase m-0">
                                                    @lang('backend.Product Size')
                                                </h5>
                                                <h5 class="text-uppercase m-0">
                                                    +
                                                </h5>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseSize" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body custom-card-body" style="padding: 10px;">
                                            <div class="table-responsive">
                                                <table id="sizeTable" style="width: 100% !important;margin:0px"
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
                                                            <th>@lang('backend.Buy Price')
                                                            </th>
                                                            <th>
                                                                @lang('backend.Action')
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="sizeTableData">
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="12">
                                                                <select id="sizevariantID" style="width: 100%;">
                                                                    <option value="">
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
    <div class="tab-pane fade" id="pills-shipping" role="tabpanel" aria-labelledby="pills-shipping-tab">
        <div class="modal-body">
            <div class="row">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group general-form mb-3">
                            <label for="floatingInput">Advance Payment</label>
                            <input type="number" class="form-control" name="advance_payment_amount"
                                id="advance_payment_amount" placeholder="Advance Payment Amount"
                                value="{{ $product->advance_payment_amount }}" />
                            <small id="emailHelp" class="form-text text-muted">@lang('backend.You can collect advance payment product wise.')</small>


                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="size-part">
                            <div class="form-group general-form category-form mb-3">
                                <label for="floatingInput">@lang('backend.Choose Supplier')
                                </label>
                                <select name="supplier" id="supplier" class="form-control">
                                    <option value="">
                                        @lang('backend.Select Brand')
                                    </option>
                                    @foreach ($suppliers as $supplier)
                                        <option @if ($supplier->id == $product->supplier_id) selected @endif
                                            value="{{ $supplier->id }}">
                                            {{ $supplier->supplierName }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                @lang('backend.Shipping & Return')
                            </h5>
                        </div>
                        <div class="card-body custom-card-body student-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>@lang('backend.Shipping Type')
                                        </label>
                                        <div class="col-12 d-flex row">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="shipping_type" id="medium_1" value="Free"
                                                        @if ($product->shipping_type == 'Free') checked @endif />
                                                    @lang('backend.Free')
                                                    <i class="input-helper"></i></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="shipping_type" id="medium_2" value="Flat Sale"
                                                        @if ($product->shipping_type == 'Flat Sale') checked @endif />
                                                    @lang('backend.Flat Sale')
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group general-form mb-3">
                                        <label for="floatingInput">@lang('backend.Shipping Cost')
                                        </label>
                                        <input type="number" class="form-control" name="shippig_cost"
                                            id="shippig_cost" placeholder="@lang('backend.Cost')" required=""
                                            value="{{ $product->shipping_cost }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">@lang('backend.Shipping & Return')</label>
                                    <div class="shipping-return-part">
                                        <section id="description"
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
        <div class="next-button">
            <div class="save-text">
                <button type="button" id="submit" class="btn btn-success"><i
                        class="fa-solid fa-check mr-2"></i>@lang('backend.Update')
                </button>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-offer" role="tabpanel" aria-labelledby="pills-offer-tab">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                @lang('backend.Offers')
                            </h5>
                        </div>
                        <div class="card-body custom-card-body student-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group general-form mb-3">
                                        <label for="floatingInput">@lang('backend.Offer Start Date')
                                        </label>
                                        <input type="date" class="form-control" name="offer_start"
                                            id="offer_start" placeholder="@lang('backend.Offer Start Date')" required=""
                                            value="{{ $product->offer_start }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group general-form mb-3">
                                        <label for="floatingInput">@lang('backend.Offer End Date')
                                        </label>
                                        <input type="date" class="form-control" name="offer_end" id="offer_end"
                                            placeholder="@lang('backend.Offer End Date')" required=""
                                            value="{{ $product->offer_end }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group general-form mb-3">
                                        <label for="floatingInput">@lang('backend.Discount Percentage')
                                        </label>
                                        <input type="number" class="form-control" name="discount_percent"
                                            id="discount_percent" placeholder="@lang('backend.Discount Percentage')" required=""
                                            value="{{ $product->discount_percent }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>@lang('backend.Is Product Quantity Multiply')
                                        </label>
                                        <div class="col-12 d-flex row">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="multiple_qty" id="medium_1" value="Yes"
                                                        @if ($product->multiple_qty == 'Yes') checked @endif />
                                                    @lang('backend.Yes')
                                                    <i class="input-helper"></i></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input"
                                                        name="multiple_qty" id="medium_2" value="No"
                                                        @if ($product->multiple_qty == 'No') checked @endif />
                                                    @lang('backend.No')
                                                    <i class="input-helper"></i></label>
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
        <div class="next-button">
            <div class="save-text">
                <button type="button" id="submit" class="btn btn-success"><i
                        class="fa-solid fa-check mr-2"></i>@lang('backend.Update')
                </button>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="modal-header">
                        <div class="form-group general-form w-100">
                            <label for="">@lang('backend.Video')</label>
                            <input type="text" class="form-control" value="{{ $product->youtube_embadecode }}"
                                name="youtube_embadecode" id="youtube_embadecode">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="next-button">
            <div class="save-text">
                <button type="button" id="submit" class="btn btn-success"><i
                        class="fa-solid fa-check mr-2"></i>@lang('backend.Update')
                </button>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-seo" role="tabpanel" aria-labelledby="pills-seo-tab">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                @lang('backend.SEO')
                            </h5>
                        </div>
                        <div class="card-body custom-card-body student-body">

                            <div class="row">
                                <div class="col-lg-6 text-center">
                                    <img @if (isset($product->meta_image)) src="{{ asset($product->meta_image) }}" @else src="{{ asset('public/dumy.jpg') }}" @endif
                                        alt="" id="metaimage" width="200PX">
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group general-form mb-3">
                                        <label for="floatingInput">@lang('backend.Meta Imgae')
                                        </label>
                                        <input type="file" name="meta_image" id="meta_image"
                                            onchange="loadMeta(event)" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group general-form mb-3">
                                        <label for="floatingInput">@lang('backend.Meta Name')
                                        </label>
                                        <input type="text" class="form-control" name="meta_name" id="meta_name"
                                            placeholder="@lang('backend.name')" value="{{ $product->meta_name }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group general-form mb-3">
                                        <label for="floatingInput">@lang('backend.Meta Title')
                                        </label>
                                        <input type="text" class="form-control" name="meta_title" id="meta_title"
                                            placeholder="@lang('backend.Title')" value="{{ $product->meta_title }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group general-form mb-3">
                                        <label for="floatingInput">@lang('backend.Meta Keywords')
                                        </label>
                                        <textarea class="form-control" rows="2" name="meta_keywords" id="meta_keywords">{{ $product->meta_keywords }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group general-form mb-3">
                                        <label for="floatingInput">@lang('backend.Meta Description')
                                        </label>
                                        <textarea class="form-control" rows="2" name="meta_description" id="meta_description">{{ $product->meta_description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="next-button">
            <div class="save-text">
                <button type="button" id="submit" class="btn btn-success"><i
                        class="fa-solid fa-check mr-2"></i>@lang('backend.Update')
                </button>
            </div>
        </div>
    </div>
</div>
