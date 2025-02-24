<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body custom-card-body custom-product-list-body pt-4 pb-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4><a href="">@lang('backend.Total') <span class="total">{{ $all_orders }}</span>
                                    @lang('backend.Orders') </a></h4>
                        </div>

                        <div class="col-lg-12 mt-2 order-new">

                            <a href="{{ url('admin/create/order') }}"
                                class="btn btn-primary rounded-pill mb-2">@lang('backend.Add New Order')</a>

                        </div>
                    </div>
                    @if (\Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ \Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif


                    <div class="table-responsive">

                        <table class="display dataTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>@lang('backend.ID')</th>
                                    <th>@lang('backend.Invoice ID')</th>
                                    <th>@lang('backend.Order Date')</th>
                                    <th>@lang('backend.Customer Info')</th>
                                    <th>@lang('backend.Total Amount')</th>
                                    <th>@lang('backend.Order Status')</th>
                                    <th class="hidden-sm">@lang('backend.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $key=> $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->invoiceID }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>
                                            {{ $data->user->name ?? '' }} <br />
                                            {{ $data->user->email ?? '' }}
                                        </td>
                                        <td>{{ $data->total }}</td>
                                        <td><span class="badge--primary">{{ $data->status }}</span></td>
                                        </td>
                                        <td>
                                            <div class="dropdown-product-list">
                                                <button><i class="bi bi-three-dots dropdown-product-list"></i></button>
                                                <div id="myDropdown" class="dropdown-product-list-content">

                                                    <a type="button" class="label rounded"
                                                        href="{{ route('admin.orders.show', $data->id) }}"
                                                        data-id="{{ $data->id }}"><span><i
                                                                class="fa-solid fa-pen-to-square mr-1"
                                                                aria-hidden="true"></i></span>@lang('backend.Details')</a>
                                                    <a type="button" class="label rounded"
                                                        href="{{ route('admin.orders.edit', $data->id) }}"
                                                        data-id="{{ $data->id }}"><span><i
                                                                class="fa-solid fa-pen-to-square mr-1"
                                                                aria-hidden="true"></i></span>@lang('backend.Edit')</a>

                                                    <a type="button" class="label rounded confirmDelete"
                                                        data-id="{{ $data->id }}"
                                                        href="javascript:void(0)"><span><i
                                                                class="fa-regular fa-trash-can mr-1"
                                                                aria-hidden="true"></i></span>@lang('backend.Delete')</a>

                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td>@lang('backend.Not Found!')</td>
                                    </tr>
                                @endforelse

                                </thead>
                            <tbody>


                        </table>
                    </div>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>
