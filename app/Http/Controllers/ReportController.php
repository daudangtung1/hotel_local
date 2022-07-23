<?php

namespace App\Http\Controllers;

use App\Exports\BookingRoomExport;
use App\Exports\ReaExport;
use App\Models\Room;
use App\Repositories\BookingRoomRepository;
use App\Repositories\RevenueAndExpenditureRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\TypeRoomRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ReportController extends Controller
{
    public $roomRepository;

    public $serviceRepository;

    public $typeRoomRepository;

    public $excel;

    public function __construct(RevenueAndExpenditureRepository $revenueAndExpenditureRepository, Excel $excel, TypeRoomRepository $typeRoomRepository, RoomRepository $roomRepository, ServiceRepository $serviceRepository, BookingRoomRepository $bookingRoomRepository)
    {
        $this->excel = $excel;
        $this->roomRepository = $roomRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->serviceRepository = $serviceRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
        $this->revenueAndExpenditureRepository = $revenueAndExpenditureRepository;
    }

    public function index(Request $request)
    {
        $title = 'Quản lý báo cáo';
        $menuReport = true;

        switch ($request->by) {
            case Room::FILTER_BY_ROOM:
                if (!empty($request->export)) {
                    return $this->excel->download(new BookingRoomExport($request), 'dat-phong-'.strtotime(date('ymdhis')).'.xlsx');
                }
                $items = $this->bookingRoomRepository->filter($request);

                return view('report.index', compact('items', 'title', 'menuReport'));
            case Room::FILTER_BY_RAE:
                if (!empty($request->export)) {
                    return $this->excel->download(new ReaExport($request), 'thu-chi-'.strtotime(date('ymdhis')).'.xlsx');
                }
                $items = $this->revenueAndExpenditureRepository->filter($request);

                return view('report.index', compact('items', 'title', 'menuReport'));
            case Room::FILTER_BY_STATUS_ROOM:
                $items = $this->bookingRoomRepository->filterStatusRoom($request);
                $rooms = $this->roomRepository->all();

                return view('report.index', compact('items', 'title', 'menuReport', 'rooms'));
            case Room::FILTER_BY_STATUS_ROOM_EMPTY:
                $items = $this->bookingRoomRepository->filterStatusRoomEmpty($request);
                $start_month = Carbon::now()->subMonths(6);
                $end_month = Carbon::now()->addMonths(6);
                $monthRanges = [];
                while($start_month < $end_month)
                {
                    array_push($monthRanges, $start_month->addMonth()->format('Y-m'));
                }

                return view('report.index', compact('items', 'title', 'menuReport', 'monthRanges'));
            default:
                return;
        }
    }
}
