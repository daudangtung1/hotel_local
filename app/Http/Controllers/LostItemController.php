<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRoomRepository;
use App\Repositories\LostItemRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\TypeRoomRepository;
use Illuminate\Http\Request;

class LostItemController extends Controller
{

    public $roomRepository;

    public $serviceRepository;

    public $typeRoomRepository;

    public $lostItemRepository;

    public function __construct(LostItemRepository $lostItemRepository, TypeRoomRepository $typeRoomRepository, RoomRepository $roomRepository, ServiceRepository $serviceRepository, BookingRoomRepository $bookingRoomRepository)
    {
        $this->lostItemRepository = $lostItemRepository;
        $this->roomRepository = $roomRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->serviceRepository = $serviceRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
    }

    public function create(Request $request)
    {
        $lostItems = $this->lostItemRepository->getAll();
        $menuCategoryManager = true;
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBookingFinish();

        return view('lost_item.index', compact('lostItems', 'menuCategoryManager', 'bookingRooms'));
    }

    public function store(Request $request)
    {
        $this->lostItemRepository->store($request);
        $lostItems = $this->lostItemRepository->getAll();
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBookingFinish();

        return view('lost_item.table', compact('lostItems', 'bookingRooms'));
    }

    public function updateStatus(Request $request, $id)
    {
        $this->lostItemRepository->updateStatus($id);
        $lostItems = $this->lostItemRepository->getAll();
        $bookingRooms = $this->bookingRoomRepository->getAllRoomsBookingFinish();

        return view('lost_item.table', compact('lostItems', 'bookingRooms'));
    }
}
