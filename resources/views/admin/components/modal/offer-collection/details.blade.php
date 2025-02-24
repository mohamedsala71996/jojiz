<div class="modal fade" id="CategoryDetails" tabindex="-1" role="dialog" aria-labelledby="detailsTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>@lang('backend.Category Details')</h5>
            </div>
            <div class="modal-body" id="cvd">
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
                                                        <img src="" id="category_edit_image_preview"
                                                            alt="Brand Image">
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
                                                                    <img src="" alt="" width="85">
                                                                    <input type="file"
                                                                        onchange="editImagePriview(event)"
                                                                        name="image" id="image"
                                                                        class="form-control" />
                                                                </div>
                                                                @error('image')
                                                                    <span class="text-danger">{{ $message }}</span>
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
                                            <div class="form-group general-form mb-3">
                                                <label for="floatingInput">@lang('backend.Category Name')

                                                </label>
                                                <input type="text" class="form-control" name="category_name"
                                                    id="category_name" placeholder="Ex: Man" required="" />
                                            </div>
                                            @error('category_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <div class="form-group general-form mb-3">
                                                <label for="category_desc">
                                                    @lang('backend.Description')</label>
                                                <textarea class="form-control" name="category_desc" placeholder="Ex:This is a very useful product" id="category_desc"
                                                    rows="3"></textarea>
                                            </div>
                                            @error('category_desc')
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
</div>
