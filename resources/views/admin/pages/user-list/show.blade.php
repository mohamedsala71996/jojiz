@extends('admin.layouts.master')
@push('style')
@endpush
@section('admin_content')
    <div class="page-heading card-title">
        <h3>Collection</h3>
    </div>
    <div class="page-content">
        <!-- Contextual classes start -->
        <div class="section">
            <div class="row" id="table-contexual">
                <div class="col-12">
                    <div class="content-body">
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body custom-card-body">
                                                    <h4 class="card-title product-title">
                                                        Collection Title: {{ $collectoin->title }}
                                                    </h4>
                                                    <p>Collection Sub Title: {{ $collectoin->sub_title }}</p>

                                                    <div class="table-responsive">
                                                        <table id="offerCollectionTable" class="display" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('backend.ID')</th>
                                                                    <th>name</th>
                                                                    <th>size</th>
                                                                    <th>Price</th>
                                                                    @lang('backend.Image')

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($collectoin->products as $key => $product)
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td>{{ $product->product_name }}</td>
                                                                        <td>{{ $product->sizes[0]->size }}</td>
                                                                        <td>{{ $product->sizes[0]->RegularPrice }}</td>

                                                                        <td>
                                                                            <img width="60"
                                                                                src="{{ asset($product->productvariations[0]->image) }}"
                                                                                alt="Collection Image">
                                                                        </td>


                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td>Not Found!</td>
                                                                    </tr>
                                                                @endforelse

                                                            </tbody>

                                                        </table>
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
        </div>
        <!-- Contextual classes end -->
    </div>
    {{-- Details modal --}}

    @include('admin.components.modal.offer-collection.details')
    <!-------------========= Modal add category start ===========--------->
    @include('admin.components.modal.offer-collection.create')
    <!-------------========= Modal add Category End ===========--------->
    <!-------------========= Modal edit category start ===========--------->
    @include('admin.components.modal.offer-collection.edit')

    <!-------------========= Modal edit Category End ===========--------->
@endsection
@push('script')
    <script type="text/javascript">
        //Show Table
        new DataTable('#offerCollectionTable');


        //offer edit
        $(document).on('click', '.editBtn', function(e) {
            offer_id = $(this).data('id');

            $('#editOfferForm').find('#title').val('');
            $('#editOfferForm').find('#sub_title').val('');
            $('#editOfferForm').find('#offer_id').val('');
            $('#editOfferForm').find('img').attr('src', '');

            $('#editModal').modal('show');
            $.ajax({
                type: "GET",
                url: "offer-collection/edit/" + offer_id,
                success: function(res) {
                    console.log(res);
                    $('#editOfferForm').find('#title').val(res.title);
                    $('#editOfferForm').find('#sub_title').val(res.sub_title);
                    $('#editOfferForm').find('#offer_id').val(res.id);
                    $('#editOfferForm #offer_edit_image_preview').attr('src',
                        "{{ asset('') }}" + res.image);
                },
                error: function(err) {
                    console.log(err);
                }
            });


        });

        //Update offer

        $('#editOfferForm').submit(function(e) {
            e.preventDefault();
            let offer_id = $('#offer_id').val();
            $.ajax({
                type: "POST",
                url: "offer-collection/update/" + offer_id,
                processData: false,
                contentType: false,
                data: new FormData(this),
                dataType: "JSON",
                success: function(res) {
                    $('#title').val();
                    $('#sub_title').val();
                    $("#editModal").modal("hide");
                    location.reload();
                    toastr.success(res.message);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        //offer Collection Delete
        $(document).on('click', '.confirmDelete', function(e) {
            e.preventDefault();
            let offer_id = $(this).data('id');

            Swal.fire({
                title: "@lang('backend.Are you sure?')",
                text: "@lang('backend.You won\'t be able to revert this!')",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "@lang('backend.Yes, delete it!')",
                cancelButtonText: "@lang('backend.No, cancel!')",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "offer-collection/destroy/" + offer_id,
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                Swal.fire({
                                    title: "@lang('backend.Deleted!')!",
                                    text: "@lang('backend.Your file has been deleted.')",
                                    icon: "success"
                                });
                                location.reload();
                            }
                        },
                        error: function(err) {
                            console.log('err');
                        }
                    });

                }
            });
        });

        function imagePriview(event) {
            let previewImage = document.getElementById("offer_image_preview");
            previewImage.src = URL.createObjectURL(event.target.files[0]);
        }

        function editImagePriview(event) {
            let eidtPreviewImage = document.getElementById("offer_edit_image_preview");
            eidtPreviewImage.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endpush
