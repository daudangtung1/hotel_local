<?php

namespace App\Exports;

use App\Repositories\BookingRoomServiceRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BookingRoomServiceExport implements FromView
{
    use Exportable;

    protected $bookingRoomServiceRepository;
    protected $request;

    public function __construct(BookingRoomServiceRepository $bookingRoomServiceRepository, Request $request)
    {
        $this->bookingRoomServiceRepository = $bookingRoomServiceRepository;
        $this->request = $request;
    }

    public function getBookingRoomServices()
    {
        $bookingRoomServices = $this->bookingRoomServiceRepository->filter($this->request);

        return $bookingRoomServices;
    }

    public function view(): View
    {
        $bookingRoomServices = $this->getBookingRoomServices();

        return view('exports.booking-room-services', [
            'bookingRoomServices' => $bookingRoomServices
        ]);
    }
}
