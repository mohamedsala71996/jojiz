<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\ProductAttribute;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\AttributeName;

class AttributeValueController extends Controller
{
    public function list(){
        $attributes = ProductAttribute::get();
        $attributeNameList = AttributeName::get();
        $data = [
            'attributeName' => $attributeNameList,
            'attributes' => $attributes,
        ];
        return ApiResponse::list('Product Attribute List', $data);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'value' => 'required|integer',
        ])->validate();
        try {
            $pratt = new ProductAttribute();
            $pratt->name = $request->name;
            $pratt->value = $request->value;
            if ($request->value == 1) {
                $pratt->color_code = $request->color_code;
            }
            $pratt->save();
        } catch (Exception $e) {

            return "Oops! Something went wrong. Please try again";
        }
        return ApiResponse::created('Attribute Added Successfully', $pratt);
    }

    public function update(Request $request, string $id)
    {
        $pratt = ProductAttribute::findOrFail($id);
        $pratt->name = $request->name;
        $pratt->value = $request->value;
        if ($request->value == 1) {
            $pratt->color_code = $request->color_code;
        }
        $pratt->update();

        return ApiResponse::created('Attribute Updated Successfully', $pratt);
    }

    public function nameList(){
        $attributeNameList = AttributeName::get();
        return ApiResponse::list('Attribute Name List', $attributeNameList);
    }
}
