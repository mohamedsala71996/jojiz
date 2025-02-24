<div class="row">
    <div class="col-lg-12">
        <div class="modal fade" id="faqCreateModal" tabindex="-1" aria-labelledby="faqCreateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.faqs.store') }}" method="post" enctype="multipart/form-data">
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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5 class="modal-title card-title">
                                            @lang('backend.Add New FAQ')
                                        </h5>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="category-save-text">
                                            <button type="submit" name="action" value="publish"><i
                                                    class="fa-solid fa-check mr-2"
                                                    id="add_category"></i>@lang('backend.Add New')

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
                                                                <input type="text" class="form-control"
                                                                    name="title" value="{{ old('title') }}">
                                                            </div>
                                                            @error('title')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="description">
                                                            <div class="form-group general-form mb-3">
                                                                <label for="name">
                                                                    @lang('backend.Description')</label>
                                                                <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
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
