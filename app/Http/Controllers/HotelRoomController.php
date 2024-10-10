<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Hotel;
use App\Models\HotelFacility;
use App\Models\HotelRoom;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HotelRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Hotel $hotel)
    {
        $facilities = HotelFacility::all();
        return view('admin.hotel_rooms.create', compact('hotel', 'facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request, Hotel $hotel)
    {

        //closure-based transaction
        DB::transaction(function () use ($request, $hotel) {
            $validated = $request->validated();

            $photo = $request->file('photo');
            $photoPath = 'hotel/rooms';
            $uploadPhoto = Helper::uploadToCloudinary($photo, $photoPath);
            $validated['photo'] = $uploadPhoto;

            $validated['hotel_id'] = $hotel->id; //tambahan array validasi, dapet dari param controller
            $validated['slug'] = Str::slug($validated['name']);
            $room = HotelRoom::create($validated);

            if ($request->has('facilities')) {
                $room->facilities()->attach($request->facilities); // Pastikan 'facilities' adalah array dari ID fasilitas
            }
        });

        return redirect()->route('admin.hotels.show', $hotel->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(HotelRoom $hotelRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel, HotelRoom $hotelRoom)
    {
        // dd($hotelRoom);
        $facilities = HotelFacility::all();
        return view('admin.hotel_rooms.edit', compact('hotel', 'hotelRoom', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, HotelRoom $hotelRoom)
    {
        DB::transaction(function () use ($request, $hotelRoom) {
            $validated = $request->validated();

            if ($request->hasFile('photo')) {
                $photoPath =
                    $request->file('photo')->store('photos/' . date("Y/m/d"), 'public');
                $validated['photo'] = $photoPath;
            }
            if ($request->hasFile('photo')) {
                $namePath = 'hotel/rooms';

                $newPhotoUrl = Helper::updateCloudinaryFile($request->file('photo'), $hotelRoom->photo, $namePath);

                $validated['photo'] = $newPhotoUrl;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $hotelRoom->update($validated);

            if ($request->has('facilities')) {
                // Sync facilities, if you are using a many-to-many relationship
                $hotelRoom->facilities()->sync($request->facilities);
            } else {
                // Clear existing facilities if none selected
                $hotelRoom->facilities()->sync([]);
            }
        });

        return redirect()->route('admin.hotels.show', $hotelRoom->hotel->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel, HotelRoom $hotelRoom)
    {
        DB::transaction(function () use ($hotel, $hotelRoom) {

            $hotelRoom->delete();
        });

        return redirect()->route('admin.hotels.show', $hotel->id);
    }
}
