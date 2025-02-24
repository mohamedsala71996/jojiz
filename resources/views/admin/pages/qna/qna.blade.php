@extends('admin.layouts.master')
@push('style')
@endpush
@section('admin_content')
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
                                                <div class="card-body custom-card-body custom-product-list-body">
                                                    <h4 class="card-title product-title">
                                                        @lang('backend.Q & A List')
                                                    </h4>

                                                    <div class="table-responsive">
                                                        <div class="row product-row">
                                                            <div class="col-lg-12">
                                                                <div class="add-three category-add-text">

                                                                    <div class="category-text">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table header-border data-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>@lang('backend.ID')</th>
                                                                        <th>@lang('backend.Date')</th>
                                                                        <th>@lang('backend.User')</th>
                                                                        <th>@lang('backend.Question')</th>
                                                                        <th>@lang('backend.Sub Question')</th>
                                                                        <th>@lang('backend.Answer')</th>
                                                                        <th>@lang('backend.Action')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
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
                            <!-------------========= Modal Edit Qna start ===========--------->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="modal fade" id="editqna" tabindex="-1" aria-labelledby="editqna"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="post" id="editQnaForm" enctype="multipart/form-data">
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
                                                        <div class="card-body custom-card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 ">
                                                                    <div class="product-input">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label for="">@lang('backend.Type')
                                                                                        : <button
                                                                                            class="btn btn-info btn-sm"
                                                                                            id="typebtn"></button></label>
                                                                                    <input type="text"
                                                                                        class="form-control" name="question"
                                                                                        id="question">
                                                                                </div>
                                                                                <input type="hidden" name="qna_id"
                                                                                    id="qna_id">
                                                                                <div class="form-group mb-4">
                                                                                    <label
                                                                                        for="">@lang('backend.Replay')</label>
                                                                                    <input type="text" name="replay"
                                                                                        id="replay" class="form-control">
                                                                                </div>
                                                                                <button
                                                                                    class="btn btn-info">@lang('backend.Update')</button>

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
                            <!-------------========= Modal Edit Qna End ===========--------->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contextual classes end -->
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            //ajra table data show
            let table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/qna/data') }}",
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'date',
                    },
                    {
                        data: 'user',
                    },
                    {
                        data: 'mquestion',
                    },
                    {
                        data: 'subquestion',
                    },
                    {
                        data: 'answer',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            //qna edit
            $(document).on('click', '#editqnaBtn', function(e) {
                let qna_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "qna/edit/" + qna_id,
                    success: function(res) {
                        $('#editQnaForm').find('#typebtn').text(res.type);
                        $('#editQnaForm').find('#question').val(res.question);
                        $('#editQnaForm').find('#replay').val(res.answer);
                        $('#editQnaForm').find('#qna_id').val(res.id);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
            //qna Update
            $('#editQnaForm').submit(function(e) {
                e.preventDefault();
                let qna_id = $('#qna_id').val();
                $.ajax({
                    type: "POST",
                    url: "qna/update/" + qna_id,
                    processData: false,
                    contentType: false,
                    data: new FormData(this),
                    dataType: "JSON",
                    success: function(res) {
                        $('#editQnaForm').find('#typebtn').text('');
                        $('#editQnaForm').find('#question').val('');
                        $('#editQnaForm').find('#replay').val('');
                        $('#editQnaForm').find('#qna_id').val('');
                        table.ajax.reload();
                        toastr.success('Q&A updated successfully');
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });


        });
    </script>
@endpush
