<div class="card">
    <div class="add-top-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="add-header-content">
                            <h4>@lang('backend.View Variation')</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="upload-product">
                    <div class="row ">
                        <div class="col-lg-12 border-round">
                            <h5>@lang('backend.Images')</h5>
                            <div class="modal-product-image">
                                @foreach ($variations->productvariationimages as $item)
                                    <img src="{{ asset($item->image_path) }}" style="width: 60px;margin-right:5px"
                                        class="big-image" id="productImageEdit" xoriginal=""
                                        style="visibility: visible;">
                                @endforeach

                            </div>

                        </div>
                    </div>

                </div>
            </div>
            {{-- <div class="col-lg-8">

                <div class="d-flex justify-content-between">
                    <h5 class="modal-title card-title">
                        View Variation
                    </h5>
                    <div class="variation-save-text" style="padding-right: 20px;">

                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="card-body custom-card-body">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="size-part" id="viewcolorpart">
                    <h5>@lang('backend.Color')</h5>
                    <p class="m-0">
                        @lang('backend.Pick Available Color')</p>
                    <input type="hidden" name="color_id" id="viewcolor_id" class="form-control"
                        value="{{ $variations->color_id }}">
                    <div class="size-input d-flex justify-content-between pt-2">

                        <div class="form-group">
                            <select name="color" id="viewchoosecolor" onchange="viewsetcolor()" class="form-control"
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
                <div class="size-part" id="viewcodepart">
                    <h5>@lang('backend.Product Code')</h5>
                    <p class="m-0">
                        @lang('backend.Pick Product Code')</p>
                    <input type="hidden" name="code_id" id="viewcode_id" class="form-control"
                        value="{{ $variations->code_id }}">
                    <div class="size-input d-flex justify-content-between pt-2">
                        <select name="code" id="viewchoosecode" onchange="viewsetcode()" class="form-control"
                            style="width: 230px;">
                            <option value="">
                                @lang('backend.Select Product Code From The Box')
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

                    <div id="collapseSize" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body custom-card-body">
                            <div class="table-responsive">
                                <table id="viewsizeTable" style="width: 100% !important;margin:0px"
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
                                    <tbody id="viewsizeTableData">
                                        @foreach ($sizes as $size)
                                            <tr>
                                                <td><input type="hidden" id="sID" value="{{ $size->id }}">
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
                                                    <div class="d-flex"><input type="text" name="Discount"
                                                            value="{{ $size->Discount }}" id="Discount"
                                                            class="form-control" style="width:80px;float:left;"> <span
                                                            id="taka"
                                                            style="line-height: 40px;padding-left: 4px;">{{ $currency->symbol }}</span>
                                                    </div>
                                                </td>
                                                <td><input type="text" name="Stock" value="{{ $size->stock }}"
                                                        id="Stock" class="form-control"
                                                        style="width:80px;float:left;"></td>
                                                <td><button type="button" class="btn btn-sm btn-danger delete-btn"><i
                                                            class="fa fa-trash"></i></button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>

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
                                id="viewweightTable"
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
                                <tbody id="viewweightTableData">
                                    @foreach ($weights as $weight)
                                        <tr>
                                            <td><input type="hidden" id="wID" value="{{ $weight->id }}">
                                            <input type="text" id="weightID" style="width:20px;border: none;color: black;" value="{{ $weight->weight_id }}" disabled></td>
                                            <td><input type="text" name="width" id="weight" style="width:80px;border: none;color: black;" value="{{ $weight->weight }}" disabled> </td>
                                            <td><input type="text" name="RegularPrice" value="{{ $weight->RegularPrice }}" id="RegularPrice" class="form-control" style="width:80px;float:left;"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{$currency->symbol}}</span></td>
                                            <td><input type="text" name="Discount" value="{{ $weight->Discount }}" id="Discount" class="form-control" style="width:80px;float:left;"> <span id="taka" style="line-height: 40px;padding-left: 4px;">{{$currency->symbol}}</span></td>
                                            <td><input type="text" name="Stock" value="{{ $weight->stock }}" id="Stock" class="form-control" style="width:80px;float:left;"></td>
                                            <td><button type="button" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-trash"></i></button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>

                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
</div>
