<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\StoreCityRequest;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cities = City::orderByDesc('id')->paginate(10);
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        // 1. Validasi data dari request form
        // 2. mulai insert ke db
        // 3. redirect ke list city

        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $validated['slug'] = Str::slug($validated['name']);

            $file = $request->file('photo');
            $namePath = 'city';

            // Menggunakan helper untuk upload ke Cloudinary
            $upload = Helper::uploadToCloudinary($file, $namePath);
            $validated['photo'] = $upload;

            City::create($validated);
        });

        return redirect()->route('admin.cities.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    private function generateFolderCloudinary($folder)
    {
        return 'hotelbookings/' . $folder . '/';
    }

    public function update(StoreCityRequest $request, City $city)
    {
        DB::transaction(function () use ($request, $city) {
            $validated = $request->validated();

            if (!isset($validated['name']) || $validated['name'] === $city->name) {
                $validated['name'] = $city->name;
            } else {
                $validated['slug'] = Str::slug($validated['name']);
            }

            if ($request->hasFile('photo')) {
                $namePath = 'city';

                $newPhotoUrl = Helper::updateCloudinaryFile($request->file('photo'), $city->photo, $namePath);

                $validated['photo'] = $newPhotoUrl;
            }

            $city->update($validated);
        });

        return redirect()->route('admin.cities.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        DB::transaction(function () use ($city) {

            $city->delete();
        });

        return redirect()->route('admin.cities.index');
    }
}
