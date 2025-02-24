@extends('admin.layouts.master')

@push('style')
@endpush
@section('admin_content')
<div class="container">

    <form action="{{ route('admin.return-policy.update', $returnPolicy->slug) }}" method="POST">
        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="title">@lang("backend.Title")</label>
            <input type="text" name="title" class="form-control" value="{{ $returnPolicy->title }}" required>
            @error('title')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="content">@lang("backend.Content")</label>
            <textarea name="content" rows="30" cols="50" class="form-control" id="description">{{ $returnPolicy->content }}</textarea>
            @error('content')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">@lang("backend.Update")</button>
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
