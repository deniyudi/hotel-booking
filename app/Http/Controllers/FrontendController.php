<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchHotelBookingRequest;
use App\Http\Requests\StoreHotelBookingRequest;
use App\Http\Requests\StorePaymentBookingRequest;
use App\Http\Requests\StoreSearchHotelRequest;
use App\Models\City;
use App\Models\Hotel;
use App\Models\HotelBooking;
use App\Models\HotelRoom;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        $cities = City::orderByDesc('id')->limit(10)->get();
        $hotels = Hotel::inRandomOrder()->limit(3)->get();
        return view('frontend.index', ['hotels' => $hotels, 'cities' => $cities]);
    }

    public function hotels()
    {
        return view('frontend.hotel.hotels');
    }

    public function search_hotels(StoreSearchHotelRequest $request)
    {

        $request->session()->put('checkin_at', $request->input('checkin_at'));
        $request->session()->put('checkout_at', $request->input('checkout_at'));
        $request->session()->put('keyword', $request->input('keyword'));

        $keyword = $request->session()->get('keyword');

        return redirect()->route('frontend.hotels.list', ['keyword' => $keyword]);
    }


    public function list_hotels($keyword)
    {
        $hotels = Hotel::with(['rooms', 'city', 'country'])

            ->whereHas('country', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })

            ->orWhereHas('city', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })

            ->orWhere('name', 'like', '%' . $keyword . '%')

            ->get();

        return view('frontend.hotel.list_hotels', compact('hotels', 'keyword'));
    }

    public function hotel_details(Hotel $hotel)
    {
        $latestPhotos = $hotel->photos()->orderByDesc('id')->take(3)->get();
        return view('frontend.hotel.hotels_detail', compact('hotel', 'latestPhotos'));
    }

    public function hotel_details_rooms(Hotel $hotel)
    {
        return view('frontend.hotel.rooms.list_hotels_room', compact('hotel'));
    }

    public function room_details(Hotel $hotel, $hotel_room_slug)
    {
        $hotel_room = HotelRoom::where('slug', $hotel_room_slug)->firstOrFail();

        return view('frontend.hotel.rooms.room_detail', compact('hotel', 'hotel_room'));
    }

    public function hotel_room_book(StoreHotelBookingRequest $request, Hotel $hotel, $hotel_room_slug)
    {
        $hotel_room = HotelRoom::where('slug', $hotel_room_slug)->firstOrFail();

        $checkin_at = $request->input('checkin_at');
        $checkout_at = $request->input('checkout_at');

        do {
            $randomId = random_int(100000, 999999);
        } while (HotelBooking::where('id', $randomId)->exists());

        // Simpan informasi booking di session
        session([
            'hotel_booking_data' => [
                'random_id' => $randomId,
                'checkin_at' => $checkin_at,
                'checkout_at' => $checkout_at,
                'hotel_id' => $hotel->id,
                'hotel_room' => [
                    'id' => $hotel_room->id,
                    'name' => $hotel_room->name,
                    'price' => $hotel_room->price,
                    'total_people' => $hotel_room->total_people,
                    'photo' => $hotel_room->photo
                ],
                'total_days' => \Carbon\Carbon::parse($checkin_at)->diffInDays($checkout_at),
                'total_amount' => $hotel_room->price * \Carbon\Carbon::parse($checkin_at)->diffInDays($checkout_at),
            ],
        ]);


        return redirect()->route('frontend.hotel.book.payment');
    }



    public function hotel_payment(HotelBooking $hotel_booking)
    {
        $user = Auth::user();
        return view('frontend.booking.book_payment', compact('hotel_booking', 'user'));
    }

    public function hotel_payment_store(StorePaymentBookingRequest $request, HotelBooking $hotel_booking = null)
    {
        $user = Auth::user();

        $hotelBookingData = session('hotel_booking_data');
        if (!$hotelBookingData) {
            return redirect()->route('frontend.hotels')->with('error', 'Data booking tidak ditemukan.');
        }

        DB::transaction(function () use ($request, $user, $hotelBookingData, &$hotel_booking) {
            $validated = $request->validated();

            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $file = $request->file('proof');
            $namePath = 'proof';

            $upload = Helper::uploadToCloudinary($file, $namePath);
            $validated['proof'] = $upload;

            // Tambahkan data yang diperlukan untuk booking
            $validated['user_id'] = $user->id;
            $validated['hotel_id'] = $hotelBookingData['hotel_id'];
            $validated['hotel_room_id'] = $hotelBookingData['hotel_room']['id'];
            $validated['checkin_at'] = $hotelBookingData['checkin_at'];
            $validated['checkout_at'] = $hotelBookingData['checkout_at'];
            $validated['total_days'] = $hotelBookingData['total_days'];
            $validated['total_amount'] = $hotelBookingData['total_amount'];
            $validated['is_paid'] = false;

            $validated['id'] = $hotelBookingData['random_id'];

            // Buat booking baru
            $hotel_booking = HotelBooking::create($validated);
        });

        // Hapus data booking dari session setelah berhasil disimpan
        session()->forget('hotel_booking_data');

        return redirect()->route('frontend.hotel_finish');
    }



    public function hotel_book_finish()
    {
        return view('frontend.booking.book_finish');
    }

    //======== SEARCH ============


    public function search()
    {
        return view('frontend.search.hotel_search');
    }

    public function search_hotel(SearchHotelBookingRequest $request)
    {
        // $request->session()->put('checkin_at', $request->input('checkin_at'));
        // $request->session()->put('checkout_at', $request->input('checkout_at'));
        $request->session()->put('total_people', $request->input('total_people'));
        $request->session()->put('keyword', $request->input('keyword'));

        $keyword = $request->session()->get('keyword');

        return redirect()->route('frontend.search.hotel.list', ['keyword' => $keyword]);
    }

    public function list_hotel($keyword)
    {

        $totalPeople = session('total_people');

        $hotels = Hotel::with(['rooms', 'city', 'country'])

            ->where(function ($query) use ($keyword) {
                // Filter berdasarkan negara
                $query->whereHas('country', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                })
                    // Filter berdasarkan kota
                    ->orWhereHas('city', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    })
                    // Filter berdasarkan nama hotel
                    ->orWhere('name', 'like', '%' . $keyword . '%');
            })

            // Filter untuk memastikan ada kamar yang dapat menampung total_people
            ->whereHas('rooms', function ($query) use ($totalPeople) {
                $query->where('total_people', '>=', $totalPeople); // Mencari kapasitas yang tepat
            })


            ->get();

        return view('frontend.hotel.list_hotels', compact('hotels', 'keyword'));
    }
}
