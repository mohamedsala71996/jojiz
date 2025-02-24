@extends('admin.layouts.master')

@section('admin_content')
    <div class="page-heading card-title">
        <h3>@lang('backend.Supplier List')</h3>
    </div>
    <div class="page-content">
        <div class="modal fade" id="mainSupplier" data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('backend.Add New Supplier')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form name="form" id="AddSupplier" enctype="multipart/form-data">
                            @csrf
                            <div class="successSMS"></div>

                            <div class="form-group pb-3">
                                <label for="websiteTitle" class="control-label">@lang('backend.Supplier Name') </label>
                                <div class="webtitle">
                                    <input type="text" class="form-control" name="supplierName" id="supplierName"
                                        required>
                                    <span
                                        class="text-danger">{{ $errors->has('supplierName') ? $errors->first('supplierName') : '' }}</span>
                                </div>
                            </div>

                            <div class="form-group pb-4">
                                <label for="websiteTitle" class="control-label">@lang('backend.Supplier Phone') </label>
                                <div class="webtitle">
                                    <input type="text" class="form-control" name="supplierPhone" id="supplierPhone"
                                        required>
                                    <span
                                        class="text-danger">{{ $errors->has('supplierPhone') ? $errors->first('supplierPhone') : '' }}</span>
                                </div>
                            </div>

                            <div class="form-group pb-4">
                                <label for="websiteTitle" class="control-label">@lang('backend.Supplier Email')</label>
                                <div class="webtitle">
                                    <input type="text" class="form-control" name="supplierEmail" id="supplierEmail"
                                        required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group pb-4">
                                <label for="websiteTitle" class="control-label">@lang('backend.Supplier Address')</label>
                                <div class="webtitle">
                                    <textarea class="form-control" name="supplierAddress" id="supplierAddress"></textarea>
                                    <span class="text-danger"></span>
                                </div>
                            </div>

                            {{-- <div class="form-group pb-4">
                            <label for="websiteTitle" class="control-label">Supplier Company Name</label>
                            <div class="webtitle">
                                <input type="text" class="form-control" name="supplierCompanyName" id="supplierCompanyName">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group pb-4">
                            <label for="websiteTitle" class="control-label">Supplier Total Amount</label>
                            <div class="webtitle">
                                <input type="text" class="form-control" name="supplierTotalAmount" id="supplierTotalAmount">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group pb-4">
                            <label for="websiteTitle" class="control-label">Supplier Paid Amount</label>
                            <div class="webtitle">
                                <input type="text" class="form-control" name="supplierPaidAmount" id="supplierPaidAmount">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group pb-4">
                            <label for="websiteTitle" class="control-label">Supplier Due Amount</label>
                            <div class="webtitle">
                                <input type="text" class="form-control" name="supplierDueAmount" id="supplierDueAmount">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group pb-4">
                            <label for="websiteTitle" class="control-label">Supplier Partial Amount</label>
                            <div class="webtitle">
                                <input type="text" class="form-control" name="supplierPartialAmount" id="supplierPartialAmount">
                                <span class="text-danger"></span>
                            </div>
                        </div> --}}

                            <div class="form-group" style="text-align: right">
                                <div class="submitBtnSCourse">
                                    <button type="submit" name="btn"
                                        class="btn btn-primary AddSupplierBtn btn-block">@lang('backend.Save')</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- End popup Modal-->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body custom-card-body custom-product-list-body pt-4">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#mainSupplier"><span style="font-weight: bold;">+</span>
                                        @lang('backend.Add New Supplier')</button>
                                </div>
                            </div>
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-centered table-borderless table-hover mb-0" id="supplierinfo"
                                    width="100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>@lang('backend.ID')</th>
                                            <th> @lang('backend.Name')</th>
                                            <th> @lang('backend.Phone')</th>
                                            <th> @lang('backend.Email')</th>
                                            <th> @lang('backend.Address')</th>
                                            {{-- <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Due Amount</th>
                            <th>Partial Amount</th> --}}
                                            <th>@lang('backend.Status')</th>
                                            <th>@lang('backend.Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div class="modal fade" id="editmainSupplier" tabindex="-1" data-bs-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('backend.Edit Supplier')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form name="form" id="EditSupplier" enctype="multipart/form-data">
                            @csrf
                            <div class="successSMS"></div>

                            <div class="form-group pb-3">
                                <label for="websiteTitle" class="control-label">@lang('backend.Supplier Name')</label>
                                <div class="webtitle">
                                    <input type="text" class="form-control" name="supplierName" id="editsupplierName"
                                        required>
                                    <span
                                        class="text-danger">{{ $errors->has('supplierName') ? $errors->first('supplierName') : '' }}</span>
                                </div>
                            </div>

                            <div class="form-group pb-4">
                                <label for="websiteTitle" class="control-label">@lang('backend.Supplier Phone')</label>
                                <div class="webtitle">
                                    <input type="text" class="form-control" name="supplierPhone"
                                        id="editsupplierPhone" required>
                                    <span
                                        class="text-danger">{{ $errors->has('supplierPhone') ? $errors->first('supplierPhone') : '' }}</span>
                                </div>
                            </div>

                            <div class="form-group pb-4">
                                <label for="websiteTitle" class="control-label">@lang('backend.Supplier Email')</label>
                                <div class="webtitle">
                                    <input type="text" class="form-control" name="supplierEmail" id="supplierEmail"
                                        required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group pb-4">
                                <label for="websiteTitle" class="control-label">@lang('backend.Supplier Address')</label>
                                <div class="webtitle">
                                    <textarea class="form-control" name="supplierAddress" id="supplierAddress"></textarea>
                                    <span class="text-danger"></span>
                                </div>
                            </div>

                            {{-- <div class="form-group pb-4">
                            <label for="websiteTitle" class="control-label">Supplier Company Name</label>
                            <div class="webtitle">
                                <input type="text" class="form-control" name="supplierCompanyName" id="supplierCompanyName" required>
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group pb-4">
                            <label for="websiteTitle" class="control-label">Supplier Total Amount</label>
                            <div class="webtitle">
                                <input type="text" class="form-control" name="supplierTotalAmount" id="supplierTotalAmount" readonly required>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group pb-4">
                            <label for="websiteTitle" class="control-label">Supplier Paid Amount</label>
                            <div class="webtitle">
                                <input type="text" class="form-control" name="supplierPaidAmount" id="supplierPaidAmount" readonly required>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group pb-4">
                            <label for="websiteTitle" class="control-label">Supplier Due Amount</label>
                            <div class="webtitle">
                                <input type="text" class="form-control" name="supplierDueAmount" id="supplierDueAmount" readonly required>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group pb-4">
                            <label for="websiteTitle" class="control-label">Supplier Partial Amount</label>
                            <div class="webtitle">
                                <input type="text" class="form-control" name="supplierPartialAmount" id="supplierPartialAmount" readonly required>
                                <span class="text-danger"></span>
                            </div>
                        </div> --}}

                            <input type="text" name="id" id="idhidden" hidden>

                            <div class="form-group" style="text-align: right">
                                <div class="submitBtnSCourse">
                                    <button type="submit" name="btn"
                                        class="btn btn-primary btn-block">@lang('backend.Update')</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {

            var supplierinfotbl = $('#supplierinfo').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.supplier.info') !!}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'supplierName'
                    },
                    {
                        data: 'supplierPhone'
                    },
                    {
                        data: 'supplierEmail'
                    },
                    {
                        data: 'supplierAddress'
                    },
                    // { data: 'supplierTotalAmount' },
                    // { data: 'supplierPaidAmount' },
                    // { data: 'supplierDueAmount' },
                    // { data: 'supplierPartialAmount' },
                    {
                        "data": null,
                        render: function(data) {

                            if (data.status === 'Active') {
                                return '<button type="button" class="btn btn-success btn-sm btn-status" data-status="Inactive" id="statusBtnSupplier" data-id="' +
                                    data.id + '">Active</button>';
                            } else {
                                return '<button type="button" class="btn btn-warning btn-sm btn-status" data-status="Active" id="statusBtnSupplier" data-id="' +
                                    data.id + '" >Inactive</button>';
                            }

                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });

            $('#AddSupplier').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    uploadUrl: '{{ route('admin.suppliers.store') }}',
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function(data) {

                        $('#AddSupplier').trigger('reset');

                        Swal.fire({
                            title: "@lang('backend.Success!')",
                            icon: "success",
                        });

                        supplierinfotbl.ajax.reload();
                        $("#mainSupplier").hide();

                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

            //edit store
            $(document).on('click', '#editSupplierBtn', function() {
                let supplierId = $(this).data('id');

                $.ajax({
                    type: 'GET',
                    url: 'suppliers/' + supplierId + '/edit',

                    success: function(data) {
                        $('#EditSupplier').find('#editsupplierName').val(data.supplierName);
                        $('#EditSupplier').find('#editsupplierPhone').val(data.supplierPhone);
                        $('#EditSupplier').find('#supplierEmail').val(data.supplierEmail);
                        $('#EditSupplier').find('#supplierAddress').val(data.supplierAddress);
                        $('#EditSupplier').find('#supplierCompanyName').val(data
                            .supplierCompanyName);
                        $('#EditSupplier').find('#supplierTotalAmount').val(data
                            .supplierTotalAmount);
                        $('#EditSupplier').find('#supplierPaidAmount').val(data
                            .supplierPaidAmount);
                        $('#EditSupplier').find('#supplierDueAmount').val(data
                            .supplierDueAmount);
                        $('#EditSupplier').find('#supplierPartialAmount').val(data
                            .supplierPartialAmount);
                        $('#EditSupplier').find('#idhidden').val(data.id);
                        $('#EditSupplier').attr('data-id', data.id);
                    },
                    error: function(error) {
                        console.log('error');
                    }

                });
            });

            //update store
            $('#EditSupplier').submit(function(e) {
                e.preventDefault();
                let supplierId = $('#idhidden').val();

                $.ajax({
                    type: 'POST',
                    url: 'supplier/' + supplierId,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),

                    success: function(data) {
                        $('#editsupplierName').val('');
                        $('#editsupplierPhone').val('');

                        Swal.fire({
                            title: "@lang('backend.Supplier update successfully !')",
                            icon: "success",
                        });
                        supplierinfotbl.ajax.reload();
                        $("#editmainSupplier").hide();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

            $(document).on('click', '#deleteSupplierBtn', function() {
                let supplierId = $(this).data('id');
                Swal.fire({
                    title: "@lang('backend.Are you sure?')",
                    text: "Once deleted, you will not be able to recover this !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'DELETE',
                            url: 'suppliers/' + supplierId,

                            success: function(data) {
                                Swal.fire("Poof! Your supplier has been deleted!", {
                                    icon: "success",
                                });
                                supplierinfotbl.ajax.reload();
                            },
                            error: function(error) {
                                console.log('error');
                            }

                        });


                    } else {
                        swal("Your data is safe!");
                    }
                });

            });

            //status update store
            $(document).on('click', '#statusBtnSupplier', function() {
                let supplierId = $(this).data('id');
                let supplierStatus = $(this).data('status');

                $.ajax({
                    type: 'PUT',
                    url: 'supplier/status',
                    data: {
                        supplier_id: supplierId,
                        status: supplierStatus,
                        _token: "{{ csrf_token() }}",
                    },

                    success: function(data) {
                        Swal.fire({
                            title: "@lang('backend.Status updated !')",
                            icon: "success",
                        });
                        supplierinfotbl.ajax.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
            });

        });
    </script>
@endpush
