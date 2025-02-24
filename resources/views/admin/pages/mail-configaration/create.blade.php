@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-heading card-title">
        <h3>@lang('backend.Mail Configaration')</h3>
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

                                                    <div class="table-responsive">
                                                        <div class="card-body custom-card-body Product-body">
                                                            <form
                                                                action="{{ route('admin.general.setting.mail.config.update') }}"
                                                                method="POST">
                                                                @csrf

                                                                <div class="form-group general-form ">
                                                                    <label for="MAIL_MAILER">@lang('backend.Mailer') <span
                                                                            class="text-danger">*</span></label>
                                                                    {{-- <input type="text" class="form-control"
                                                                        id="MAIL_MAILER" name="MAIL_MAILER"
                                                                        value="{{ $mailSettings->MAIL_MAILER ?? '' }}"
                                                                        required> --}}


                                                                    <select name="MAIL_MAILER" id="MAIL_MAILER" requiblack
                                                                        class="form-select form-select-lg mb-3"
                                                                        aria-label=".form-select-lg example">
                                                                        <option value="smtp" selected>@lang('backend.SMTP')
                                                                        </option>

                                                                    </select>
                                                                    @error('MAIL_MAILER')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group general-form ">
                                                                    <label for="MAIL_HOST">@lang('backend.Host')<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="MAIL_HOST" name="MAIL_HOST"
                                                                        value="{{ $mailSettings->MAIL_HOST ?? '' }}"
                                                                        required>
                                                                    @error('MAIL_HOST')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group general-form ">
                                                                    <label for="MAIL_PORT">@lang('backend.Port')<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="number" class="form-control"
                                                                        id="MAIL_PORT" name="MAIL_PORT"
                                                                        value="{{ $mailSettings->MAIL_PORT ?? '' }}"
                                                                        required>
                                                                    @error('MAIL_PORT')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group general-form ">
                                                                    <label for="MAIL_USERNAME">@lang('backend.Username')<span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="MAIL_USERNAME" name="MAIL_USERNAME"
                                                                        value="{{ $mailSettings->MAIL_USERNAME ?? '' }}"
                                                                        required>
                                                                    @error('MAIL_USERNAME')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group general-form ">
                                                                    <label for="MAIL_PASSWORD">@lang('backend.Password')<span
                                                                            class="text-danger">*</span> </label>
                                                                    <input type="password" class="form-control"
                                                                        id="MAIL_PASSWORD" name="MAIL_PASSWORD"
                                                                        value="{{ $mailSettings->MAIL_PASSWORD ?? '' }}"
                                                                        required>
                                                                    @error('MAIL_PASSWORD')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group general-form ">
                                                                    <label for="MAIL_ENCRYPTION">@lang('backend.Encryption')<span
                                                                            class="text-danger">*</span></label>


                                                                    <select name="MAIL_ENCRYPTION" id="MAIL_ENCRYPTION"
                                                                        requiblack class="form-select form-select-lg mb-3"
                                                                        aria-label=".form-select-lg example">
                                                                        @if ($mailSettings->MAIL_ENCRYPTION == 'tls')
                                                                            <option value="tls" selected>
                                                                                @lang('backend.TLS')
                                                                            </option>
                                                                            <option value="ssl">@lang('backend.SSL')
                                                                            </option>
                                                                        @else
                                                                            <option value="tls">@lang('backend.TLS')
                                                                            </option>
                                                                            <option value="ssl" selected>
                                                                                @lang('backend.SSL')
                                                                            </option>
                                                                        @endif

                                                                    </select>

                                                                    @error('MAIL_ENCRYPTION')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                {{-- <div class="form-group general-form ">
                                                                    <label for="MAIL_FROM_ADDRESS">@lang('backend.Mail From Address')</label>
                                                                    <input type="email" class="form-control"
                                                                        id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS"
                                                                        value="{{ $mailSettings->MAIL_FROM_ADDRESS ?? '' }}">
                                                                    @error('MAIL_FROM_ADDRESS')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group general-form ">
                                                                    <label for="MAIL_FROM_NAME">@lang('backend.Mail From Name')</label>
                                                                    <input type="text" class="form-control"
                                                                        id="MAIL_FROM_NAME" name="MAIL_FROM_NAME"
                                                                        value="{{ $mailSettings->MAIL_FROM_NAME ?? '' }}"
                                                                        >
                                                                    @error('MAIL_FROM_NAME')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div> --}}

                                                                <button type="submit"
                                                                    class="btn btn-primary">@lang('backend.Update')</button>
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
        <!-- Contextual classes end -->
    </div>
@endsection
