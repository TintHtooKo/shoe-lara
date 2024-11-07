<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'user'],function(){
    Route::get('dashboard',[UserController::class,'UserHome'])->name('User#Home');

    Route::get('contact',[UserController::class,'UserContact'])->name('User#Contact');
    Route::post('contact/send',[ContactController::class,'contentSend'])->name('User#ContactSend');

    Route::get('shop',[UserController::class,'UserShop'])->name('User#Shop');
    Route::get('product/{id}',[UserController::class,'productDetail'])->name('User#productDetail');

    Route::group(['prefix'=>'cart','middleware'=>'user'],function(){
        Route::get('cart',[CartController::class,'UserCart'])->name('User#Cart');
        Route::post('cart',[CartController::class,'addToCart'])->name('User#CartAdd');
    });
}); 