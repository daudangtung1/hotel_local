<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\BookingRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\ShiftRepository;
use App\Repositories\TypeRoomRepository;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ShiftController extends Controller
{
    public $roomRepository;

    public $serviceRepository;

    public $typeRoomRepository;

    public function __construct(
        Request $request,
        ShiftRepository $shiftRepository,
        TypeRoomRepository $typeRoomRepository,
        RoomRepository $roomRepository,
        ServiceRepository $serviceRepository,
        BookingRoomRepository $bookingRoomRepository
    ) {
        $this->request = $request;
        $this->shiftRepository = $shiftRepository;
        $this->roomRepository = $roomRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->serviceRepository = $serviceRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Quản lý giao ca';
        $menuCategoryManager = true;
        $users = User::all();
        $items = $this->shiftRepository->getAll();
        return view('shift.index', compact('items', 'title', 'menuCategoryManager', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->shiftRepository->store($request);

        return redirect()->route('shifts.index')->with('success', 'Tạo mới thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $shift_id)
    {
        $request->merge(['shift_id' => $shift_id]);
        $currentItem = $this->shiftRepository->find($request);
        $title = 'Quản lý giao ca';
        $menuCategoryManager = true;
        $users = User::all();
        $items = $this->shiftRepository->getAll();
        return view('shift.index', compact('items', 'title', 'menuCategoryManager', 'users', 'currentItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->shiftRepository->update($request);

        return redirect()->route('shifts.index')->with('success', 'Cập nhật thành công');
    }
}
