<div class="row">
    <div class="col-lg-12">
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" id="editForm" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="id">
                    <div class="modal-content">
                        <div class="card">
                            <div class="add-top-header">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="add-header-content">
                                                    <h4>@lang('backend.Edit')</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-header">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5 class="modal-title card-title">
                                            @lang('backend.Edit Delivery Charge')
                                        </h5>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="category-save-text">
                                            <button type="submit" name="action" value="publish"><i
                                                    class="fa-solid fa-check mr-2"
                                                    id="add_category"></i>@lang('backend.Update')

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
                                                                    name="city" value="{{ old('city') }}"
                                                                    id="city">
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
                                                                    name="amount" value="{{ old('amount') }}"
                                                                    id="amount">
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
