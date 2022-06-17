<?php

namespace App\Repositories;

use App\Models\BookingRoom;
use App\Models\BookingRoomCustomer;
use App\Models\BookingRoomService;
use App\Models\Customers;
use App\Models\Room;
use App\Models\Service;
use DB;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class BookingRoomServiceRepository extends ModelRepository
{
    protected $model;
    protected $customers;
    protected $room;
    protected $service;
    protected $bookingRoomCustomer;
    protected $bookingRoomService;

    private static $instance;

    public function __construct(BookingRoom $bookingRoom, Customers $customers, BookingRoomCustomer $bookingRoomCustomer, Room $room, Service $service, BookingRoomService $bookingRoomService)
    {
        $this->room = $room;
        $this->bookingRoom = $bookingRoom;
        $this->service = $service;
        $this->customers = $customers;
        $this->bookingRoomCustomer = $bookingRoomCustomer;
        $this->bookingRoomService = $bookingRoomService;
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new RoomRepository(new Room());
        }

        return self::$instance;
    }


    public function destroy($request)
    {
        $bookingRoomService = $this->bookingRoomService->find($request->booking_room_service_id);
        if (!empty($bookingRoomService)) {
            $bookingRoomService->service->increment('stock', $bookingRoomService->quantity);
            $bookingRoomService->delete();
        }
    }
}
