<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'address',
        'link_gmaps',
        'star_level',
        'country_id',
        'city_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug'; // menggunakan slug sebagai route key
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function photos()
    {
        return $this->hasMany(HotelPhoto::class);
    }

    public function rooms()
    {
        return $this->hasMany(HotelRoom::class, 'hotel_id');
    }

    public function getLowestRoomPrice()
    {
        $minPrice = $this->rooms()->min('price');
        return $minPrice ?? 0; //cek harga apabila gaada harga maka kosong misal ada maka ditampilin yang paling terkecil
    }
}
