<div class="row">
    <div class="col-lg-12">
        <div class="modal fade" id="editFaqModal" tabindex="-1" aria-labelledby="editFaqModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" id="editFaqForm" method="PUT" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="faq_id">
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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5 class="modal-title card-title">
                                            @lang('backend.Update FAQ')
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

                                                        <div class="">
                                                            <div class="form-group general-form mb-3">
                                                                <label for="name">
                                                                    @lang('backend.Title')</label>
                                                                <input type="text" id="title"
                                                                    class="form-control" name="title"
                                                                    value="{{ old('title') }}">
                                                            </div>
                                                            @error('title')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="description">
                                                            <div class="form-group general-form mb-3">
                                                                <label for="name">
                                                                    @lang('backend.Description')</label>
                                                                <textarea name="description" class="form-control" id="edit_description" cols="30" rows="10"></textarea>
                                                            </div>
                                                            @error('description')
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
