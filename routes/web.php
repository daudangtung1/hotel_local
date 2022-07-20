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
    Route::get('reports/filter-form', [\App\Http\Controllers\ReportController::class, 'filterForm'])->name('reports.filter_form');
    Route::get('customers/search', [\App\Http\Controllers\CustomersController::class, 'SearchByCustomerName'])->name('customers.search');
    Route::get('booking-room/booking', [\App\Http\Controllers\BookingRoomController::class, 'booking'])->name('booking-room.booking');

    Route::resources([
        'home'                     => \App\Http\Controllers\RoomController::class,
        'rooms'                    => \App\Http\Controllers\RoomController::class,
        'reports'                  => \App\Http\Controllers\ReportController::class,
        'options'                  => \App\Http\Controllers\OptionController::class,
        'users'                    => \App\Http\Controllers\UserController::class,
        'services'                 => \App\Http\Controllers\ServiceController::class,
        'logs'                     => \App\Http\Controllers\LogController::class,
        'type-rooms'               => \App\Http\Controllers\TypeRoomController::class,
        'lost-items'               => \App\Http\Controllers\LostItemController::class,
        'booking-room'             => \App\Http\Controllers\BookingRoomController::class,
        'booking-room-service'     => \App\Http\Controllers\BookingRoomServiceController::class,
        'booking-room-customers'   => \App\Http\Controllers\BookingRoomCustomerController::class,
        'customers'                => \App\Http\Controllers\CustomersController::class,
        'revenue-and-expenditures' => \App\Http\Controllers\RevenueAndExpenditureController::class,
        'funds'                    => \App\Http\Controllers\FundController::class,
        'shifts'                   => \App\Http\Controllers\ShiftController::class,
    ]);

    Route::get('history', [\App\Http\Controllers\BookingRoomController::class, 'getHistory'])->name('booking-room.history');
    Route::get('booking-room-used', [\App\Http\Controllers\BookingRoomController::class, 'getBookingRoomUsed'])->name('booking-room.booking_room_used');
    Route::get('booking-room-info', [\App\Http\Controllers\BookingRoomController::class, 'getBookingRoomInfo'])->name('booking-room.booking_room_info');

    Route::POST('room/change-status/{room_id}', [\App\Http\Controllers\RoomController::class, 'changeStatus'])->name('room.change-status');
    Route::POST('options', [\App\Http\Controllers\OptionController::class, 'updateAll'])->name('options.update_all');
    Route::get('room/get-minutes', [\App\Http\Controllers\RoomController::class, 'getMinutes'])->name('rooms.getMinutes');
    Route::post('booking-room/update-note', [\App\Http\Controllers\BookingRoomController::class, 'updateNote'])->name('booking-room.update_note');
    Route::post('booking-room/update-booking-room', [\App\Http\Controllers\BookingRoomController::class, 'updateBookingRoom'])->name('booking-room.update_booking_room');
    Route::post('booking-room/booking-rooms', [\App\Http\Controllers\BookingRoomController::class, 'BookingRooms'])->name('booking-room.booking_rooms');
    Route::get('reports/filter', [\App\Http\Controllers\ReportController::class, 'filter'])->name('reports.filter');
    Route::get('lost-items/update-status/{id}', [\App\Http\Controllers\LostItemController::class, 'updateStatus'])->name('lost-items.update_status');

    Route::get('customers/report/filter', [\App\Http\Controllers\CustomersController::class, 'report'])->name('customers.report');
    Route::get('booking-room-service/report/filter', [\App\Http\Controllers\BookingRoomServiceController::class, 'report'])->name('booking-room-service.report');
    Route::get('services/report/filter', [\App\Http\Controllers\ServiceController::class, 'report'])->name('services.report');
});

Route::get('booking-room/invoice/{id}', [\App\Http\Controllers\BookingRoomController::class, 'showInvoice'])->name('booking-room.show_invoice');
