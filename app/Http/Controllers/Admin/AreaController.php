<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Courier;
use App\Models\Zone;
use DataTables;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couriers = Courier::where('status', 'Active')->get();
        $zones = Zone::where('status', 'Active')->get();
        return view('admin.pages.area.index', ['couriers' => $couriers, 'zones' => $zones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function areadata()
    {
        $areas = Area::with(['couriers', 'zones']);
        return Datatables::of($areas)
            ->addColumn('action', function ($cities) {
                return '<span type="button" class="label gradient-11 rounded" id="editAreaBtn" data-id="' . $cities->id . '" data-bs-toggle="modal" data-bs-target="#editmainArea"><i class="fa-solid fa-pen-to-square" ></i></span>
            <span type="button" class="label gradient-12 rounded" id="deleteAreaBtn" data-id="' . $cities->id . '"><i class="fa-regular fa-trash-can"></i></span>';
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $area = Area::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => __('backend.Area Stored Successfully!'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::findOrfail($id);
        return response()->json($area, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $area = Area::findOrfail($id)->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => __('backend.Area Updated Successfully!'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::findOrfail($id);
        $area->delete();
        return response()->json([
            'status' => 'success',
            'message' => __('backend.Area Deleted Successfully!'),
        ]);
    }
}
