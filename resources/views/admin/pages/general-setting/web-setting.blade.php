@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-heading card-title">
        <h3>@lang('backend.Basic Setting')</h3>
    </div>
    <div class="page-content">
        <!-- Contextual classes start -->
        <div class="section">
            <div class="row" id="table-contexual">
                <div class="col-12">
                    <div class="content-body ">
                        <div class="container-fluid pt-4 px-4">
                            <div class="row">

                                <div class="col-sm-12 col-md-12 col-xl-12 mb-4 ">
                                    <div class="card">
                                        <div class="bg-none rounded h-100 p-4">
                                            <h2 class="mb-4" style="text-align: center;color:black">@lang('backend.Web Settings')</h2>
                                            <form action="{{ url('admin/web-settings/update', $webinfo->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="from-group general-form mb-3">
                                                            <label for="floatingInput">@lang('backend.Email')</label>
                                                            <input type="email" class="form-control" name="email"
                                                                value="{{ $webinfo->email }}" id="floatingInput"
                                                                placeholder="name@example.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="from-group general-form mb-3">
                                                            <label for="floatingPassword">@lang('backend.Phone')</label>
                                                            <input type="text" class="form-control" name="phone"
                                                                value="{{ $webinfo->phone }}" id="floatingPassword"
                                                                placeholder="@lang('backend.Phone')">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="from-group general-form mb-3">
                                                            <label for="floatingTextarea">@lang('backend.Office Address')</label>
                                                            <textarea class="form-control" placeholder="Office Address" name="address" id="floatingTextarea" style="height: 50px;">{{ $webinfo->address }}</textarea>
                                                        </div>


                                                    </div>
                                                    <div class="col-lg-6">

                                                        <div class="from-group general-form mb-3">
                                                            <label for="floatingTextarea">@lang('backend.Vat (%)') </label>
                                                            <input type="text" class="form-control" name="vat"
                                                                value="{{ $webinfo->vat }}" id="floatingPassword"
                                                                placeholder="Vat">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-6">


                                                        <div class=" mb-4">
                                                            <label for="floatingTextarea">@lang('backend.Vat Status')</label>
                                                            <select name="vat_status" id="vat_status" requiblack
                                                                class="form-select form-select-lg mb-3"
                                                                aria-label=".form-select-lg example">
                                                                @if ($webinfo->vat_status == 'ON')
                                                                    <option value="ON" selected>@lang('backend.ON')
                                                                    </option>
                                                                    <option value="OFF">@lang('backend.OFF')</option>
                                                                @else
                                                                    <option value="ON">@lang('backend.ON')</option>
                                                                    <option value="OFF" selected>@lang('backend.OFF')
                                                                    </option>
                                                                @endif

                                                            </select>
                                                        </div>



                                                    </div>
                                                    <div class="col-lg-6">



                                                        <div class="from-group general-form mb-3">
                                                            <label for="floatingTextarea">@lang('backend.Tax (%)')</label>
                                                            <input type="text" class="form-control" name="tax"
                                                                value="{{ $webinfo->tax }}" id="floatingPassword"
                                                                placeholder="Tax">
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-6">

                                                        <div class="from-group general-form mb-3">
                                                            <label for="floatingTextarea">@lang('backend.Tax (%)')</label>
                                                            <input type="text" class="form-control" name="tax"
                                                                value="{{ $webinfo->tax }}" id="floatingPassword"
                                                                placeholder="Tax">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-lg-6">


                                                        <div class=" mb-3">
                                                            <label for="floatingTextarea">@lang('backend.Tax Status')</label>
                                                            <select name="tax_status" id="tax_status" requiblack
                                                                class="form-select form-select-lg mb-3"
                                                                aria-label=".form-select-lg example">
                                                                @if ($webinfo->tax_status == 'ON')
                                                                    <option value="ON" selected>@lang('backend.ON')
                                                                    </option>
                                                                    <option value="OFF">@lang('backend.OFF')</option>
                                                                @else
                                                                    <option value="ON">@lang('backend.ON')</option>
                                                                    <option value="OFF" selected>@lang('backend.OFF')
                                                                    </option>
                                                                @endif

                                                            </select>
                                                        </div>
                                                    </div>



                                                    <div class="mt-3 pt-4">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-lg w-100">@lang('backend.Update')</button>
                                                    </div>
                                                </div>

                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-4">
                                    <div class="bg-none rounded h-100 p-4">
                                        <h2 class="mb-4" style="text-align: center;color:black">@lang('backend.Meta Tag Information Update')</h2>
                                        <form action="{{ url('admin/meta-tags', $webinfo->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingInput">@lang('backend.Meta Title') </label>
                                                        <input type="text" class="form-control" name="meta_title"
                                                            value="{{ $webinfo->meta_title }}" id="floatingInput"
                                                            placeholder="@lang('backend.Meta Title')">
                                                    </div>
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingTextarea">@lang('backend.Meta Description')</label>
                                                        <textarea class="form-control" placeholder="@lang('backend.Meta Description')" name="meta_description" id="floatingTextarea"
                                                            style="height: 80px;">{{ $webinfo->meta_description }}</textarea>
                                                    </div>
                                                    <div
                                                        class="general-form m-3 ms-0 mb-0"style="text-align: center;height: 85px;margin-top:20px !important">
                                                        <h4 style="width:30%;float: left;text-align: left; color:#858d96;">
                                                            Meta Imgae
                                                            :
                                                        </h4>
                                                        <img src="{{ asset($webinfo->meta_image) }}" alt=""
                                                            srcset="" style="max-height: 80px;">
                                                    </div>
                                                    <div class="mb-3 general-form">
                                                        <input class="form-control form-control-lg" name="meta_image"
                                                            id="formFileLg" type="file">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingTextarea">@lang('backend.Meta Keywords')</label>
                                                        <textarea class="form-control" placeholder="@lang('backend.Meta Keywords')" name="meta_keyword" id="floatingTextarea"
                                                            style="height: 80px;">{{ $webinfo->meta_keyword }}</textarea>
                                                    </div>


                                                    <div class="mt-0">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-lg w-100">@lang('backend.Update')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-4">
                                    <div class="bg-none rounded h-100 p-4">
                                        <h2 class="mb-4" style="text-align: center;color:black">@lang('backend.Pixel & Analytics')
                                        </h2>
                                        <form action="{{ url('/admin/pixel/analytics', $webinfo->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingTextarea">@lang('backend.Facebook Pixel') </label>
                                                        <textarea class="form-control" placeholder="@lang('backend.Facebook Pixel')" name="facebook_pixel" id="floatingTextarea"
                                                            style="height: 150px;">{{ $webinfo->facebook_pixel }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingTextarea">@lang('backend.Google Analytics')</label>
                                                        <textarea class="form-control" placeholder="@lang('backend.Google Analytics')" name="google_analytics" id="floatingTextarea"
                                                            style="height: 150px;">{{ $webinfo->google_analytics }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingTextarea">@lang('backend.Chatbox Script')</label>
                                                        <textarea class="form-control" placeholder="@lang('backend.Chatbox Script')" name="chat_box" id="chat_box"
                                                            style="height: 100px;">{{ $webinfo->chat_box }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mt-3">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-lg w-100">@lang('backend.Update')</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="col-sm-12 col-md-12 col-xl-12">
                                    <div class="bg-none rounded h-100 p-4">
                                        <h2 class="mb-4" style="text-align: center;color:black">@lang('backend.Social Links Update')
                                        </h2>
                                        <form action="{{ url('/admin/social-settings/update', $webinfo->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingInput">@lang('backend.Facebook')</label>
                                                        <input type="text" class="form-control" name="facebook"
                                                            value="{{ $webinfo->facebook }}" id="floatingInput"
                                                            placeholder="https://www.facebook.com/">
                                                    </div>
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingInput">@lang('backend.Twitter')</label>
                                                        <input type="text" class="form-control" name="twitter"
                                                            value="{{ $webinfo->twitter }}" id="floatingInput"
                                                            placeholder="https://www.twitter.com/">
                                                    </div>
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingInput">@lang('backend.Google')</label>
                                                        <input type="text" class="form-control" name="google"
                                                            value="{{ $webinfo->google }}" id="floatingInput"
                                                            placeholder="https://google.com">
                                                    </div>
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingInput">@lang('backend.RSS')</label>
                                                        <input type="text" class="form-control" name="rss"
                                                            value="{{ $webinfo->rss }}" id="floatingInput"
                                                            placeholder="https://www.rss.org/">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingInput">@lang('backend.Penterest')</label>
                                                        <input type="text" class="form-control" name="pinterest"
                                                            value="{{ $webinfo->pinterest }}" id="floatingInput"
                                                            placeholder="https://www.pinterest.com/">
                                                    </div>
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingInput">@lang('backend.Linkedin')</label>
                                                        <input type="text" class="form-control" name="linkedin"
                                                            value="{{ $webinfo->linkedin }}" id="floatingInput"
                                                            placeholder="https://www.linkedin.com/">
                                                    </div>
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingInput">@lang('backend.Youtube')</label>
                                                        <input type="text" class="form-control" name="youtube"
                                                            value="{{ $webinfo->youtube }}" id="floatingInput"
                                                            placeholder="https://www.Youtube.com/">
                                                    </div>
                                                    <div class="mt-4 pt-4">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-lg w-100">@lang('backend.Update')</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="col-sm-12 col-md-12 col-xl-6">
                                    <div class="bg-none rounded h-100 p-4">
                                        <h2 class="mb-4" style="text-align: center;color:black">@lang('backend.App Download Link')
                                        </h2>
                                        <form action="{{ route('admin.general.setting.app.download', $webinfo->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingInput">@lang('backend.App Store')</label>
                                                        <input type="text" class="form-control" name="app_store"
                                                            value="{{ $webinfo->app_store }}" id="floatingInput">
                                                    </div>

                                                    <div class="from-group general-form mb-3">
                                                        <label for="floatingInput">@lang('backend.Apple Store')</label>
                                                        <input type="text" class="form-control" name="apple_store"
                                                            value="{{ $webinfo->apple_store }}" id="floatingInput">
                                                    </div>
                                                    <div class="mt-4 pt-4 pb-3">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-lg w-100">@lang('backend.Update')</button>
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
@endsection
