<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar negara ASEAN
        $countries = [
            'Indonesia',
            'Malaysia',
            'Singapore',
            'Thailand',
            'Philippines',
            'Vietnam',
            'Brunei',
            'Laos',
            'Myanmar',
            'Cambodia',
            'Timor-Leste',
        ];

        // Insert countries into the database with slug
        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['name' => $country],
                ['slug' => Str::slug($country)] // Membuat slug dari nama negara
            );
        }

        // Daftar kota besar di Indonesia dengan photo dan slug
        $cities = [
            ['name' => 'Jakarta', 'photo' => 'https://res.cloudinary.com/dmtfmri3s/image/upload/v1728546829/hotelbookings/city/ex36q8zpordyyyq8til5.jpg'],
            ['name' => 'Surabaya', 'photo' => 'https://res.cloudinary.com/dmtfmri3s/image/upload/v1728546829/hotelbookings/city/tgekhnmnne0kjxy68sni.jpg'],
            ['name' => 'Bandung', 'photo' => 'https://res.cloudinary.com/dmtfmri3s/image/upload/v1728546828/hotelbookings/city/qadufhkifdmn6hi752az.jpg'],
            ['name' => 'Malang', 'photo' => 'https://res.cloudinary.com/dmtfmri3s/image/upload/v1728546828/hotelbookings/city/pcsid3gvnuhvpr3hqpmc.jpg'],
            ['name' => 'Yogyakarta', 'photo' => 'https://res.cloudinary.com/dmtfmri3s/image/upload/v1728546829/hotelbookings/city/che81o9w06wcjqbxmqom.jpg'],
            ['name' => 'Bekasi', 'photo' => 'https://res.cloudinary.com/dmtfmri3s/image/upload/v1728546829/hotelbookings/city/y7cvceyifhn5lx41efjs.jpg'],
        ];

        // Insert cities into the database with slug
        foreach ($cities as $city) {
            City::updateOrCreate(
                ['name' => $city['name']],
                [
                    'photo' => $city['photo'],
                    'slug' => Str::slug($city['name']), // Membuat slug dari nama kota
                ]
            );
        }
    }
}
