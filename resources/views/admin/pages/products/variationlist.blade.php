@forelse ($variations as $variation)
    <tr class="tr-bg-2">
        <td>
            <a href="javascript:void(0)">{{ $variation->id }}</a>
        </td>
        <td>
            <img class="img-fluid" src="{{ asset( $variation->image) }}" alt="" />
        </td>
        <td>
            <span class="text-muted">{{ $variation->color }}</span>
        </td>
        <td>
            <span class="text-muted">{{ $variation->code }}</span>
        </td>
        <td>
            @forelse(App\Models\Size::where('varient_id',$variation->id)->get() as $size)
                <span class="text-muted">@lang("backend.Size"): {{ $size->size }}, @lang('backend.Regular Price'): {{ $size->RegularPrice }}, @lang("backend.Stock"): {{ $size->stock }}</span><br>
            @empty
                <span class="text-muted">@lang("backend.Nothing")</span>
            @endforelse
        </td>
        {{-- <td>
            @forelse(App\Models\Weight::where('varient_id',$variation->id)->get() as $weight)
                <span class="text-muted">Weight: {{ $weight->weight }}, Price: {{ $weight->SalePrice }}, Stock: {{ $weight->stock }}</span><br>
            @empty
                <span class="text-muted">Nothing</span>
            @endforelse
        </td> --}}
        <td>
            <button type="button" class="label gradient-10 rounded" data-id="{{$variation->id}}" data-status="{{ $variation->status }}" id="variationstatus">{{ $variation->status }}</button>
        </td>
        <td>
            <div class="dropdown-product-list">
                <button><i class="bi bi-three-dots dropdown-product-list"></i></button>
                <div id="myDropdown" class="dropdown-product-list-content">
                    <a type="button" class="label rounded variationDetails" href="javascript:void(0)"
                        data-id="{{ $variation->id }}" id="variationDetails"><span><i
                                class="fa-regular fa-eye mr-1"></i></span>@lang("backend.Details")</a>

                    <a type="button" class="label rounded" href="javascript:void(0)" id="variationEdit"
                        data-id="{{ $variation->id }}"><span><i
                                class="fa-solid fa-pen-to-square mr-1"></i></span>@lang("backend.Edit")</a>

                    <a type="button" class="label rounded confirmDelete" data-id="{{ $variation->id }}"
                        id="variationDelete" href="javascript:void(0)"><span><i
                                class="fa-regular fa-trash-can mr-1"></i></span>@lang("backend.Delete")</a>

                </div>
            </div>
        </td>
    </tr>
@empty
   @lang("backend.Not Found!")
@endforelse
