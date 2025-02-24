{{-- <div class="modal fade" id="editmainCourier" tabindex="-1" aria-labelledby="editmainCourier" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card m-0">
                <div class="modal-header">
                    <h5 class="modal-title card-title">
                        Edit Courier
                    </h5>
                </div>
                <div class="card-body custom-card-body Product-body">
                    <form name="form" id="EditCourier" enctype="multipart/form-data">
                        @csrf
                        <div class="successSMS"></div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group pb-3">
                                    <label for="websiteTitle" class="control-label">Courier Name</label>
                                    <div class="webtitle">
                                        <input type="text" class="form-control" name="courierName"
                                            id="courierName" required>
                                        <span
                                            class="text-danger">{{ $errors->has('courierName') ? $errors->first('courierName') : '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group pb-3">
                                    <label for="websiteTitle" class="control-label">Inside Dhaka Charge</label>
                                    <div class="webtitle">
                                        <input type="text" class="form-control" name="insideDhakaCharge"
                                            id="insideDhakaCharge" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group pb-3">
                                    <label for="websiteTitle" class="control-label">Nearest Dhaka Charge</label>
                                    <div class="webtitle">
                                        <input type="text" class="form-control" name="nearestDhakaCharge"
                                            id="nearestDhakaCharge" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group pb-3">
                                    <label for="websiteTitle" class="control-label">Outside Dhaka Charge</label>
                                    <div class="webtitle">
                                        <input type="text" class="form-control" name="outsideDhakaCharge"
                                            id="outsideDhakaCharge" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4 d-flex justify-content-between">
                            <div class="checkbox checkbox-primary mb-2">
                                <input id="hasCity" type="checkbox" name="hasCity">
                                <label for="hasCity">
                                    City Available
                                </label>
                            </div>
                            <div class="checkbox checkbox-primary mb-2">
                                <input id="hasZone" type="checkbox" name="hasZone">
                                <label for="hasZone">
                                    Zone Available
                                </label>
                            </div>
                            <div class="checkbox checkbox-primary mb-2">
                                <input id="hasArea" type="checkbox" name="hasArea">
                                <label for="hasArea">
                                    Area Available
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="courier_id" id="courier_id">
                        <div class="form-group mb-3" style=" width: 60%; float: left; padding-top: 50px; ">
                            <div class="info-button">
                                <button type="submit">Update</button>
                                <button type="button" class="gradient-button ml-2" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-lg-12">
        <div class="modal fade" id="editmainCourier" tabindex="-1" aria-labelledby="editmainCourier" aria-hidden="true">
            <div class="modal-dialog">
                <form id="EditCourier" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="courier_id" id="courier_id">
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
                                            @lang('backend.Update Courier')
                                        </h5>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="category-save-text">
                                            <button type="submit" name="action" value="publish"><i
                                                    class="fa-solid fa-check mr-2"
                                                    id="add_courier"></i>@lang('backend.Update')

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
                                                                    <img id="courier_edit_image_preview"
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
                                                                        <div class="col-lg-12 col-4">
                                                                            <div class="modal-product-image4">
                                                                                <i class="fa fa-plus plus"></i>

                                                                                <input type="file"
                                                                                    onchange="editImagePriview(event)"
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
                                                                @lang('backend.Name')<span class="text-danger">*</span>
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
