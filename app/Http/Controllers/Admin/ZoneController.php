<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;
use DataTables;
use App\Models\City;
use App\Models\Courier;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couriers = Courier::where('status', 'Active')->where('hasZone', 'on')->get();
        $cities = City::where('status', 'Active')->get();
        return view('admin.pages.zone.index', ['couriers' => $couriers, 'cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function zonedata()
    {
        // zones data table data
        $zones = Zone::with(['couriers', 'cities']);
        return Datatables::of($zones)
            ->addColumn('action', function ($cities) {
                return '<span type="button" class="label gradient-11 rounded" id="editZoneBtn" data-id="' . $cities->id . '" data-bs-toggle="modal" data-bs-target="#editmainZone"><i class="fa-solid fa-pen-to-square" ></i></span>
            <span type="button" class="label gradient-12 rounded" id="deleteZoneBtn" data-id="' . $cities->id . '"><i class="fa-regular fa-trash-can"></i></span>';
            })
            ->make(true);
    }

    public function getZoneByCurier($id)
    {
        $zones = Zone::Where('courier_id', $id)->get();
        return response()->json($zones, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zone = Zone::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Zone Insert Successfully!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zone = Zone::findOrfail($id);
        return response()->json($zone, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $zone = Zone::findOrfail($id)->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Zone Updated Successfully!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zone = Zone::findOrfail($id);
        $zone->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Zone Delete Successfully!'
        ], 200);
    }

    public function updatestatus(Request $request)
    {

        $zone = Zone::Where('id', $request->zone_id)->first();
        $zone->status = $request->status;
        $zone->update();

        return response()->json([
            'status' => 'success',
            'message' => 'Zone Status Updated!'
        ], 200);
    }
}
