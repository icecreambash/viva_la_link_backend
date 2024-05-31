<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            'AI',
            'UK',
            '2T',
            '6E',
            'G8',
            'I5',
            'S5',
            'SG',
        ];

        foreach ($countries as $country) {
            if (!Country::where('code', Str::lower($country))->exists()) {
                Country::create(
                    [
                        'title' => $country,
                        'code' => Str::lower($country),
                        'slug' => Str::lower($country)
                    ]
                );
            }
        }
    }
}
