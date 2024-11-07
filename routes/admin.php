<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoeTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
    Route::get('dashboard',[AdminController::class,'AdminHome'])->name('Admin#Home');
    Route::get('users',[AdminController::class,'UserList'])->name('Admin#UserList');
    Route::get('admins',[AdminController::class,'AdminList'])->name('Admin#AdminList');
    Route::get('add/admin',[AdminController::class,'addAdminPage'])->name('Admin#addAdminPage');
    Route::post('add/admin',[AdminController::class,'addAdmin'])->name('Admin#addAdmin');
    Route::get('delete/admin/{id}',[AdminController::class,'deleteAdmin'])->name('Admin#deleteAdmin');
    Route::get('delete/user/{id}',[AdminController::class,'deleteUser'])->name('Admin#deleteUser');
    
    // shoe types
    Route::get('shoe/types',[AdminController::class,'shoeTypesPage'])->name('Admin#shoeTypes');
    Route::post('shoe/types/create',[ShoeTypeController::class,'shoeTypeCreate'])->name('Admin#shoeTypeCreate');
    Route::get('shoe/types/delete/{id}',[ShoeTypeController::class,'shoeTypeDelete'])->name('Admin#shoeTypeDelete');

    // contact
    Route::get('contact',[AdminController::class,'contactPage'])->name('Admin#contact');
    Route::get('contact/detail/{id}',[ContactController::class,'contactDetail'])->name('Admin#contactDetail');
    Route::post('contact/isRead/{id}',[ContactController::class,'contactIsReadChange'])->name('Admin#contactIsReadChange');
    Route::get('contact/delete/{id}',[ContactController::class,'contactDelete'])->name('Admin#contactDelete');

    // product
    Route::group(['prefix' => 'product'],function(){
        Route::get('/list/{amt?}',[ProductController::class,'productList'])->name('Admin#productList');
        Route::get('create',[ProductController::class,'addProductPage'])->name('Admin#addProductPage');
        Route::post('create',[ProductController::class,'addProduct'])->name('Admin#addProduct');
        Route::get('delete/{id}',[ProductController::class,'deleteProduct'])->name('Admin#deleteProduct');
        Route::get('detail/{id}',[ProductController::class,'detailProduct'])->name('Admin#detailProduct');
        Route::get('edit/{id}',[ProductController::class,'editProductPage'])->name('Admin#editProductPage');
        Route::post('edit/{id}',[ProductController::class,'editProduct'])->name('Admin#editProduct');
    });
});