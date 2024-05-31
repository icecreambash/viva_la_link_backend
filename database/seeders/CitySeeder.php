<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Bangalore',
            'Chennai',
            'Delhi',
            'Hyderabad',
            'Kolkata',
            'Mumbai',
        ];

        foreach ($cities as $city)
        {
            if(!City::where('slug',Str::lower($city))->exists())
            {
                City::create(
                    [
                        'title' => $city,
                        'slug' => Str::lower($city)
                    ]
                );
            }
        }
    }
}
