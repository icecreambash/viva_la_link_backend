<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'user'],function (){
    Route::post('login',[UserController::class,'login']);
    Route::post('register',[UserController::class,'register']);
    Route::get('/',[UserController::class,'getMe']);
    Route::patch('/',[UserController::class,'patchMe']);
});


Route::group(['prefix'=>'users','middleware'=>['auth:sanctum']],function (){
    Route::get('/',[UsersController::class,'getUserList']);
});

Route::group(['prefix'=>'tickets'],function (){
    Route::get('/',[TicketController::class,'getTickets']);
    Route::get('filters',[TicketController::class,'getFiltersForTickets']);
});

Route::group(['prefix'=>'trips'],function (){
    Route::get('liquid-ways',[TripController::class,'getLiquidWays']);
});


Route::group(['prefix'=>'favorites','middleware'=>['auth:sanctum']],function (){
    Route::get('/',[FavoriteController::class,'getFavorites']);
    Route::put('/',[FavoriteController::class,'toggleFavorite']);
});


Route::group(['prefix'=>'airlines'],function (){
    Route::get('/',[AirlineController::class,'getAirlines']);
});
