<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public $roomRepository;

    public $serviceRepository;

    public function __construct(RoomRepository $roomRepository, ServiceRepository $serviceRepository, BookingRoomRepository $bookingRoomRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->serviceRepository = $serviceRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
    }

    public function index(Request $request)
    {
        $floors = $this->roomRepository->getAll();
        $services = $this->serviceRepository->getAll();
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBooking();
        $menuSystem = true;

        if ($request->ajax()) {
            return view('room.list', compact('floors', 'services', 'menuSystem', 'bookingRooms'))->render();
        }

        return view('room.index', compact('floors', 'services', 'menuSystem', 'bookingRooms'));
    }

    public function create()
    {
        $menuSetup = true;
        $rooms = $this->roomRepository->getAll(false);
        return view('room.create', compact('menuSetup', 'rooms'));
    }

    public function store(Request $request)
    {
        // TODO: validate
        $result = $this->roomRepository->store($request);
        if ($result) {
            return redirect()->back()->with('success', 'Đăng ký thành công');
        }
    }

    public function changeStatus(Request $request)
    {
        $this->roomRepository->changeStatus($request);

        $floors = $this->roomRepository->getAll();
        $services = $this->serviceRepository->getAll();
        $room = $this->roomRepository->find($request);

        return view('room.modal-content-room', compact('room', 'services', 'floors'))->render();
    }

    public function getMinutes(Request $request)
    {
        return  response()->json( $this->bookingRoomRepository->getMinutes());
    }
}
