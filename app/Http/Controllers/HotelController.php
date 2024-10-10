<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $hotels = Hotel::with('rooms')->orderByDesc('id')->paginate(10);
        return view('admin.hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::orderByDesc('id')->get();
        $cities = City::orderByDesc('id')->get();

        return view('admin.hotels.create', compact('countries', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHotelRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            // Upload thumbnail ke folder 'hotel/thumbnails/'
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = 'hotel/thumbnails';
            $uploadThumbnail = Helper::uploadToCloudinary($thumbnail, $thumbnailPath);
            $validated['thumbnail'] = $uploadThumbnail;

            // Generate slug dari nama hotel
            $validated['slug'] = Str::slug($validated['name']);

            // Simpan data hotel ke database
            $hotel = Hotel::create($validated);

            if ($request->hasFile('photos')) {
                $photosPath = 'hotel/photos';
                $uploadedPhotos = Helper::uploadMultipleFilesToCloudinary($request->file('photos'), $photosPath);

                // Simpan setiap file photo ke database menggunakan relasi photos()
                foreach ($uploadedPhotos as $photoUrl) {
                    $hotel->photos()->create([
                        'photo' => $photoUrl
                    ]);
                }
            }

            // Cek apakah ada file photos yang diunggah
        });

        return redirect()->route('admin.hotels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        $latestPhotos = $hotel->photos()->orderByDesc('id')->take(3)->get();
        return view('admin.hotels.show', compact('hotel', 'latestPhotos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        // dd($hotel);
        $countries = Country::orderByDesc('id')->get();
        $cities = City::orderByDesc('id')->get();
        $latestPhotos = $hotel->photos()->orderByDesc('id')->take(3)->get();

        return view('admin.hotels.edit', compact('hotel', 'countries', 'cities', 'latestPhotos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        DB::transaction(function () use ($request, $hotel) {
            $validated = $request->validated();

            $validated['slug'] = Str::slug($validated['name']);
            // Update thumbnail jika ada file baru
            if ($request->hasFile('thumbnail')) {

                // Upload thumbnail yang baru
                $thumbnailPath = 'hotel/thumbnails';
                $uploadThumbnail = Helper::updateCloudinaryFile($request->file('thumbnail'), $hotel->thumbnail, $thumbnailPath);
                $validated['thumbnail'] = $uploadThumbnail;
            }

            // Update slug

            // Update hotel dengan data validasi
            $hotel->update($validated);

            // Update multiple photos
            if ($request->file('photos')) {
                // Loop melalui setiap foto lama dan hapus dari Cloudinary
                foreach ($hotel->photos as $existingPhoto) {
                    // Menggunakan Helper::updateCloudinaryFile untuk menghapus foto lama dari Cloudinary
                    Helper::updateCloudinaryFile(null, $existingPhoto->photo, 'hotel/photos');
                }

                // Hapus semua foto lama dari database
                $hotel->photos()->delete();

                // Simpan foto baru dengan menggunakan Helper::updateCloudinaryFile
                $photosPath = 'hotel/photos';
                foreach ($request->file('photos') as $photo) {
                    // Upload foto baru dan dapatkan URL secure
                    $uploadedPhotoUrl = Helper::updateCloudinaryFile($photo, null, $photosPath);
                    $hotel->photos()->create([
                        'photo' => $uploadedPhotoUrl,
                    ]);
                }
            }
        });

        return redirect()->route('admin.hotels.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        DB::transaction(function () use ($hotel) {

            $hotel->delete();
        });

        return redirect()->route('admin.hotels.index');
    }
}
