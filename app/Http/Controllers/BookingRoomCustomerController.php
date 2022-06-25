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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookingRoomCustomer  $bookingRoomCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(BookingRoomCustomer $bookingRoomCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookingRoomCustomer  $bookingRoomCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingRoomCustomer $bookingRoomCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookingRoomCustomer  $bookingRoomCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingRoomCustomer $bookingRoomCustomer)
    {
        //
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
