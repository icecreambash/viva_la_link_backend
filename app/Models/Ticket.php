<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tickets';

    protected $fillable = [
        'airline_id',
        'code',
        'flight_time',
        'start_city_id',
        'end_city_id',
        'count_step',
        'country_id',
        'price',
        'is_reserved',
        'category_id',
        'start_time',
        'start_fly',
        'end_fly'
    ];

    protected $casts = [
        'flight_time' => 'datetime:H:i',
        'is_reserved' => 'boolean',
        'start_fly' => 'datetime',
        'end_fly' => 'datetime',
        'start_time' => 'datetime',
        'price' => 'float'
    ];
}
