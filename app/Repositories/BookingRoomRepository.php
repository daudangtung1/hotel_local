<?php

namespace App\Repositories;

use App\Models\BookingRoom;
use App\Models\BookingRoomCustomer;
use App\Models\BookingRoomService;
use App\Models\Customers;
use App\Models\Groups;
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

    public function __construct(Groups $group, BookingRoom $bookingRoom, Customers $customers, BookingRoomCustomer $bookingRoomCustomer, Room $room, Service $service, BookingRoomService $bookingRoomService)
    {
        $this->group = $group;
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
            self::$instance = new BookingRoomRepository(new Groups(), new BookingRoom(), new Customers(), new BookingRoomCustomer(), new Room(), new Service(), new BookingRoomService());
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

    public function find($id)
    {
        return $this->bookingRoom->find($id);
    }

    public function getHistory()
    {
        return $this->bookingRoom->where('status', $this->room::CLOSED)->orderBy('start_date', 'ASC')->paginate(10);
    }

    public function getAllRoomsBooking($request = null)
    {
        return $this->bookingRoom->where('status', 6)->orderBy('start_date', 'ASC')->get();
    }

    public function getAllRoomsBookingFinish()
    {
        return $this->bookingRoom->where('status', 7)->orderBy('start_date', 'ASC')->get();
    }

    public function getAllRoomsBookingUsed($request = null)
    {
        $data = $this->bookingRoom->where('status', 7);
        if (!empty($request->name)) {
            $data = $data->whereHas('bookingRoomCustomers.customer', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            });
        }

        if (!empty($request->room)) {
            $data = $data->whereHas('room', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->room . '%');
            });
        }
        $data = $data->orderBy('start_date', 'ASC')->paginate(10);

        return $data;
    }

    public function booking($request)
    {
        $bookingRoom = $this->bookingRoom->find($request->booking_room_id);

        if ($bookingRoom->room->status != $this->room::READY) {
            return [
                'status'  => false,
                'message' => 'Phòng hiện tại chưa ở trạng thái hợp lệ, chưa thể nhận phòng'
            ];
        }

        $bookingRoom->update(['status' => $this->room::HAVE_GUEST]);

        $bookingRoom->room()->update(['status' => $this->room::HAVE_GUEST]);
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
                'extra_price'   => $request->extra_price ?? 0,
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

    public function getListBookingInfoClosest($request)
    {
        if ($request) {
            $roomId = $request->get('room_id');
            $bookingInfo = $this->room->select('customers.*', 'customers.name as cusomter_name', 'rooms.status as room_status','rooms.*', 'rooms.name as room_name', 'booking_rooms.*')
                ->join('booking_rooms', 'rooms.id', '=', 'booking_rooms.room_id')
                ->join('booking_room_customers', 'booking_rooms.id', '=', 'booking_room_customers.booking_room_id')
                ->join('customers', 'booking_room_customers.customer_id', '=', 'customers.id')
                ->where('rooms.id', $roomId)
                ->whereNull('booking_rooms.checkout_date')
                ->orderBy('start_date', 'ASC')
                ->paginate(10);
            return $bookingInfo;
        }

        return [];
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

            if ($request->rent_type == 1 || $request->rent_type == 2) {
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
        if (!empty($room->bookingRooms()->whereIn('status', [1, 3, 5])->where('status', '<>', 7)->first())) {
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
                'price'           => $service->price ?? 0,
                'start_date'      => $request->modal_start_date ?? null,
                'end_date'        => $request->modal_end_date ?? null,
            ]);
        } else {
            $bookingRoomService->update(['quantity' => $bookingRoomService->quantity + 1]);
        }
        if ($service->sale_type) { // 1 số lần sử dụng, 0 theo ngày
            $service->decrement('stock', 1);
        }
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

    public function update($request)
    {
        if (!empty($request->customer_id)) {
            $this->customers->where('id', $request->customer_id)->update([
                'name'    => $request->customer_name,
                'id_card' => $request->customer_id_card,
                'address' => $request->customer_address,
                'phone'   => $request->customer_phone
            ]);
        }

        if (!empty($request->group_id)) {
            $this->group->where('id', $request->group_id)->update([
                'name'    => $request->customer_name,
            ]);
        }

        foreach ($request->room_ids ?? [] as $roomId) {
            $data = [
                'start_date'    => $request->start_date ? Carbon::parse($request->start_date)->format('Y-m-d H:i') : '',
                'end_date'      => $request->end_date ? Carbon::parse($request->end_date)->format('Y-m-d H:i') : '',
                'checkout_date' => null,
                'room_id'       => $roomId,
                'note'          => $request->note ?? '',
                'price'         => 0,
                'rent_type'     => 1, // theo ngày
                'status'        => 6,
                'user_id'       => \Auth::user()->id
            ];

            $this->bookingRoom->where('id', $request->booking_room_id)->update($data);
//            $bookingRoom = $this->bookingRoom->create($data);
//
//            if (!empty($bookingRoom)) {
//                $this->bookingRoomCustomer->create([
//                    'booking_room_id' => $bookingRoom->id,
//                    'customer_id'     => $customer->id,
//                ]);
//
//            }
        }

//        $this->bookingRoom->where('id', $request->booking_room_id)->update($data);
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

    function firstOrFail($request, $paginate = true)
    {
        return $this->bookingRoom->findOrFail($request->id);
    }

    public function filter($request, $paginate = true)
    {
        $data = $this->bookingRoom->where('note', 'LIKE', '%' . $request->s . '%');
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

        if ($paginate) {
            $data = $data->paginate(10);
        } else {
            $data = $data->get();
        }

        return $data;
    }

    public function getBookingRoomInfo($request = null)
    {
        if ($request) {
            $roomId = $request->get('room_id');
            $bookingInfo = $this->room->select('customers.*', 'customers.name as cusomter_name', 'rooms.status as room_status', 'rooms.*', 'rooms.name as room_name', 'booking_rooms.*')
                ->join('booking_rooms', 'rooms.id', '=', 'booking_rooms.room_id')
                ->join('booking_room_customers', 'booking_rooms.id', '=', 'booking_room_customers.booking_room_id')
                ->join('customers', 'booking_room_customers.customer_id', '=', 'customers.id')
                ->where('rooms.id', $roomId)
                ->whereNull('booking_rooms.checkout_date')
                ->orderBy('start_date', 'ASC')
                ->first();
            return $bookingInfo;
        }

        return [];
    }

    public function totalRoomBooked($date, $type)
    {
        $total = $this->bookingRoom->join('rooms', 'rooms.id', '=', 'booking_rooms.room_id')
            ->leftJoin('type_rooms', 'type_rooms.id', '=', 'rooms.type_room_id')
            ->whereIn('booking_rooms.status', [1, 3, 6, 7])
            ->where(\DB::raw("DATE_FORMAT(start_date, '%Y-%m-%d')"), '<=', $date)
            ->where(\DB::raw("DATE_FORMAT(end_date, '%Y-%m-%d')"), '>=', $date)
            ->where('type_rooms.id', $type)
            ->withTrashed()
            ->count();
        return $total;
    }

    public function getBookingRoomByStartDate($request)
    {
        $startDate = date('Y-m-d', strtotime($request->get('start_date')));
        $roomId = $request->get('room_id');
        $data = $this->bookingRoom->where('room_id', $roomId)
            ->where(\DB::raw("DATE_FORMAT(start_date, '%Y-%m-%d')"), '<=', $startDate)
            ->where(\DB::raw("DATE_FORMAT(end_date, '%Y-%m-%d')"), '>=', $startDate)
            ->first();
        return $data;
    }

    public function filterStatusRoom($request, $paginate = true)
    {
        $dateFilter = !empty($request->start_date) ? Carbon::parse($request->start_date) : Carbon::now();

        $roomIn = $this->room->whereHas('bookingRooms', function ($query) use ($dateFilter) {
            return $query->whereDate('start_date', $dateFilter)->withTrashed();
        })->withTrashed()->get();

        $roomOut = $this->room->whereHas('bookingRooms', function ($query) use ($dateFilter) {
            return $query->whereDate('checkout_date', $dateFilter)->withTrashed();
        })->withTrashed()->get();


        $roomInGuest = $this->room->whereHas('bookingRooms', function ($query) use ($dateFilter) {
            return $query->where(function ($subQuery) use ($dateFilter) {
                return $subQuery->where(function ($q) use ($dateFilter) {
                    return $q->whereDate('start_date', '<=', $dateFilter)
                        ->whereDate('checkout_date', '>=', $dateFilter);
                })->orWhere(function ($q) use ($dateFilter) {
                    return $q->whereDate('start_date', '<=', $dateFilter)
                        ->whereNull('checkout_date');
                });
            })->withTrashed();
        })->withTrashed()->get();

        $roomEmpty = $this->room->whereHas('bookingRooms', function ($query) use ($dateFilter) {
            return $query->whereDate('start_date', '>', $dateFilter)
                ->orWhereDate('checkout_date', '<', $dateFilter)->withTrashed();
        })->withTrashed()->get();

        $roomNotForRent = $this->room->where('status', Room::NOT_FOR_RENT)->get();
        $roomsNotRent = [];
        foreach ($roomNotForRent as $room) {
            $roomsNotRent[$room->status_desc][] = $room->name;
        }

        return [
            Room::IN                => [
                'list'  => $roomIn,
                'total' => $roomIn->count(),
            ],
            Room::OUT               => [
                'list'  => $roomOut,
                'total' => $roomOut->count(),
            ],
            Room::IN_GUEST          => [
                'list'  => $roomInGuest,
                'total' => $roomInGuest->count(),
            ],
            Room::ROOM_EMPTY        => [
                'list'  => $roomEmpty,
                'total' => $roomEmpty->count(),
            ],
            Room::NOT_FOR_RENT_TEXT => [
                'list'  => $roomsNotRent,
                'total' => $roomNotForRent->count(),
            ],
        ];
    }

    public function filterStatusRoomEmpty($request)
    {
        $start_date = !empty($request->start_date) ?
            $request->start_date : Carbon::now()->format('Y-m-d');
        $end_date = !empty($request->month_year) ?
            Carbon::parse($request->month_year)->lastOfMonth()->format('Y-m-d') :
            Carbon::now()->lastOfMonth()->format('Y-m-d');

        $results = [];
        while (strtotime($start_date) <= strtotime($end_date)) {
            $roomBooking = $this->bookingRoom->select('room_id')
                ->whereDate('start_date', '<=', $start_date)
                ->whereDate('checkout_date', '>=', $start_date)
                ->distinct()->withTrashed()->get();
            $arrayRoomIdBooking = array_column($roomBooking->toArray(), 'room_id');
            $quantityRoomEmpty = $this->room->whereNotIn('id', $arrayRoomIdBooking)->withTrashed()->count();
            $results[Carbon::parse($start_date)->format('m')][Carbon::parse($start_date)->format('d/m')] = $quantityRoomEmpty;
            $start_date = date("Y-m-d", strtotime("+1 days", strtotime($start_date)));
        }

        return $results;
    }

    public function deleteByIds($arrIds)
    {
        if (empty($arrIds)) return false;

        $this->bookingRoom->whereIn('id', $arrIds)->delete();
    }
}
