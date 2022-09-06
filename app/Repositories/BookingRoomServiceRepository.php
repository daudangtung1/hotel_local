<?php

namespace App\Repositories;

use App\Models\BookingRoom;
use App\Models\BookingRoomCustomer;
use App\Models\BookingRoomService;
use App\Models\Customers;
use App\Models\Room;
use App\Models\Service;
use Carbon\Carbon;
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
            self::$instance = app(BookingRoomServiceRepository::class);
        }

        return self::$instance;
    }


    public function destroy($request)
    {
        $bookingRoomService = $this->bookingRoomService->find($request->booking_room_service_id);
        if (!empty($bookingRoomService)) {
            if (!empty($bookingRoomService->service)) {
                $bookingRoomService->service->increment('stock', $bookingRoomService->quantity);
            }
            $bookingRoomService->delete();
        }
    }

    public function all($request)
    {
        $query = $this->bookingRoomService;
        if (!empty($request->s)) {
            $query = $query->whereHas('bookingRoom', function ($q) use ($request) {
                $q->whereHas('room', function ($q) use ($request) {
                    $q->where('name', 'LIKE', "%{$request->s}%");
                });
            });
        }

        if (!empty($request->services)) {
            $query = $query->where('service_id', $request->services);
        }

        if (!empty($request->date)) {
            $query = $query->where('start_date', $request->date);
        }
        return $query->paginate(10);
    }

    public function getById($id)
    {
        return $this->bookingRoomService->find($id);
    }

    public function update($request, $id)
    {
        $bookingRoomService = $this->bookingRoomService->find($id);
        $oldQuantity = $bookingRoomService->quantity;

        if (!empty($bookingRoomService)) {
            $service = $bookingRoomService->service;
            $totalQuantity = $oldQuantity + $service->stock;

            $bookingRoomService->service->update(['stock' => ($totalQuantity - $request->quantity)]);
            $bookingRoomService->update(['quantity' => $request->quantity]);
        }
    }

    public function filter($request)
    {
        $query = $this->bookingRoomService;
        if (!empty($request->start_date)) {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_date . ' 00:00:00');
            $query = $query->whereDate('created_at', '>=', $startDate);
        }

        if (!empty($request->end_date)) {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $request->end_date . ' 00:00:00');
            $query = $query->whereDate('created_at', '<=', $endDate);
        }
        $query = $query->whereHas('bookingRoom', function ($subQuery) {
            $subQuery->where('status', BookingRoom::CHECKOUT);
        });

        return $query->orderBy('id', 'DESC')->paginate(10);
    }
}
