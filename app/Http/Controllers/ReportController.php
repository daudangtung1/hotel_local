<?php

namespace App\Http\Controllers;

use App\Exports\BookingRoomExport;
use App\Exports\ReaExport;
use App\Models\Room;
use App\Repositories\BookingRoomRepository;
use App\Repositories\BookingRoomServiceRepository;
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

    public function __construct(
        Request $request,
        BookingRoomServiceRepository $bookingRoomServiceRepository,
        RevenueAndExpenditureRepository $revenueAndExpenditureRepository,
        Excel $excel,
        TypeRoomRepository $typeRoomRepository,
        RoomRepository $roomRepository,
        ServiceRepository $serviceRepository,
        BookingRoomRepository $bookingRoomRepository
    ) {
        $this->request = $request;
        $this->excel = $excel;
        $this->roomRepository = $roomRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->serviceRepository = $serviceRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
        $this->revenueAndExpenditureRepository = $revenueAndExpenditureRepository;
        $this->bookingRoomServiceRepository = $bookingRoomServiceRepository;
    }

    public function index(Request $request)
    {
        $title = __('Report_management');
        $menuReport = true;

        switch ($request->by) {
            case Room::FILTER_BY_ROOM:
                if (!empty($request->export)) {
                    return $this->excel->download(new BookingRoomExport($request), 'dat-phong-' . strtotime(date('ymdhis')) . '.xlsx');
                }
                $items = $this->bookingRoomRepository->filter($request);

                return view('report.index', compact('items', 'title', 'menuReport'));
            case Room::FILTER_BY_RAE:
                if (!empty($request->export)) {
                    return $this->excel->download(new ReaExport($request), 'thu-chi-' . strtotime(date('ymdhis')) . '.xlsx');
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
                while ($start_month < $end_month) {
                    array_push($monthRanges, $start_month->addMonth()->format('Y-m'));
                }

                return view('report.index', compact('items', 'title', 'menuReport', 'monthRanges'));
            case Room::FILTER_FREQUENCY:
                $items = $this->bookingRoomRepository->filterStatusRoomEmpty($request);
                $types = $this->typeRoomRepository->getAll(false, 'ASC');
                $start_month = Carbon::now()->subMonths(6);
                $end_month = Carbon::now()->addMonths(6);

                $from_date = $request->get('start_date') ?? Carbon::now()->subDays(15)->format('Y-m-d');
                $to_date   = $request->get('end_date') ?? Carbon::now()->format('Y-m-d');
                $monthRanges = [];
                $chart = $this->addChart($request);
                while ($start_month < $end_month) {
                    array_push($monthRanges, $start_month->addMonth()->format('Y-m'));
                }

                return view('report.index', compact('items', 'title', 'from_date', 'to_date', 'types', 'chart', 'menuReport', 'monthRanges'));
            case Room::SERVICE:
                $services = $this->serviceRepository->getAll();
                $bookingRoomServices = $this->bookingRoomServiceRepository->all($request);
                return view('report.index', compact('bookingRoomServices', 'services', 'title', 'menuReport'));
            default:
                return;
        }
    }

    public function addChart($request)
    {
        $fromDate = $request->get('start_date') ? Carbon::createFromFormat('Y-m-d', $request->get('start_date')) : Carbon::now()->subDays(15);
        $toDate   = $request->get('end_date') ? Carbon::createFromFormat('Y-m-d', $request->get('end_date')) : Carbon::now();
        $type = $request->get('room_type');

        $dates = [];

        for ($d = $fromDate; $d->lte($toDate); $d->addDay()) {
            $dates[] = $d->format('Y-m-d');
        }

        $dataSets = [];

        $room_used = new \stdClass();
        $room_used->label = 'Phòng đã sử dụng';
        $room_used->backgroundColor = '#3483eb';

        $room_free = new \stdClass();
        $room_free->label = 'Phòng trống';
        $room_free->backgroundColor = '#b35d52';

        foreach ($dates as $date) {
            $totalRoomUsed = $this->bookingRoomRepository->totalRoomBooked($date, $type);
            $totalRoomFree = 32 - $totalRoomUsed;
            $room_used->data[] = $totalRoomUsed;
            $room_free->data[] = $totalRoomFree;
        }

        $dataSets = [
            'labels' => $dates,
            'room_used' => $room_used,
            'room_free' => $room_free
        ];

        return $dataSets;
    }
}
