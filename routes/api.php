<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'user'],function (){
    Route::post('login',[UserController::class,'login']);
    Route::post('register',[UserController::class,'register']);
    Route::get('/',[UserController::class,'getMe']);
});
