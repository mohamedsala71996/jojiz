@extends('admin.layouts.master')

@push('style')
@endpush
@section('admin_content')
<div class="container">

    <form action="{{ route('admin.usefullink.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">@lang("backend.Title")</label>
            <input type="text" name="title" class="form-control" required>
            @error('title')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="content">@lang("backend.Content")</label>
            <textarea name="content" rows="30" cols="50" class="form-control" id="description"></textarea>
            @error('content')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">@lang("backend.Submit")</button>
    </form>
</div>

@endsection
@push('script')
<script>
    $(document).ready(function() {
        $('#description').summernote({
            placeholder: 'Write Description',
            tabsize: 2,
            height: 500
        });
    });
</script>
@endpush
