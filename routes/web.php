<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelFacilityController;
use App\Http\Controllers\HotelRoomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

// Prefix 'hotels'
Route::prefix('hotels')->group(function () {
    Route::get('/', [FrontendController::class, 'search'])->name('frontend.hotels');
    Route::post('/search', [FrontendController::class, 'search_hotels'])->name('frontend.search.hotels');
    Route::get('/list/{keyword}', [FrontendController::class, 'list_hotels'])->name('frontend.hotels.list');
    Route::get('/details/{hotel:slug}', [FrontendController::class, 'hotel_details'])->name('frontend.hotels.details');
    Route::get('/{hotel:slug}/rooms', [FrontendController::class, 'hotel_details_rooms'])->name('frontend.hotels.rooms');
    Route::get('/{hotel:slug}/rooms/{hotel_room_slug}', [FrontendController::class, 'room_details'])->name('frontend.hotels.rooms.details');
});

Route::prefix('search')->group(function () {
    Route::get('/', [FrontendController::class, 'search'])->name('frontend.search');
    Route::post('/hotel', [FrontendController::class, 'search_hotel'])->name('frontend.search.hotel');
    Route::get('/list/{keyword}', [FrontendController::class, 'list_hotel'])->name('frontend.search.hotel.list');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:checkout hotels')->group(function () {
        Route::post('/hotels/{hotel:slug}/{hotel_room}/book', [FrontendController::class, 'hotel_room_book'])->name('frontend.hotel.room.book');
        Route::get('/book/payment/', [FrontendController::class, 'hotel_payment'])->name('frontend.hotel.book.payment');
        Route::put('/book/payment/store', [FrontendController::class, 'hotel_payment_store'])->name('frontend.hotel.book.payment.store');
        Route::get('/book/finish', [FrontendController::class, 'hotel_book_finish'])->name('frontend.hotel_finish');
    });


    Route::middleware('can:view hotel bookings')->group(function () {
        Route::get('/my-bookings', [BookingController::class, 'my_bookings'])->name('frontend.my-bookings');
        Route::get('/my-bookings/{hotel_booking}', [BookingController::class, 'booking_details'])->name('frontend.booking_details');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('frontend.settings');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware('can:manage cities')->group(function () {
            Route::resource('cities', CityController::class);
        });
        Route::middleware('can:manage countries')->group(function () {
            Route::resource('countries', CountryController::class);
        });

        Route::middleware('can:manage hotels')->group(function () {
            Route::resource('hotels', HotelController::class);
        });
        Route::middleware('can:manage hotels')->group(function () {
            Route::get('/add/room/{hotel:slug}', [HotelRoomController::class, 'create'])->name('hotel_rooms.create');
            Route::post('/add/room/{hotel:slug}/store', [HotelRoomController::class, 'store'])->name('hotel_rooms.store');
            Route::get('/hotel/{hotel:slug}/room/{hotel_room}/', [HotelRoomController::class, 'edit'])->name('hotel_rooms.edit');
            Route::put('/room/{hotel_room}/update', [HotelRoomController::class, 'update'])->name('hotel_rooms.update');
            Route::delete('/hotel/{hotel:slug}/delete/{hotel_room}', [HotelRoomController::class, 'destroy'])->name('hotel_rooms.destroy');
        });

        Route::middleware('can:manage hotel bookings')->group(function () {
            Route::resource('hotel_bookings', HotelBookingController::class);
        });

        Route::middleware('can:manage hotel facilities')->group(function () {
            Route::resource('hotel_facilities', HotelFacilityController::class);
        });
    });
});

require __DIR__ . '/auth.php';
