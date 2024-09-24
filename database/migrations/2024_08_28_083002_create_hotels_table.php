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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->string('address');
            $table->string('link_gmaps');
            $table->unsignedBigInteger('star_level'); //tidak bisa negatif(harus positif)
            $table->foreignId('city_id')->constrained()->onDelete('cascade'); // untuk kayak gini city_id jadi harus sama sama modelnya jadi gaperlu nambahin reference
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
