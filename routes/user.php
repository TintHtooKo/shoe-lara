<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'user'],function(){
    Route::get('dashboard',[UserController::class,'UserHome'])->name('User#Home');
    Route::get('contact',[UserController::class,'UserContact'])->name('User#Contact');
    Route::get('shop',[UserController::class,'UserShop'])->name('User#Shop');
    Route::get('cart',[UserController::class,'UserCart'])->name('User#Cart');
}); 