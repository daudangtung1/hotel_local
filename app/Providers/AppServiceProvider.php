<?php

namespace App\Providers;

use App\Models\BookingRoom;
use App\Models\Room;
use App\Models\Service;
use App\Repositories\BookingRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \URL::forceScheme('https');
        $this->load();
        Paginator::useBootstrap();
    }

    public function load() {

         $floors = RoomRepository::getInstance()->getAll();
         $services = ServiceRepository::getInstance()->getAll();
         $bookingRooms = BookingRoomRepository::getInstance()->getAllRoomsBooking();

         \Illuminate\Support\Facades\View::share('floors', $floors);
         \Illuminate\Support\Facades\View::share('services', $services);
         \Illuminate\Support\Facades\View::share('bookingRooms', $bookingRooms);
    }
}
