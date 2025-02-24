<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Courier;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couriers =Courier::where('status', 'Active')->where('hasCity','on')->get();
        return view('admin.pages.city.index',['couriers'=> $couriers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function citydata()
    {
        // cities data table data
        $cities = City::with('couriers')->get();
        return Datatables::of($cities)
            ->addColumn('action', function ($cities) {
                return '<span type="button" class="label gradient-11 rounded" id="editCityBtn" data-id="' . $cities->id . '" data-bs-toggle="modal" data-bs-target="#editmainCity"> <i class="fa-solid fa-pen-to-square" ></i></span>
                <span type="button" class="label gradient-12 rounded" id="deleteCityBtn" data-id="' . $cities->id . '"> <i class="fa-regular fa-trash-can"></i></span>';
            })
            ->make(true);
    }

    public function getCityByCurier($id)
    {
        $citys =City::Where('courier_id',$id)->get();
        return response()->json($citys ,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city =City::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => __('backend.City Insert Successfully!')
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::findOrfail($id);
        return response()->json($city, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $city = City::findOrfail($id)->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' =>__('backend.City Updated Successfully!')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrfail($id);
        $city->delete();
        return response()->json([
            'status' => 'success',
            'message' => __('backend.City Delete Successfully!')
        ], 200);
    }

    public function updatestatus(Request $request)
    {

        $courier = City::Where('id', $request->city_id)->first();
        $courier->status = $request->status;
        $courier->update();

        return response()->json([
            'status' => 'success',
            'message' => __('backend.City Status Updated!')
        ], 200);
    }

}
