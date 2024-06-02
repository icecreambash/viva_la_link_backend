<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'cities';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
    ];

    public function ticketsStart(): HasMany
    {
        return $this->hasMany(Ticket::class,'start_city_id');
    }

    public function ticketsEnd(): HasMany {
        return $this->hasMany(Ticket::class,'end_city_id');
    }
}
