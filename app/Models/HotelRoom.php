<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hotel_id',
        'name',
        'slug',
        'price',
        'total_people',
        'photo',
    ];


    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }


    public function facilities()
    {
        return $this->belongsToMany(HotelFacility::class, 'many_hotel_facility', 'hotel_room_id', 'hotel_facility_id');
    }
}
