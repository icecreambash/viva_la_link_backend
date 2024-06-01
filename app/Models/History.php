<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = true;

    protected $table = 'histories';

    protected $fillable = [
        'user_id',
        'time_search',
        'airline_id',
        'from_city_id',
        'ti_city_id',
    ];
}
