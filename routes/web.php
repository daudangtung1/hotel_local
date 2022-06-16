<?php

use Illuminate\Support\Facades\Route;
use App\Controller\RoomController;
use App\Http\Controllers\BookingRoomController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('rooms.index');
});

// Auth::routes();

Route::resources([
    'rooms' => \App\Http\Controllers\RoomController::class,
    'services' => \App\Http\Controllers\ServiceController::class,
]);

Route::post('/booking',  [BookingRoomController::class, 'store'])->name('booking');
