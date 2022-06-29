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

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::resources([
        'home'                   => \App\Http\Controllers\RoomController::class,
        'rooms'                  => \App\Http\Controllers\RoomController::class,
        'reports'                => \App\Http\Controllers\ReportController::class,
        'users'                  => \App\Http\Controllers\UserController::class,
        'services'               => \App\Http\Controllers\ServiceController::class,
        'logs'                   => \App\Http\Controllers\LogController::class,
        'type-rooms'             => \App\Http\Controllers\TypeRoomController::class,
        'lost-items'             => \App\Http\Controllers\LostItemController::class,
        'booking-room'           => \App\Http\Controllers\BookingRoomController::class,
        'booking-room-service'   => \App\Http\Controllers\BookingRoomServiceController::class,
        'booking-room-customers' => \App\Http\Controllers\BookingRoomCustomerController::class,
        'customers'              => \App\Http\Controllers\CustomersController::class,
    ]);

    Route::get('history', [\App\Http\Controllers\BookingRoomController::class, 'getHistory'])->name('booking-room.history');
    Route::get('booking-room-used', [\App\Http\Controllers\BookingRoomController::class, 'getBookingRoomUsed'])->name('booking-room.booking_room_used');


    Route::POST('room/change-status/{room_id}', [\App\Http\Controllers\RoomController::class, 'changeStatus'])->name('room.change-status');
    Route::get('room/get-minutes', [\App\Http\Controllers\RoomController::class, 'getMinutes'])->name('rooms.getMinutes');
    Route::post('booking-room/update-note', [\App\Http\Controllers\BookingRoomController::class, 'updateNote'])->name('booking-room.update_note');
    Route::post('booking-room/update-booking-room', [\App\Http\Controllers\BookingRoomController::class, 'updateBookingRoom'])->name('booking-room.update_booking_room');
    Route::post('booking-room/booking-rooms', [\App\Http\Controllers\BookingRoomController::class, 'BookingRooms'])->name('booking-room.booking_rooms');
    Route::get('reports/filter', [\App\Http\Controllers\ReportController::class, 'filter'])->name('reports.filter');
    Route::get('lost-items/update-status/{id}', [\App\Http\Controllers\LostItemController::class, 'updateStatus'])->name('lost-items.update_status');
});

Route::get('booking-room/invoice/{id}', [\App\Http\Controllers\BookingRoomController::class, 'showInvoice'])->name('booking-room.show_invoice');
