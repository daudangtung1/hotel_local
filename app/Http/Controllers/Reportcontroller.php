<?php

namespace App\Http\Controllers;

use App\Exports\BookingRoomExport;
use App\Repositories\BookingRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\TypeRoomRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ReportController extends Controller
{
    public $roomRepository;

    public $serviceRepository;

    public $typeRoomRepository;

    public $excel;

    public function __construct(Excel $excel, TypeRoomRepository $typeRoomRepository, RoomRepository $roomRepository, ServiceRepository $serviceRepository, BookingRoomRepository $bookingRoomRepository)
    {
        $this->excel = $excel;
        $this->roomRepository = $roomRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->serviceRepository = $serviceRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
    }

    public function index(Request $request)
    {
        if(!empty($request->export)) {
            return $this->excel->download(new BookingRoomExport($request), 'booking-rooms.xlsx');
        }

        $bookingRooms = $this->bookingRoomRepository->filter($request);
        $title = 'Quản lý báo cáo';

        return view('report.index', compact('bookingRooms', 'title'));
    }
}
