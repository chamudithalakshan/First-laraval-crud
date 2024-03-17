<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/display/cars',[CrudController::class,'showAllCars']);
Route::get('/add/cars',[CrudController::class,'addCar'])->name('addCar');

Route::get('/edit/car',[CrudController::class,'editCar'])->name('editCar');

Route::get('delete/car/{id}',[CrudController::class,'deleteCar'])->name('deleteCar');