<?php

namespace App\Http\Controllers;

use App\Models\BookingRoom;
use App\Repositories\BookingRoomRepository;
use App\Repositories\OptionRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customers;
use Illuminate\Support\Carbon;

class BookingRoomController extends Controller
{
    public function __construct(OptionRepository $optionRepository, RoomRepository $roomRepository, ServiceRepository $serviceRepository, BookingRoomRepository $bookingRoomRepository)
    {
        $this->bookingRoomRepository = $bookingRoomRepository;
        $this->roomRepository = $roomRepository;
        $this->serviceRepository = $serviceRepository;
        $this->optionRepository = $optionRepository;
    }

    public function index(Request $request)
    {
        $title = 'Quản lý đặt phòng';
        $floors = $this->roomRepository->filterRoomBookingByDate($request);
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBooking($request);
        
        if ($request->ajax()) {
            return view('room.list-booking-room', compact('floors', 'bookingRooms'))->render();
        }
        return view('booking-room.index', compact('title'));
    }

    public function store(Request $request)
    {
        $this->bookingRoomRepository->store($request);

        $floors = $this->roomRepository->getAll();
        $services = $this->serviceRepository->getAll();
        $room = $this->roomRepository->find($request);

        return view('room.modal-content-room', compact('room', 'services', 'floors'))->render();
    }

    public function BookingRooms(Request $request)
    {
        if (Carbon::parse($request->start_date)->gte(Carbon::parse($request->end_date))) {
            return [
                'response' => [
                    'code' => 400,
                    'message' => "Vui lòng nhập kết thúc lớn hơn ngày bắt đầu"
                ]
            ];
        }
        $this->bookingRoomRepository->store($request);

        $floors = $this->roomRepository->getAll();
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBooking();

        // return view('room.model-booking-room', compact('floors', 'bookingRooms'))->render();
    }

    public function getHistory(Request $request)
    {
        $bookingRooms = $this->bookingRoomRepository->getHistory();
        $title = 'Lịch sử đặt phòng';

        return view('booking-room.history', compact('bookingRooms', 'title'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
    }

    public function updateNote(Request $request)
    {
        $this->bookingRoomRepository->updateNote($request);

        $floors = $this->roomRepository->getAll();
        $services = $this->serviceRepository->getAll();
        $room = $this->roomRepository->find($request);

        return view('room.modal-content-room', compact('room', 'services', 'floors'))->render();
    }

    public function updateBookingRoom(Request $request)
    {
        $this->bookingRoomRepository->updateBookingRoom($request);

        $floors = $this->roomRepository->getAll();
        $services = $this->serviceRepository->getAll();
        $room = $this->roomRepository->find($request);

        return view('room.modal-content-room', compact('room', 'services', 'floors'))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $bookingRoom = $this->bookingRoomRepository->firstOrFail($request);

        if($bookingRoom) {
            $bookingRoom->delete();

            return redirect()->back()->with('success', 'Xóa thành công');
        }
    }

    public function showInvoice(Request $request)
    {
        if(empty($request->id)) {
            abort(404);
        }
        $option = $this->optionRepository->find();
        $bookingRoom = $this->bookingRoomRepository->firstOrFail($request);
        $title = 'Hóa đơn';

        return view('room.invoice', compact('bookingRoom', 'option', 'title'));
    }

    public function getBookingRoomUsed(Request $request)
    {
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBookingUsed();
        $title = 'Quản lý đặt phòng';
        $menuSystem = true;
        return view('booking-room.used', compact('bookingRooms', 'menuSystem','title'));
    }

    public function getBookingRoomInfo(Request $request) 
    {
        $bookingRoomInfo = $this->bookingRoomRepository->getBookingRoomInfo($request);
        return view('customers.customer-booking-infor', compact('bookingRoomInfo'))->render();
    }
}
