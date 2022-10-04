<?php

namespace App\Repositories;

use App\Models\BookingRoom;
use App\Models\BookingRoomCustomer;
use App\Models\BookingRoomService;
use App\Models\Customers;
use App\Models\Room;
use App\Models\Service;
use App\Models\Shift;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Request;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class ShiftRepository extends ModelRepository
{
    protected $model;
    protected $customers;
    protected $room;
    protected $service;
    protected $bookingRoomCustomer;
    protected $bookingRoomService;

    private static $instance;

    public function __construct(
        Shift $shift,
        BookingRoom $bookingRoom,
        Customers $customers,
        BookingRoomCustomer $bookingRoomCustomer,
        Room $room,
        Service $service,
        BookingRoomService $bookingRoomService
    ) {
        $this->shift = $shift;
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

    public function find($request)
    {
        return $this->shift->find($request->shift_id);
    }

    public function store($request)
    {
        $data = $request->all();
        $data['branch_id'] = get_branch_id();
        $this->shift::create($data);
    }

    public function update($request)
    {
        $this->shift::find($request->shift_id)->update($request->all());
    }

    public function getAll()
    {
        return $this->shift->where('branch_id', get_branch_id())->paginate(10);
    }

    function firstOrFail($request, $paginate = true)
    {
        return $this->bookingRoom->findOrFail($request->id);
    }
}
