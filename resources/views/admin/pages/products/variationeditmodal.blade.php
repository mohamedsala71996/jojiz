<div class="card">
    <div class="add-top-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="add-header-content">
                            <h4>@lang('backend.Edit Variation')</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="variation_id" value="{{ $variations->id }}" id="variation_id">

    <div class="product-header">
        <div class="row">
            <div class="col-lg-10">
                <div class="upload-product">
                    <div class="row ">
                        <div class="col-lg-12 border-round">
                            <h5>@lang('backend.Uploading Image') </h5>

                            <div class="modal-product-image" id="editImagePreviewContainer">
                                @foreach ($variations->productvariationimages as $item)
                                    {{-- <img style="width: 100px; margin-right-5px" src="{{ asset($item->image_path) }}" class="big-image" id="productImageEdit"
                                        xoriginal="" style="visibility: visible;"> --}}

                                    <div style="position: relative; display: inline-block;"
                                        id="image-{{ $item->id }}">
                                        <!-- Image -->
                                        <img style="width: 150px; border-radius: 8px;"
                                            src="{{ asset($item->image_path) }}" class="big-image"
                                            id="productImageEdit-{{ $item->id }}">

                                        <!-- Delete Button (Cross) -->
                                        <button class="delete-button"
                                            style="position: absolute; top: 8px; right: 8px; background-color: red; color: white; border: none; border-radius: 50%; width: 25px; height: 25px; cursor: pointer; font-size: 18px; display: flex; align-items: center; justify-content: center;"
                                            onclick="variationImageRemove('{{ $item->id }}', this)">
                                            &times;
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="xzoom-thumbs">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="modal-product-image4" id="editImagePreviewContainer">
                                            <i class="fa fa-plus plus"></i>
                                            <input type="file" class="form-control" onchange="loadFileEdit(event)"
                                                name="photos[]" id="editphoto" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="d-flex justify-content-between">

                    <div class="variation-save-text" style="padding-right: 20px;">
                        <button type="button" class="btn btn-info" id="updatevariation"><i
                                class="fa-solid fa-check mr-2" id="update_variation"></i>@lang('backend.Update')

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body custom-card-body">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="size-part" id="editcolorpart">
                    <h5>Color</h5>
                    <p class="m-0">
                        @lang('backend.Pick Available Color')</p>
                    <input type="hidden" name="color_id" id="editcolor_id" class="form-control"
                        value="{{ $variations->color_id }}">
                    <div class="size-input d-flex justify-content-between pt-2">

                        <div class="form-group">
                            <select name="color" id="editchoosecolor" onchange="editsetcolor()" class="form-control"
                                style="width: 230px;">
                                <option value="">
                                    @lang('backend.Select Color From The Box')
                                </option>
                                @forelse (App\Models\ProductAttribute::where('value',1)->get() as $color)
                                    <option @if ($variations->color_id == $color->id) selected @endif
                                        style="color:{{ $color->name }}" value="{{ $color->id }}">
                                        {{ $color->name }}
                                    </option>
                                @empty
                                    <option value="">
                                        @lang('backend.Not Found!')
                                    </option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="size-part" id="editcodepart">
                    <h5>Code</h5>
                    <p class="m-0">
                        @lang('backend.Pick Product Code')</p>
                    <input type="hidden" name="code_id" id="editcode_id" class="form-control"
                        value="{{ $variations->code_id }}">
                    <div class="size-input d-flex justify-content-between pt-2">
                        <select name="code" id="editchoosecode" onchange="editsetcode()" class="form-control"
                            style="width: 230px;">
                            <option value="">
                                @lang('backend.Select Color From The Box')
                            </option>
                            @forelse (App\Models\ProductAttribute::where('value',4)->get() as $code)
                                <option @if ($variations->code_id == $code->id) selected @endif value="{{ $code->id }}">
                                    {{ $code->name }}
                                </option>
                            @empty
                                <option value="">
                                    @lang('backend.Not Found!')
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
                                type="button" id="collupshead" class="btn btn-link" data-bs-toggle="collapse"
                                data-bs-target="#collapseSize" aria-expanded="true" aria-controls="collapseOne">
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
                                <table id="editsizeTable" style="width: 100% !important;margin:0px"
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
                                    <tbody id="editsizeTableData">
                                        @foreach ($sizes as $size)
                                            <tr>
                                                <td><input type="hidden" id="sID"
                                                        value="{{ $size->id }}">
                                                    <input type="text" id="sizeID"
                                                        style="width:20px;border: none;color: black;"
                                                        value="{{ $size->size_id }}" disabled>
                                                </td>
                                                <td><input type="text" name="size" id="size"
                                                        style="width:80px;border: none;color: black;"
                                                        value="{{ $size->size }}" disabled> </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <input type="text" name="RegularPrice"
                                                            value="{{ $size->RegularPrice }}" id="RegularPrice"
                                                            class="form-control" style="width:80px;float:left;"> <span
                                                            id="taka"
                                                            style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <input type="text" name="Discount"
                                                            value="{{ $size->Discount }}" id="Discount"
                                                            class="form-control" style="width:80px;float:left;"> <span
                                                            id="taka"
                                                            style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span>
                                                    </div>
                                                </td>
                                                <td><input type="text" name="Stock" value="{{ $size->stock }}"
                                                        id="Stock" class="form-control"
                                                        style="width:80px;float:left;"></td>
                                                <td>
                                                    <div class="d-flex"><input type="text" name="buy_price"
                                                            value="{{ $size->buy_price }}" id="buy_price"
                                                            class="form-control" style="width:80px;float:left;"><span
                                                            id="taka"
                                                            style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span>
                                                    </div>
                                                </td>
                                                <td><button type="button" data-id="{{ $size->id }}"
                                                        class="btn btn-sm btn-danger delete-btnsize"><i
                                                            class="fa fa-trash"></i></button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6">
                                                <select id="editsizevariantID" style="width: 100%;">
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
                                id="editweightTable"
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
                                <tbody id="editweightTableData">
                                    @foreach ($weights as $weight)
                                        <tr>
                                            <td><input type="hidden" id="wID" value="{{ $weight->id }}">
                                            <input type="text" id="weightID" style="width:20px;border: none;color: black;" value="{{ $weight->weight_id }}" disabled></td>
                                            <td><input type="text" name="width" id="weight" style="width:80px;border: none;color: black;" value="{{ $weight->weight }}" disabled> </td>
                                            <td><input type="text" name="RegularPrice" value="{{ $weight->RegularPrice }}" id="RegularPrice" class="form-control" style="width:80px;float:left;"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{$currency->symbol}}</span></td>
                                            <td><input type="text" name="Discount" value="{{ $weight->Discount }}" id="Discount" class="form-control" style="width:80px;float:left;"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{$currency->symbol}}</span></td>
                                            <td><input type="text" name="Stock" value="{{ $weight->stock }}" id="Stock" class="form-control" style="width:80px;float:left;"></td>
                                            <td><button type="button" data-id="{{$weight->id}}" class="btn btn-sm btn-danger delete-btnweight"><i class="fa fa-trash"></i></button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td
                                            colspan="6">
                                            <select
                                                id="editweightvariantID"
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
