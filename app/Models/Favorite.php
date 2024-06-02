<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory, HasUuids;


    public $timestamps = true;

    protected $table = 'favorites';

    protected $fillable = [
        'user_id',
        'ticket_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoriteable()
    {
        return $this->morphTo('favoriteable');
    }
}
