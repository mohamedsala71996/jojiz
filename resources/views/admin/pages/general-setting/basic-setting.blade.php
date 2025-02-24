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
                    <div class="content-body">
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body custom-card-body">
                                                    <form action="{{ route('admin.general.setting.basic.setting.update') }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class=" form-group general-form col-md-4 mb-3">

                                                                @include('admin.components.form.input', [
                                                                    'label' => __('backend.Site Name'),
                                                                    'placeholder' => __('backend.Write Name...'),
                                                                    'name' => 'site_name',
                                                                    'value' => old(
                                                                        'site_name',
                                                                        $basic_setting->site_name),
                                                                ])
                                                            </div>
                                                            <div class=" form-group general-form col-md-4 mb-3">
                                                                @include('admin.components.form.input', [
                                                                    'label' => __('backend.Site Title'),
                                                                    'placeholder' => __('backend.Write Name...'),
                                                                    'name' => 'site_title',
                                                                    'value' => old(
                                                                        'site_title',
                                                                        $basic_setting->site_title),
                                                                ])
                                                            </div>
                                                            <div class=" form-group general-form col-md-4 mb-3">
                                                                @include('admin.components.form.input', [
                                                                    'label' => __('backend.Web Version'),
                                                                    'placeholder' => __('backend.Write Name...'),
                                                                    'name' => 'web_version',
                                                                    'value' => old(
                                                                        'web_version',
                                                                        $basic_setting->web_version),
                                                                ])
                                                            </div>
                                                            <div class="col-xl-12 col-lg-2 info-button">

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
@endsection
