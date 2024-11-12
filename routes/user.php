<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\User\ProfileController;
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
        Route::get('cart/delete/{id}',[CartController::class,'deleteCart'])->name('User#CartDelete');
        Route::get('cart/temp',[CartController::class,'cartTemp'])->name('User#CartTemp');
    });

    Route::group(['prefix'=>'payment','middleware'=>'user'],function(){
        Route::get('',[UserController::class,'UserCheckoutPage'])->name('User#CheckoutPage');
        Route::post('',[UserController::class,'UserCheckout'])->name('User#Checkout');
        Route::get('success',[UserController::class,'Success'])->name('User#Success');
    });

    Route::group(['prefix'=>'profile','middleware'=>'user'],function(){
        Route::get('',[ProfileController::class,'profilePage'])->name('User#profile');
        Route::get('update',[ProfileController::class,'profileUpdatePage'])->name('User#profileUpdatePage');
        Route::post('update',[ProfileController::class,'profileUpdate'])->name('User#profileUpdate');
        Route::get('changePassword',[ProfileController::class,'changePasswordPage'])->name('User#changePasswordPage');
        Route::post('changePassword',[ProfileController::class,'changePassword'])->name('User#changePassword');
    });

    Route::post('comment',[CommentController::class,'comment'])->name('comment');
    Route::get('comment/delete/{id}',[CommentController::class,'deleteComment'])->name('user#deleteComment');
    Route::post('rating',[RatingController::class,'rating'])->name('rating');
}); 