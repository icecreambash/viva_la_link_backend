<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'categories_count' => \App\Models\Ticket::query()->count(),
    ];
});
