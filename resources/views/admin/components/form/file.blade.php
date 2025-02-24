@if (isset($label))

    <label for="{{ $name ?? "floatingInput" }}">{!! $label !!}</label>
@endif

<input type="{{ $type ?? "text" }}" class="form-control {{ $class ?? "" }}" name="{{ $name ?? "" }}" placeholder="{{ $placeholder ?? "Type Here..." }}" {{ $attribute ?? "" }} value="{{ $value ?? "" }}" @isset($required)
required
@endisset/>


@error($name ?? false)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror




