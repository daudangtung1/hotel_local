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

    public function __construct(RevenueAndExpenditureRepository $revenueAndExpenditureRepository, OptionRepository $optionRepository, RoomRepository $roomRepository, ServiceRepository $serviceRepository, BookingRoomRepository $bookingRoomRepository)
    {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
