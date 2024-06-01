<?php

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

});


Route::group(['prefix'=>'favorites'],function (){

});

Route::group(['prefix'=>'airlines'],function (){

});
