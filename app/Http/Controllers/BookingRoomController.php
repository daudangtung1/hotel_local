<?php

namespace App\Http\Controllers;

use App\Models\BookingRoom;
use App\Repositories\BookingRoomRepository;
use App\Repositories\OptionRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\TypeRoomRepository;
use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class BookingRoomController extends Controller
{
    public function __construct(
        Request $request,
        OptionRepository $optionRepository,
        TypeRoomRepository $typeRoomRepository,
        RoomRepository $roomRepository,
        ServiceRepository $serviceRepository,
        BookingRoomRepository $bookingRoomRepository,
        GroupRepository $groupRepository
    ) {
        $this->request = $request;
        $this->bookingRoomRepository = $bookingRoomRepository;
        $this->roomRepository = $roomRepository;
        $this->serviceRepository = $serviceRepository;
        $this->optionRepository = $optionRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->groupRepository = $groupRepository;
    }

    public function index(Request $request)
    {
        $title = __('Booking_room_management');
        $floors = $this->roomRepository->filterRoomBookingByDate($request);
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBooking($request);

        if ($request->ajax()) {
            return view('room.list-booking-room', compact('floors', 'bookingRooms'))->render();
        }

        $menuCategoryManager = true;
        return view('booking-room.index', compact('title', 'bookingRooms', 'menuCategoryManager'));
    }

    public function store(Request $request)
    {
        $bookingRoom = $this->bookingRoomRepository->getBookingRoomByStartDate($request);
        if ($bookingRoom) {
            return [
                'response' => [
                    'code' => 400,
                    'message' => __('Msg_date_booked')
                ]
            ];
        }
        $this->bookingRoomRepository->store($request);

        $floors = $this->roomRepository->getAll();
        $services = $this->serviceRepository->getAll();
        $room = $this->roomRepository->find($request);

        return view('room.modal-content-room', compact('room', 'services', 'floors'))->render();
    }

    public function booking(Request $request)
    {
        $result = $this->bookingRoomRepository->booking($request);

        if (isset($result['status']) && $result['status'] == false) {
            return $result;
        }
        $floors = $this->roomRepository->getAll(true, false);
        $services = $this->serviceRepository->getAll();
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBooking();
        $typeRooms = $this->typeRoomRepository->getAll();
        $typeRoomsSelect = $this->typeRoomRepository->getAll(false);

        if ($request->ajax()) {
            return view('room.list', compact('typeRoomsSelect', 'typeRooms', 'floors', 'services', 'bookingRooms'))->render();
        }
    }

    public function BookingRooms(Request $request)
    {
        if (Carbon::parse($request->start_date)->gte(Carbon::parse($request->end_date))) {
            return [
                'response' => [
                    'code' => 400,
                    'message' => __('Msg_enter_end')
                ]
            ];
        }
        $this->bookingRoomRepository->store($request);
     
        $floors = $this->roomRepository->getAll();
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBooking();

        return view('room.model-booking-room', compact('floors', 'bookingRooms'))->render();
    }

    public function getHistory(Request $request)
    {  
        $menuSystem = true;
        $bookingRooms = $this->bookingRoomRepository->getHistory();
        $title = __('Booking_history');

        return view('booking-room.history', compact('menuSystem', 'bookingRooms', 'title'));
    }

    public function edit($id)
    {
        $title = __('Update_booking_room');

        $currentRoom = $this->bookingRoomRepository->find($id);

        $menuCategoryManager = true;

        return view('booking-room.edit', compact('currentRoom', 'title', 'menuCategoryManager'));
    }

    public function update(Request $request, $id)
    {
        $this->bookingRoomRepository->update($request);

        return redirect()->back()->with(['success' => __('Msg_update_success')]);
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

        if ($bookingRoom) {
            $bookingRoom->delete();

            return redirect()->back()->with('success', __('Msg_delete_success'));
        }
    }

    public function showInvoice(Request $request)
    {
        if (empty($request->id)) {
            abort(404);
        }
        $option = $this->optionRepository->find();
        $bookingRoom = $this->bookingRoomRepository->firstOrFail($request);
        $title = __('Invoice');

        return view('room.invoice', compact('bookingRoom', 'option', 'title'));
    }

    public function getBookingRoomUsed(Request $request)
    {
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBookingUsed($request);
        $title = __('Reservation_management');
        $menuSystem = true;
        return view('booking-room.used', compact('bookingRooms', 'menuSystem', 'title'));
    }

    public function getListBookingInfoClosest(Request $request)
    {
        $title = __('Booking_customers_list');
        $menuSystem = true;
        $customerInfoBookingRooms = $this->bookingRoomRepository->getListBookingInfoClosest($request);

        return view('booking-room.booking_info', compact('customerInfoBookingRooms', 'menuSystem', 'title'));
    }

    public function getBookingRoomInfo(Request $request)
    {
        $bookingRoomInfo = $this->bookingRoomRepository->getBookingRoomInfo($request);

        return view('customers.customer-booking-infor', compact('bookingRoomInfo'))->render();
    }

    public function bookingRoomGroup(Request $request)
    {
        $this->groupRepository->bookingRoom($request);
    }
}
