<div class="row">
    <div class="col-lg-12">
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editOfferForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="offer_id" id="offer_id">
                    <div class="modal-content">
                        <div class="card">
                            <div class="add-top-header">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-3">
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
                                            @lang('backend.Update New Collection')
                                        </h5>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="category-save-text">
                                            <button type="submit" name="action" value="publish"><i
                                                    class="fa-solid fa-check mr-2" id="update_btn"></i>@lang('backend.Update')

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
                                                <div class="col-lg-4">
                                                    <div class="upload-product">
                                                        <div class="row ">
                                                            <div class="col-lg-12 border-round">
                                                                <h5>@lang('backend.Uploading Image')</h5>
                                                                <div class="modal-product-image">
                                                                    <img src="" id="offer_edit_image_preview"
                                                                        alt="Offer Image">
                                                                </div>
                                                            </div>
                                                            <span>@lang('backend.Supported'):(jpeg,jpg,png)</span>
                                                            <span>@lang('backend.Size'):5MB</span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="xzoom-thumbs">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-4">
                                                                            <div class="modal-product-image4">
                                                                                <i class="fa fa-plus plus"></i>
                                                                                <img src="" alt=""
                                                                                    width="85">
                                                                                <input type="file"
                                                                                    onchange="editImagePriview(event)"
                                                                                    name="image" id="image"
                                                                                    class="form-control" />
                                                                            </div>
                                                                            @error('image')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="general-main">
                                                        <div class="general-text">

                                                        </div>
                                                        <div>
                                                            <div class="form-group general-form mb-3">
                                                                <label for="floatingInput">@lang('backend.Title')

                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    name="title" id="title"
                                                                    placeholder="Ex: Summer Offer" required="" />
                                                            </div>
                                                            @error('title')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                        <div>
                                                            <div class="form-group general-form mb-3">
                                                                <label for="floatingInput">@lang('backend.Sub Title')

                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    name="sub_title" id="sub_title"
                                                                    placeholder="Ex: Summer Offer" required="" />
                                                            </div>
                                                            @error('sub_title')
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
                </form>
            </div>
        </div>
    </div>

</div>
