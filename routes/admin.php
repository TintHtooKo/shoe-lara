<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
    Route::get('dashboard',[AdminController::class,'AdminHome'])->name('Admin#Home');
    Route::get('users',[AdminController::class,'UserList'])->name('Admin#UserList');
    Route::get('admins',[AdminController::class,'AdminList'])->name('Admin#AdminList');
});