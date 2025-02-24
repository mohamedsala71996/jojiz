<div class="row">
    <div class="col-lg-12">
        <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.delivery-charges.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="card">
                            <div class="add-top-header">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="add-header-content">
                                                    <h4>@lang('backend.Overview')</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-header">
                                <div class="row justify-content-around">
                                    <div class="col-lg-6">
                                        <h5 class="modal-title card-title">
                                            @lang('backend.Add New')
                                        </h5>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="category-save-text">
                                            <button type="submit" name="action" value="publish"><i
                                                    class="fa-solid fa-check mr-2" id="submit"></i>@lang('backend.Add New')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body custom-card-body">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="product-input">
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="general-main">

                                                        <div class="city">
                                                            <div class="form-group general-form mb-3">
                                                                <label for="city">
                                                                    @lang('backend.City')</label>
                                                                <input type="text" class="form-control"
                                                                    name="city" value="{{ old('city') }}">
                                                            </div>
                                                            @error('city')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="amount">
                                                            <div class="form-group general-form mb-3">
                                                                <label for="amount">
                                                                    @lang('backend.Amount')</label>
                                                                <input type="number" class="form-control"
                                                                    name="amount" value="{{ old('amount') }}">
                                                            </div>
                                                            @error('amount')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
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
