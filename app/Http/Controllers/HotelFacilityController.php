<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelFacilityRequest;
use App\Models\HotelFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotel_facilities = HotelFacility::all();

        return view('admin.hotel_facilities.index', compact('hotel_facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hotel_facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHotelFacilityRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $newHotelFacility = HotelFacility::create($validated);
        });

        return redirect()->route('admin.hotel_facilities.index');
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
}
