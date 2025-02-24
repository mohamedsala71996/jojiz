<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
{{-- for yajra datatable --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<script src="https://kit.fontawesome.com/0b2a739660.js"></script>


<script src="{{ asset('public/backend') }}/js/dropify.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
{!! Toastr::message() !!}


<script>
    //dropify started
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Oops, something wrong happended.'
        }
    });
    //dropify end
</script>

{{-- Yajra datatable --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- include summernote css/js -->

{{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>



<script src="{{ asset('public/backend') }}/js/app.js"></script>

<script src="{{ asset('public/backend') }}/js/custom.js"></script>
<script>
    new DataTable('.dataTable');
</script>

@stack('script')
