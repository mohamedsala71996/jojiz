@php
    $size_id = Session::get('size_id');
    $weight_id = Session::get('weight_id');
@endphp
@if (count($sizes) > 0)
    <div class="u-s-m-b-10">
        @if ($sizes[0]->size_id == 2)
        @else
            <span class="pd-detail__label u-s-m-b-5">@lang("frontend.Size") :</span>
        @endif
        <div class="pd-detail__size">
            @foreach ($sizes as $size)
                @if ($size->size_id == 2)
                @else
                    <div class="size__radio">
                        <input type="hidden" name="regularpriceofsize" id="regularpriceofsize{{ $size->size }}"
                            value="{{ $size->RegularPrice }}">
                        <input type="hidden" name="salepriceofsize" id="salepriceofsize{{ $size->size }}"
                            value="{{ $size->SalePrice }}">
                        <input type="radio" id="size{{ $size->size }}" name="size"
                            onclick="getsize('{{ $size->id }}',{{ $size->SalePrice }})" value="{{ $size->id }}"
                            @if ($size_id == $size->id) checked @endif />
                        <label class="sizetext size__radio-label" id="sizetext{{ $size->size }}"
                            for="size{{ $size->size }}"
                            onclick="getsize('{{ $size->id }}',{{ $size->SalePrice }})">{{ $size->size }}</label>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@else
    @if (count($weights) > 0)
        <div class="u-s-m-b-10">
            <span class="pd-detail__label u-s-m-b-5">@lang("backend.Weight") :</span>
            <div class="pd-detail__size">
                @forelse ($weights as $weight)
                    <div class="size__radio">
                        <input type="hidden" name="regularpriceofweight"
                            id="regularpriceofweight{{ $weight->weight }}" value="{{ $weight->RegularPrice }}">
                        <input type="hidden" name="salepriceofweight" id="salepriceofweight{{ $weight->weight }}"
                            value="{{ $weight->SalePrice }}">
                        <input type="radio" class="m-0" hidden id="weight{{ $weight->weight }}" name="weight"
                            onclick="getweight('{{ $weight->id }}',{{ $weight->SalePrice }})"
                            @if ($weight_id == $weight->id) checked @endif value="{{ $weight->id }}">
                        <label class="weighttext size__radio-label" id="weighttext{{ $weight->weight }}"
                            for="weight{{ $weight->weight }}"
                            onclick="getweight('{{ $weight->id }}',{{ $weight->SalePrice }})">{{ $weight->weight }}</label>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    @endif
@endif
