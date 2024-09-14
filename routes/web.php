<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/',[UserController::class,'index'])->name('user.index');