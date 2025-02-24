<div class="row">
    <div class="col-lg-12">
        <div class="modal fade" id="addCourier" tabindex="-1" aria-labelledby="addCourier" aria-hidden="true">
            <div class="modal-dialog">
                <form id="AddCourier" action="{{ route('admin.couriers.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
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
                                            @lang('backend.Add New Courier')
                                        </h5>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="category-save-text">
                                            <button type="submit" name="action" value="publish"><i
                                                    class="fa-solid fa-check mr-2"
                                                    id="add_courier"></i>@lang('backend.Add Courier')

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
                                                                    <img id="courier_image_preview"
                                                                        src="{{ asset('public') }}/dumy.jpg"
                                                                        alt="Image">
                                                                </div>
                                                            </div>
                                                            <span>@lang('backend.Supported'):(jpeg,jpg,png)</span>
                                                            <span>@lang('backend.Size'):5MB</span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="xzoom-thumbs">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="modal-product-image4">
                                                                                <i class="fa fa-plus plus"></i>

                                                                                <input type="file"
                                                                                    onchange="imagePriview(event)"
                                                                                    name="image" id="image"
                                                                                    class=" form-control" />
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
                                                        <div class="form-group general-form mb-3">
                                                            <label for="floatingInput">
                                                                @lang('backend.Name') <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                name="courierName" id="courierName"
                                                                placeholder="Ex: Sundorbon" required="" />
                                                        </div>
                                                        @error('courierName')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div class="form-group general-form mb-3">
                                                            <label for="floatingInput">
                                                                @lang('backend.Charge')<span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control" name="charge"
                                                                id="charge" placeholder="Ex: 10" required="" />
                                                        </div>
                                                        @error('charge')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div class="form-group general-form mb-3">
                                                            <label for="floatingInput">
                                                                @lang('backend.Available')<span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control" name="available"
                                                                id="available" placeholder="Ex: Dhaka" required="" />
                                                        </div>
                                                        @error('available')
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
