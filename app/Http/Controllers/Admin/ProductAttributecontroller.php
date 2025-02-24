<?php

namespace App\Http\Controllers\Admin;

use Exception;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Brian2694\Toastr\Facades\Toastr;
use App\Models\Admin\ProductAttribute;
use App\Models\AttributeName;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductAttribute as ModelsProductAttribute;

class ProductAttributecontroller extends Controller
{

    public function index()
    {
        $productattribute = ProductAttribute::get();
        $attributenames = AttributeName::orderBy('id', 'desc')->get();
        return view('admin.pages.product-attribute.index', compact('productattribute', 'attributenames'));
    }
    public function productattributeAjraTable(Request $request)
    {
        if ($request->ajax()) {
            $data = ModelsProductAttribute::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="dropdown-product-list">
                            <button><i class="bi bi-three-dots dropdown-product-list"></i></button>
                            <div id="myDropdown" class="dropdown-product-list-content">

                              <a type="button" class="label rounded"
                            href="javascript:void(0)" id="productAttributeEditButton" data-id="' . $data->id . '"><span
                                ><i
                                  class="fa-solid fa-pen-to-square mr-1"
                                ></i
                              ></span>' . __('backend.Edit') . '</a>

                            </div>
                          </div>';
                    return $btn;
                })
                ->addColumn('attributeName', function ($data) {
                    return $data->attributeName->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function attributeName()
    {
        $attributenames = AttributeName::orderBy('id', 'desc')->get();
        return view('admin.pages.product-attribute.attribute-name', compact('attributenames'));
    }
    public function attributeNameYjraTable(Request $request)
    {
        if ($request->ajax()) {
            $data = AttributeName::orderBy('id', 'desc')->get();
            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="dropdown-product-list">
                            <button><i class="bi bi-three-dots dropdown-product-list"></i></button>
                            <div id="myDropdown" class="dropdown-product-list-content">

                              <a type="button" class="label rounded"
                            href="javascript:void(0)" id="productAttributeEditButtonName" data-id="' . $data->id . '"><span
                                ><i
                                  class="fa-solid fa-pen-to-square mr-1"
                                ></i
                              ></span>' . __('backend.Edit') . '</a>

                               

                            </div>
                          </div>';
                    return $btn;
                })
                // ->addColumn('action', function ($data) {
                //     $btn = '<div class="dropdown-product-list">
                //             <button><i class="bi bi-three-dots dropdown-product-list"></i></button>
                //             <div id="myDropdown" class="dropdown-product-list-content">

                //               <a type="button" class="label rounded"
                //             href="javascript:void(0)" id="productAttributeEditButtonName" data-id="' . $data->id . '"><span
                //                 ><i
                //                   class="fa-solid fa-pen-to-square mr-1"
                //                 ></i
                //               ></span>' . __('backend.Edit') . '</a>

                //                 <a  type="button" class="label rounded confirmDelete" data-id="' . $data->id . '" id="productAttributeNameDeleteButton" href="javascript:void(0)"><span
                //                     ><i
                //                     class="fa-regular fa-trash-can mr-1"
                //                     ></i
                //                 ></span>'.__('backend.Delete').'</a>

                //             </div>
                //           </div>';
                //     return $btn;
                // })
                ->rawColumns(['action'])
                ->make(true);
        }
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
            $pratt->attribute_name_id = $request->value;

            if ($request->value == 1) {
                $pratt->color_code = $request->color_code;
            }
            $pratt->save();
        } catch (Exception $e) {

            return "Oops! Something went wrong. Please try again";
        }
        Toastr::success(__('frontend.Product Attribute Created Successfully!'));
        return back();
    }
    public function edit($id)
    {
        $productattribute = ProductAttribute::findOrFail($id);
        return response()->json($productattribute, 200);
    }
    public function update(Request $request, string $id)
    {
        $attribute = ProductAttribute::findOrFail($id);
        $attribute->name = $request->name;
        $attribute->value = $request->value;
        if ($request->value == 1) {
            $attribute->color_code = $request->color_code;
        }
        $attribute->update();

        return response()->json([
            'status' => 'success',
            'message' =>__("frontend.Product Attribute Updated Successfully!")
        ]);
    }
    public function destroy($id)
    {
        $subcategory = ProductAttribute::findOrFail($id);
        $subcategory->delete();
        return response()->json([
            'status' => 'success',
            'message' =>__("frontend.Product Attribute Delete Successfully!")
        ], 200);
    }
    public function attributeNameEdit($id)
    {
        $productattributename = AttributeName::findOrFail($id);

        return response()->json($productattributename, 200);
    }
    public function attributeNameUpdate(Request $request, string $id)
    {
        $subcategory = AttributeName::findOrFail($id);

        $subcategory->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' =>__("frontend.Product Attribute Updated Successfully!")
        ]);
    }
    public function attributeNameDestroy($id)
    {
        $subcategory = AttributeName::findOrFail($id);
        $subcategory->delete();
        return response()->json([
            'status' => 'success',
            'message' =>__("frontend.Product Attribute Updated Successfully!")
        ], 200);
    }
}
