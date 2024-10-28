<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\VietMapProviders;
class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(VietMapProviders $vietnamMapService)
    {
        $this->VietMapProviders = $vietnamMapService;
    }
    public function index()
    {
        $provinces = $this->VietMapProviders->getProvinces();

        return view('admin.content.rooms.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = $this->VietMapProviders->getProvinces();

        return view('admin.content.rooms.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getDistricts($provinceId)
    {
        $districts = $this->vietnamMapService->getDistricts($provinceId);

        return response()->json($districts);
    }

    public function getWards($districtId)
    {
        $wards = $this->vietnamMapService->getWards($districtId);

        return response()->json($wards);
    }
}
