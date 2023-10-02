<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});



// Route::get("/images", [ImageController::class,"show"]);
Route::post("/images/upload", [ImageController::class,"store"]);
