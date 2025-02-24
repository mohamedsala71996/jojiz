@extends('admin.layouts.master')

@section('admin_content')
    <div class="modal-body product-details product-info-body">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">
                @lang('backend.Product Details')
            </h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="order-card">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="order-body">
                                                <h5>@lang('backend.Order ID'): <Span>{{ $order->invoiceID }}</Span></h5>
                                                <h6>{{ $order->status }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="customer-info">
                                    <h4>@lang('backend.Customer Info'):</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>@lang('backend.User Name'): </h5>
                                            <h5>@lang('backend.Name'): </h5>
                                            <h5>@lang('backend.Email'): </h5>
                                            <h5>@lang('backend.Phone'): </h5>
                                            <h5>@lang('backend.Country'): </h5>
                                            <h5>@lang('backend.Status'): </h5>
                                            <h5>@lang('backend.City'): </h5>
                                            <h5>@lang('backend.Address'): </h5>
                                            <h5>@lang('backend.Zip Code'): </h5>

                                        </div>
                                        <div class="col-lg-6">
                                            <h5><span>{{ $order->name }}</span></h5>
                                            <h5><span>{{ $order->name }}</span></h5>
                                            <h5><span>{{ $order->email }}</span></h5>
                                            <h5><span>{{ $order->phone }}</span></h5>
                                            <h5><span>{{ $order->country }}</span></h5>
                                            <h5><span>{{ $order->state }}</span></h5>
                                            <h5><span>{{ $order->city }}</span></h5>
                                            <h5><span>{{ $order->address }}</span></h5>
                                            <h5><span>{{ $order->zip_code }}</span></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="customer-info">
                                    <h4>@lang('backend.Order Info'): </h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>@lang('backend.Invoice ID'): </h5>
                                            <h5>@lang('backend.Payment Terms'): </h5>
                                            <h5>@lang('backend.Delivery Method'): </h5>
                                            <h5>@lang('backend.Order Date'): </h5>
                                            <h5>@lang('backend.Delivery Date'): </h5>
                                            <h5>@lang('backend.Confirm Date'): </h5>
                                            <h5>@lang('backend.Order Note'): </h5>
                                        </div>
                                        <div class="col-lg-6">
                                            <h5><span>{{ $order->invoiceID }}</span></h5>
                                            <h5><span>{{ $order->email }}</span></h5>
                                            <h5><span>{{ $order->phone }}</span></h5>
                                            <h5><span>{{ $order->orderDate }}</span></h5>
                                            <h5><span>{{ $order->deliveryDate ?? '' }}</span></h5>
                                            <h5><span>{{ $order->confirmDate ?? '' }}</span></h5>
                                            <h5><span>{{ $order->order_note ?? '' }}</span></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 pt-4">
                                <div class="customer-info">
                                    <h4>@lang('backend.Courier Info'): </h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>@lang('backend.Courier Name'): </h5>
                                            <h5>@lang('backend.City'): </h5>
                                            <h5>@lang('backend.Zone'): </h5>
                                            <h5>@lang('backend.Area'): </h5>
                                        </div>
                                        <div class="col-lg-6">
                                            <h5><span>{{ $order->courierName }}</span></h5>
                                            <h5><span>{{ $order->cityName }}</span></h5>
                                            <h5><span>{{ $order->zoneName }}</span></h5>
                                            <h5><span>{{ $order->areaName }}</span></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>@lang('backend.Product Info')</strong>
                                    </div>
                                    <div class="card-body  customer-info">
                                        <table id="productTable" style="width: 100% !important;"
                                            class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>@lang('backend.Code')</th>
                                                    <th>@lang('backend.Image')</th>
                                                    <th>@lang('Color')</th>
                                                    <th>@lang('backend.Size')</th>
                                                    <th>@lang('backend.Product Name')</th>
                                                    <th>@lang('backend.Quantity')</th>
                                                    <th>@lang('backend.Price')</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderproducts as $product)
                                                    <tr>
                                                        <td style="display: none">
                                                            <input type="text" class="orderproductID"
                                                                value="{{ $product->id }}">
                                                            <input type="text" class="productID"
                                                                value="{{ $product->product_id }}">
                                                            <input type="text" class="variationID"
                                                                value="{{ $product->productvariation_id }}">
                                                            <input type="text" class="sizeID"
                                                                value="{{ $product->size_id }}">
                                                            <input type="text" class="codeID"
                                                                value="{{ $product->code_id }}">
                                                            <input type="text" class="weightID"
                                                                value="{{ $product->weight_id }}">
                                                        </td>
                                                        <td><span class="code" id="code">{{ $product->code }}</span>
                                                        </td>
                                                        <td>
                                                            @php
                                                                // $image = App\Models\Productvariation::where(
                                                                //     'id',
                                                                //     $product->productvariation_id,
                                                                // )->first()->image;
                                                            @endphp
                                                            <img src="{{ asset($product->productvariation->image) }}"
                                                                style="width:80px">

                                                            {{-- <img src="../../' . Productvariation::where('id',$orders->orderproducts[0]->productvariation_id)->first()->image . '" style="width:80px">' --}}
                                                        </td>
                                                        <td>
                                                            <span class="Color">
                                                                <input type="text" name="color" id="color"
                                                                    value="{{ $product->color }}" style="max-width: 60px;">
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="Size">
                                                                <input type="text" name="size" id="size"
                                                                    value="{{ $product->size }}" style="max-width:50px;">
                                                            </span>
                                                        </td>

                                                        <td><span class="productName">{{ $product->productName }}</span>
                                                        </td>
                                                        <td><input type="hidden" class="qty form-control"
                                                                style="width:80px;" value="{{ $product->qty }}">
                                                            <span>{{ $product->qty }}</span>
                                                        </td>
                                                        @if ($currency->symbol_position == 'left')
                                                            <td><span
                                                                    class="price">{{ $currency->symbol }}{{ $product->price }}</span>
                                                            </td>
                                                        @else
                                                            <td><span
                                                                    class="price">{{ $product->price }}{{ $currency->symbol }}</span>
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                            </tbody>


                                        </table>
                                        <br>

                                        <br>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <strong>@lang('backend.Order Note')</strong>
                                                    </div>
                                                    <div class="card-body">

                                                        <table id="orderCommentTable" data-id="{{ $order->id }}"
                                                            style="width: 100% !important;"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('backend.Created At')</th>
                                                                    <th>@lang('backend.Notes')</th>
                                                                    <th>@lang('backend.Staff')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                @if (isset($order->coupon))
                                                    <div class="form-group row mb-2">
                                                        <label for="fname"
                                                            class="col-sm-4 text-right control-label col-form-label">@lang('backend.Coupon')
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control"
                                                                value="{{ $order->coupon }}" id="coupon" readonly>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="form-group row mb-2">
                                                    <label for="fname"
                                                        class="col-sm-4 text-right control-label col-form-label">@lang('backend.Sub Total')</label>
                                                    <div class="col-sm-8">
                                                        <span class="form-control" id="subtotal"
                                                            style="cursor: not-allowed;">{{ $order->subTotal }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-2">
                                                    <label for="fname"
                                                        class="col-sm-4 text-right control-label col-form-label">@lang('backend.Delivery')
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                            value="{{ $order->shippingCharge }}" id="shippingCharge"
                                                            readonly>
                                                    </div>
                                                </div>
                                                @if ($order->vat > 0)
                                                    <div class="form-group row mb-2">
                                                        <label for="fname"
                                                            class="col-sm-4 text-right control-label col-form-label">@lang('backend.Vat')</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control"
                                                                value="{{ $order->vat }}" id="vat" readonly>
                                                        </div>
                                                    </div>
                                                @else
                                                    <input type="hidden" class="form-control" value="0"
                                                        id="vat" readonly>
                                                @endif
                                                @if ($order->tax > 0)
                                                    <div class="form-group row mb-2">
                                                        <label for="fname"
                                                            class="col-sm-4 text-right control-label col-form-label">@lang('backend.Tax')
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control"
                                                                value="{{ $order->tax }}" id="tax" readonly>
                                                        </div>
                                                    </div>
                                                @else
                                                    <input type="hidden" class="form-control" value="0"
                                                        id="tax" readonly>
                                                @endif
                                                <div class="form-group row mb-2">
                                                    <label for="fname"
                                                        class="col-sm-4 text-right control-label col-form-label">@lang('backend.Discount')</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" value="{{ $order->discount }}"
                                                            class="form-control" id="discount" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row paidAmount mb-2">
                                                    <label for="fname"
                                                        class="col-sm-4 text-right control-label col-form-label">@lang('backend.Paid Amount')
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" value="{{ $order->paidAmount }}"
                                                            class="form-control" id="paidAmount" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label for="fname"
                                                        class="col-sm-4 text-right control-label col-form-label">@lang('backend.Total Due')</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" value="{{ $order->due_amount }}"
                                                            class="form-control" id="total" readonly>
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
@endsection
