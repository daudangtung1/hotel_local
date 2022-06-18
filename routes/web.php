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
    'booking-room' => \App\Http\Controllers\BookingRoomController::class,
    'booking-room-service' => \App\Http\Controllers\BookingRoomServiceController::class,
]);
Route::POST('room/change-status/{room_id}', [\App\Http\Controllers\RoomController::class, 'changeStatus'] )->name('room.change-status');
Route::get('room/get-minutes',  [\App\Http\Controllers\RoomController::class, 'getMinutes'])->name('rooms.getMinutes');
