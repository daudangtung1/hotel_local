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
class BookingRoomRepository extends ModelRepository
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
            self::$instance = new BookingRoomRepository(new BookingRoom(), new Customers(), new BookingRoomCustomer(), new Room(), new Service(), new BookingRoomService());
        }

        return self::$instance;
    }

    public function getAll()
    {
        $rooms = $this->bookingRoom->orderBy('floor', 'ASC')->get();
        $data = [];

        foreach ($rooms as $room) {
            $data[$room->floor][] = $room;
        }

        return $data;
    }

    public function getHistory()
    {
        return $this->bookingRoom->where('status', $this->room::CLOSED)->orderBy('start_date', 'ASC')->paginate(10);
    }

    public function getAllRoomsBooking()
    {
        return $this->bookingRoom->where('status', 6)->orderBy('start_date', 'ASC')->get();
    }

    public function getAllRoomsBookingFinish()
    {
        return $this->bookingRoom->where('status', 7)->orderBy('start_date', 'ASC')->get();
    }

    public function getAllRoomsBookingUsed()
    {
        return $this->bookingRoom->where('status', 7)->orderBy('start_date', 'ASC')->paginate(10);
    }

    public function store($request)
    {
        // đặt phòng trước
        if (!empty($request->room_ids)) {
            $this->bookingRooms($request);
        } else {
            // đặt phòng hiện tại
            if (!empty($request->service_id)) {
                $this->storeByService($request);
            } else {
                $this->storeByCustomer($request);
            }
            $this->room->where('id', $request->room_id)->update(['status' => $this->room::HAVE_GUEST]);
        }

    }

    public function bookingRooms($request)
    {
        $customer = $this->customers->firstOrCreate(
            ['name' => $request->customer_name, 'id_card' => $request->customer_id_card],
            ['address' => $request->customer_address, 'phone' => $request->customer_phone],
        );

        foreach ($request->room_ids as $roomId) {
            $data = [
                'start_date'    => $request->start_date ?? '',
                'end_date'      => $request->end_date ?? '',
                'checkout_date' => null,
                'room_id'       => $roomId,
                'note'          => $request->note ?? '',
                'price'         => 0,
                'rent_type'     => 1, // theo ngày
                'status'        => 6,
                'user_id'       => \Auth::user()->id
            ];

            $bookingRoom = $this->bookingRoom->create($data);

            if (!empty($bookingRoom)) {
                $this->bookingRoomCustomer->create([
                    'booking_room_id' => $bookingRoom->id,
                    'customer_id'     => $customer->id,
                ]);

            }
        }
    }

    public function storeByCustomer($request)
    {
        $customer = $this->customers->firstOrCreate(
            ['name' => $request->customer_name, 'id_card' => $request->customer_id_card],
            ['address' => $request->customer_address, 'phone' => $request->customer_phone],
        );

        $room = $this->room->find($request->room_id);

        if (!empty($room) && $room->status != $this->room::READY) {
            $bookingRoom = $room->bookingRooms()->orderBy('id', 'DESC')->first();
        } else {

            $data = [
                'start_date'    => $request->start_date ?? '',
                'checkout_date' => null,
                'room_id'       => $request->room_id ?? '',
                'note'          => $request->note ?? '',
                'price'         => $request->price ?? 0,
                'rent_type'     => $request->rent_type ?? 0,
                'status'        => 1,
                'user_id'       => \Auth::user()->id
            ];

            if ($request->rent_type == 1) {
                $data['end_date'] = $request->end_date ?? '';
                $data['extra_price'] = $request->extra_price ?? 0;
            }

            $bookingRoom = $this->bookingRoom->create($data);
        }

        if (!empty($bookingRoom)) {
            $this->bookingRoomCustomer->create([
                'booking_room_id' => $bookingRoom->id,
                'customer_id'     => $customer->id,
            ]);
        }
    }

    public function storeByService($request)
    {
        $room = $this->room->find($request->room_id);
        $service = $this->service->find($request->service_id);

        if (!empty($room->bookingRooms()->orderBy('id', 'DESC')->first())) {
            $bookingRoom = $room->bookingRooms()->orderBy('id', 'DESC')->first();
        } else {
            $bookingRoom = $this->bookingRoom->create([
                'end_date'   => $request->end_date ?? '',
                'start_date' => $request->start_date ?? '',
                'room_id'    => $request->room_id ?? '',
                'note'       => $request->note ?? '',
                'rent_type'  => $request->rent_type ?? 0,
                'price'      => $request->price ?? 0,
                'status'     => 1,
                'user_id'    => \Auth::user()->id
            ]);
        }

        $bookingRoomService = $this->bookingRoomService->where([
            'booking_room_id' => $bookingRoom->id,
            'service_id'      => $service->id,
        ])->first();

        if (empty($bookingRoomService)) {
            $bookingRoomService = $this->bookingRoomService->create([
                'booking_room_id' => $bookingRoom->id,
                'service_id'      => $service->id,
                'quantity'        => 1,
                'price'           => $service->price ?? 0
            ]);
        } else {
            $bookingRoomService->update(['quantity' => $bookingRoomService->quantity + 1]);
        }

        $service->decrement('stock', 1);
    }

    public function getMinutes()
    {
        $rooms = $this->room->where('status', $this->room::HAVE_GUEST)->get();
        $data = [];
        foreach ($rooms as $room) {
            $bookingRoom = $room->bookingRooms()->orderBy('id', 'DESC')->first();
            if (empty($bookingRoom)) {
                continue;
            }
            $data[] = [
                'room_id'    => $room->id,
                'start_date' => $bookingRoom->getTimeStartDate() . ' ' . $bookingRoom->getDateStartDate(),
                'minutes'    => $bookingRoom->getTime(true),
                'price'      => $bookingRoom->getTotalPrice()
            ];
        }

        return $data;
    }

    public function updateNote($request)
    {
        $this->bookingRoom->where('id', $request->booking_room_id)->update(['note' => $request->note]);
    }

    public function updateBookingRoom($request)
    {
        $data = [
            'note'        => $request->note ?? '',
            'price'       => $request->price ?? 0,
            'extra_price' => $request->extra_price ?? 0,
        ];

        if (!empty($request->booking_room_status) && $request->booking_room_status > 0) {
            $this->room->where('id', $request->room_id)->update(['status' => $request->booking_room_status]);
            $data['status'] = $request->booking_room_status;
        }

        $this->bookingRoom->where('id', $request->booking_room_id)->update($data);
    }

    function firstOrFail($request)
    {
        return $this->bookingRoom->findOrFail($request->id);
    }

    public function filter($request)
    {
        $data = $this->bookingRoom->where('note', 'LIKE' , '%' . $request->s . '%');
        if (!empty($request->start_date)) {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_date . ' 00:00:00');
            $data->where('start_date', '>', $startDate);
        }

        if (!empty($request->end_date)) {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $request->end_date . ' 00:00:00');
            $data->where('end_date', '<', $endDate);
        }

        if (!empty($request->status)) {
            $data->where('status', $request->status);
        }
//        dd($data->toSql());
        $data = $data->get();

        return $data;
    }
}
