<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRoomRepository;
use App\Repositories\OptionRepository;
use App\Repositories\RevenueAndExpenditureRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function __construct(
        Request $request,
        RevenueAndExpenditureRepository $revenueAndExpenditureRepository,
        OptionRepository $optionRepository,
        RoomRepository $roomRepository,
        ServiceRepository $serviceRepository,
        BookingRoomRepository $bookingRoomRepository
    ) {
        $this->request = $request;
        $this->revenueAndExpenditureRepository = $revenueAndExpenditureRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
        $this->roomRepository = $roomRepository;
        $this->serviceRepository = $serviceRepository;
        $this->optionRepository = $optionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $items = $this->revenueAndExpenditureRepository->getAll();
        $menuCategoryManager = true;

        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBookingUsed();

        $title = 'Quản lý quỹ';

        return view('fund.index', compact('items', 'bookingRooms', 'menuCategoryManager', 'title'));
    }
}
