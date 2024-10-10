<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('many_hotel_facility', function (Blueprint $table) {
            $table->foreignId('hotel_room_id')->constrained('hotel_rooms')->onDelete('cascade');
            $table->foreignId('hotel_facility_id')->constrained('hotel_facilities')->onDelete('cascade');
            $table->primary(['hotel_room_id', 'hotel_facility_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('many_hotel_facility');
    }
};
