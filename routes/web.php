<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::resource("/images", ImageController::class);


// Route::post("/images/upload", [ImageController::class,"store"])->name("images.upload");
