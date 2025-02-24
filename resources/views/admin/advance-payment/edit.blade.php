@extends('admin.layouts.master')

@section('admin_content')
    <div class="container ">
        <div class="general-form ">
            <div class="card">
                <div class="card-body custom-card-body">
                    <h1>@lang('backend.Advance Payment')</h1>
                    <form action="{{ url('admin/web-settings/update', $webinfo->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-lg-6">

                                <div class=" mb-3">
                                    <label for="floatingTextarea">@lang('backend.Advance Payment Status')

                                    </label>
                                    <select name="advance_payment_status" id="advance_payment_status" requiblack
                                        class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                        @if ($webinfo->advance_payment_status == 'ON')
                                            <option value="ON" selected>@lang('backend.ON')</option>
                                            <option value="OFF">@lang('backend.OFF')</option>
                                        @else
                                            <option value="ON">@lang('backend.ON')</option>
                                            <option value="OFF" selected>@lang('backend.OFF')</option>
                                        @endif

                                    </select>
                                </div>


                            </div>
                            <div class="col-lg-6">

                                <div class="from-group general-form mb-3">
                                    <label for="floatingInput">@lang('backend.Advance Payment')</label>
                                    <input type="text" class="form-control" name="advance_payment"
                                        value="{{ $webinfo->advance_payment }}" id="advance_payment"
                                        placeholder="@lang('backend.Advance Payment')">
                                </div>


                            </div>
                            <div class="col-lg-6">


                                <div class=" mb-3">
                                    <label for="floatingTextarea">@lang('backend.Advance Payment Type')</label>
                                    <select name="advance_payment_type" id="advance_payment_type" requiblack
                                        class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                        @if ($webinfo->advance_payment_type == 'fixed')
                                            <option value="fixed" selected>@lang('backend.Fixed')
                                            </option>
                                            <option value="percentage">@lang('backend.Perchentage') </option>
                                            <option value="product_wise">@lang('backend.Product Wise')
                                            </option>
                                        @elseif ($webinfo->advance_payment_type == 'product_wise')
                                            <option value="fixed">@lang('backend.Fixed')</option>
                                            <option value="percentage">@lang('backend.Percentage')</option>
                                            <option value="product_wise" selected>@lang('backend.Product Wise')
                                            </option>
                                        @else
                                            <option value="fixed">@lang('backend.Fixed')</option>
                                            <option value="percentage" selected>@lang('backend.Percentage')</option>
                                            <option value="product_wise">@lang('backend.Product Wise')</option>
                                        @endif

                                    </select>
                                </div>
                               

                            </div>
                            <div class="col-lg-6">



                                <div class="from-group general-form mb-3">
                                    <label for="floatingInput">@lang('backend.Advance Payment Title')</label>
                                    <input type="text" class="form-control" name="advance_payment_title"
                                        value="{{ $webinfo->advance_payment_title }}" id="advance_payment_title"
                                        placeholder="@lang('backend.Advance Payment Title')">
                                </div>

                            </div>

                        </div>
                        <div class="mt-3 pt-4">
                            <button type="submit" class="btn btn-primary">@lang('backend.Update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
