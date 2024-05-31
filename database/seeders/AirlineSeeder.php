<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collection = [
            'Air India',
            'Vistara',
            'Go First',
            'Indigo',
            'SpiceJet',
            'StarAir',
            'Trujet',
            'Air Asia',
        ];

        foreach ($collection as $collect)
        {
            $shortname = Str::lower(str_replace(' ','',$collect));

            if(!Airline::where('slug',$shortname)->exists())
            {
                Airline::create(
                    [
                        'title' => $collect,
                        'slug' => $shortname,
                    ]
                );
            }
        }
    }
}
