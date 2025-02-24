<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Api\Helpers as ApiResponse;


class SupplierController extends Controller
{
    public function list(Request $request){

        $suppliers = Supplier::get();
        return ApiResponse::list('Supplier List', $suppliers);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplierName' => 'required|string',
            'supplierPhone' => 'required',
            'supplierEmail' => 'required|email',
            'supplierAddress' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validation( $validator->errors()->all());
        }
        $validated = $validator->validate();


        $supplier = Supplier::create($validated);

        return ApiResponse::created( 'Supplier Created Successfully',$supplier);

    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'supplierName' => 'required|string',
            'supplierPhone' => 'required',
            'supplierEmail' => 'required|email',
            'supplierAddress' => 'required|string',
        ]);
        if ($validator->fails()) {
            return ApiResponse::validation( $validator->errors()->all());
        }
        $validated = $validator->validate();


        $supplier = Supplier::findOrFail($id);
        $supplier->update($validated);

        return ApiResponse::created( 'Supplier Updated Successfully',$supplier);

    }

    public function updatestatus(Request $request)
    {
        $supplier = Supplier::Where('id', $request->supplier_id)->first();
        $supplier->status = $request->status;
        $supplier->save();
        return ApiResponse::created( 'Status Updated Successfully',$supplier);

    }
    public function destroy(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier = $supplier->delete();
        return ApiResponse::created( 'Supplier Deleted Successfully',$supplier);
    }
}
