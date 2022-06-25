<?php

namespace App\Http\Controllers;

use App\Models\BookingRoom;
use App\Repositories\BookingRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customers;
use Illuminate\Support\Carbon;

class BookingRoomController extends Controller
{
    public function __construct(RoomRepository $roomRepository, ServiceRepository $serviceRepository, BookingRoomRepository $bookingRoomRepository)
    {
        $this->bookingRoomRepository = $bookingRoomRepository;
        $this->roomRepository = $roomRepository;
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        return view('booking-room.index');
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

        return view('room.model-booking-room', compact('floors', 'bookingRooms'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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
        $bookingRoom = $this->bookingRoomRepository->firstOrFail($request);

        return view('room.invoice', compact('bookingRoom'));
    }
}
