<?php

namespace App\Http\Controllers;

use App\Models\BookingRoomCustomer;
use App\Repositories\BookingRoomCustomerRepository;
use App\Repositories\BookingRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\TypeRoomRepository;
use Illuminate\Http\Request;

class BookingRoomCustomerController extends Controller
{
    protected $bookingRoomCustomerRepository;

    public function __construct(BookingRoomCustomerRepository $bookingRoomCustomerRepository, TypeRoomRepository $typeRoomRepository, RoomRepository $roomRepository, ServiceRepository $serviceRepository, BookingRoomRepository $bookingRoomRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->serviceRepository = $serviceRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
        $this->bookingRoomCustomerRepository = $bookingRoomCustomerRepository;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookingRoomCustomer  $bookingRoomCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $booking_room_customer_id)
    {
        $this->bookingRoomCustomerRepository->delete($booking_room_customer_id);

        $floors = $this->roomRepository->getAll();
        $services = $this->serviceRepository->getAll();
        $room = $this->roomRepository->find($request);

        return view('room.modal-content-room', compact('room', 'services', 'floors'))->render();
    }
}
