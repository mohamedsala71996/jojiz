@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-heading card-title">
        <h3>@lang('backend.Image Assets')</h3>
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
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <form
                                                                action="{{ route('admin.general.setting.image.asset.update') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="form-group col-md-12 mb-3">
                                                                        <label for="">@lang('backend.Site Logo') </label>
                                                                        <span>(width: 150px and Height: 47px)</span><br>
                                                                        <a style="font-size: 14px; color:#7571F9"
                                                                            href="https://imageresizer.com/"
                                                                            target="_blank">Image Resizer</a>
                                                                        <input type="file" name="site_logo"
                                                                            data-default-file="{{ asset('public/backend/images/general-setting') }}/{{ $basic_setting->site_logo }}"
                                                                            id="site_logo" class="dropify" multiple>

                                                                    </div>
                                                                    <div class="col-md-12 info-button">
                                                                        @include(
                                                                            'admin.components.button.form-button',
                                                                            [
                                                                                'class' => 'w-100 text-center',
                                                                                'text' => __('backend.Update'),
                                                                            ]
                                                                        )
                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <form
                                                                action="{{ route('admin.general.setting.favicon.update') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="form-group col-md-12 mb-3">
                                                                        <label for="">@lang('backend.Site Favicon')</label>
                                                                        <input type="file" name="site_favicon"
                                                                            id="site_favicon"
                                                                            data-default-file="{{ asset('public/backend/images/general-setting') }}/{{ $basic_setting->site_favicon }}"
                                                                            class="dropify">
                                                                    </div>
                                                                    <div class="col-md-12 info-button">
                                                                        @include(
                                                                            'admin.components.button.form-button',
                                                                            [
                                                                                'class' => 'w-100 text-center',
                                                                                'text' => __('backend.Update'),
                                                                            ]
                                                                        )
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
            </div>
        </div>
    </div>
@endsection
