<!DOCTYPE html>
<html>

<head>
    <title>Product List PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4 pb4">
                <h1>{{ $title }}</h1>
                <p>{{ $date }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <tr>
                        <th>@lang('backend.ID')</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        @lang('backend.Image')
                        <th>Regular Price</th>
                        <th>Selling Price</th>
                        <th>Status</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ \App\Models\Admin\Category::where('id', $product->category_id)->first()->category_name }}
                            </td>
                            <td>
                                @php
                                    $image = \App\Models\Productvariation::where('product_id', $product->id)->first();
                                @endphp

                                @if (isset($image))
                                    <img src="{{ asset(\App\Models\Productvariation::where('product_id', $product->id)->first()->image) }}"
                                        style="height: 40px" alt="No Image" />;
                                @else
                                    <img src="{{ asset('public/dumy.jpg') }}" style="height: 40px" alt="No Image" />;
                                @endif
                            </td>
                            <td>
                                @php
                                    $size = \App\Models\Size::where('product_id', $product->id)->first();
                                @endphp


                                @if (isset($size))
                                    {{ $size->RegularPrice }}
                                @else
                                    @php
                                        $weight = \App\Models\Weight::where('product_id', $product->id)->first();
                                    @endphp
                                    @if (isset($weight))
                                        {{ $weight->RegularPrice }}
                                    @else
                                        Not Apply
                                    @endif
                                @endif
                            </td>
                            <td>@php
                                $size = \App\Models\Size::where('product_id', $product->id)->first();
                            @endphp


                                @if (isset($size))
                                    {{ $size->SalePrice }}
                                @else
                                    @php
                                        $weight = \App\Models\Weight::where('product_id', $product->id)->first();
                                    @endphp
                                    @if (isset($weight))
                                        {{ $weight->SalePrice }}
                                    @else
                                        Not Apply
                                    @endif
                                @endif
                            </td>
                            <td>{{ $product->status }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</body>

</html>
