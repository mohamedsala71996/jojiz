<?php

namespace App\Exports;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Order;
use App\Models\Size;
use App\Models\Weight;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithHeadings, WithMapping
{

    use Exportable;
    private $status;
    private $category_id;

    public function __construct($status, $category_id)
    {
        $this->status = $status;
        $this->category_id = $category_id;
    }


    public function map($products): array
    {
        $reg = Size::where('product_id', $products->id)->first();
        if (isset($reg)) {
            $reqularprice = $reg->RegularPrice;
        } else {
            $pricess = Weight::where('product_id', $products->id)->first();
            if (isset($pricess)) {
                $reqularprice = $pricess->RegularPrice;
            } else {
                $reqularprice = 'Not apply';
            }
        }

        $sale = Size::where('product_id', $products->id)->first();
        if (isset($sale)) {
            $saleprice = $sale->SalePrice;
        } else {
            $saless = Weight::where('product_id', $products->id)->first();
            if (isset($saless)) {
                $saleprice = $saless->SalePrice;
            } else {
                $saleprice = 'Not apply';
            }
        }

        return [
            $products->id,
            $products->product_name,
            $products->product_sku,
            Category::where('id', $products->category_id)->first()->category_name,
            $reqularprice,
            $saleprice,
            $products->status,
        ];
    }

    public function collection()
    {
        $status = $this->status;
        $category_id = $this->category_id;
        if ($status == 'All' && $category_id == 'All') {
            $products = Product::all();
        } else {
            if ($status == 'All' && $category_id != 'All') {
                $products = Product::where('category_id', $category_id)->get();
            } else {
                if ($status != 'All' && $category_id == 'All') {
                    $products = Product::where('status', $status)->get();
                } else {
                    if ($status != 'All' && $category_id != 'All') {
                        $products = Product::where('status', $status)->where('category_id', $category_id)->get();
                    } else {
                        $products = Product::all();
                    }
                }
            }
        }
        return $products;
    }


    public function headings(): array
    {

        return ["ID", "Product Name", "Product Sku", "Category", "Regular Price", "Selling Price", "Status"];
    }
}
