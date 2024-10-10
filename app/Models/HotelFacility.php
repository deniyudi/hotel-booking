<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelFacility extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'icon',
        'description',
    ];

    public function rooms()
    {
        return $this->belongsToMany(HotelRoom::class, 'many_hotel_facility', 'hotel_facility_id', 'hotel_room_id');
    }
}
