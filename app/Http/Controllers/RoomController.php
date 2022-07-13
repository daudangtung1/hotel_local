<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\TypeRoomRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public $roomRepository;

    public $serviceRepository;

    public $typeRoomRepository;

    public function __construct(TypeRoomRepository $typeRoomRepository, RoomRepository $roomRepository, ServiceRepository $serviceRepository, BookingRoomRepository $bookingRoomRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->serviceRepository = $serviceRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
    }

    public function index(Request $request)
    {
        $floors = $this->roomRepository->getAll(true, false, $request);
        $services = $this->serviceRepository->getAll();
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBooking();
        $typeRooms = $this->typeRoomRepository->getAll();
        $typeRoomsSelect = $this->typeRoomRepository->getAll(false);
        $menuCategoryManager = true;
        $currentRoom = null;
        $title = 'Quản lý phòng';

        if ($request->ajax()) {
            return view('room.list', compact('typeRoomsSelect', 'typeRooms', 'floors', 'services', 'menuCategoryManager', 'bookingRooms', 'currentRoom'))->render();
        }

        return view('room.index', compact('typeRoomsSelect', 'typeRooms', 'floors', 'services', 'menuCategoryManager', 'bookingRooms', 'currentRoom', 'title'));
    }

    public function create()
    {
        $menuSetup = true;
        $rooms = $this->roomRepository->getAll(false, true);
        $typeRooms = $this->typeRoomRepository->getAll();
        $typeRoomsSelect = $this->typeRoomRepository->getAll(false);
        $title = 'Tạo mới phòng';

        return view('room.create', compact('typeRoomsSelect', 'typeRooms','menuSetup', 'rooms', 'title'));
    }

    public function store(Request $request)
    {
        // TODO: validate
        $result = $this->roomRepository->store($request);
        if ($result) {
            return redirect()->back()->with('success', 'Đăng ký thành công');
        }
    }

    public function update(Request $request)
    {
        // TODO: validate
        $result = $this->roomRepository->update($request);
        if ($result) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        }
    }

    public function edit(Request $request, $room_id)
    {
        $request->merge(['room_id' => $room_id]);
        $currentRoom = $this->roomRepository->find($request);
        $typeRooms = $this->typeRoomRepository->getAll();
        $menuSetup = true;
        $rooms = $this->roomRepository->getAll(false, true);
        $typeRoomsSelect = $this->typeRoomRepository->getAll(false);
        $title = 'Cập nhật phòng';

        return view('room.create', compact('typeRoomsSelect', 'menuSetup', 'typeRooms', 'rooms', 'currentRoom', 'title'));
    }

    public function changeStatus(Request $request)
    {
        $result = $this->roomRepository->changeStatus($request);

        if ($result !== true) {
            return ['status' => 0, 'massage' => $result];
        }

        $floors = $this->roomRepository->getAll();
        $services = $this->serviceRepository->getAll();
        $room = $this->roomRepository->find($request);

        return view('room.modal-content-room', compact('room', 'services', 'floors'))->render();
    }

    public function getMinutes(Request $request)
    {
        return response()->json($this->bookingRoomRepository->getMinutes());
    }

    public function destroy(Request $request, $room_id)
    {
        $request->merge(['room_id' => $room_id]);
        $currentRoom = $this->roomRepository->find($request);
        if (!empty($currentRoom)) {
            if (!empty($currentRoom->bookingRooms()->get())) {
                foreach ($currentRoom->bookingRooms()->get() as $bookingRoom) {
                    $bookingRoom->delete();
                }
            }
            $currentRoom->delete();

            return redirect()->back()->with('success', 'Đã xoá thành công');
        }

        return redirect()->back()->withErrors('Vui lòng thử lại');
    }
}
