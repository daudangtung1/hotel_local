<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\GroupRepository;
use App\Repositories\BookingRoomCustomerRepository;
use App\Repositories\BookingRoomRepository;

class GroupController extends Controller
{
    protected $groupRepository;
    protected $bookingRoomCustomerRepository;
    protected $bookingRoomRepository;

    public function __construct(GroupRepository $groupRepository, BookingRoomCustomerRepository $bookingRoomCustomerRepository, BookingRoomRepository $bookingRoomRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->bookingRoomCustomerRepository = $bookingRoomCustomerRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groups = $this->groupRepository->getInfoGroupBooking($request);
        $menuCategoryManager = true;
        $title = 'Quản lý đoàn';

        if ($request->ajax()) {
            return view('groups.modal-booking-room-group')->render();
        }

        return view('groups.index', compact('groups', 'menuCategoryManager', 'title'));
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
    public function show(Request $request, $id)
    {

        $group = $this->groupRepository->find($request);
        
        return response()->json([
            'group' => $group
        ]);
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
    public function destroy(Request $request, $group_id)
    {
        $request->merge(['group_id' => $group_id]);
        $currentItem = $this->groupRepository->find($group_id);
        $bookingIds = [];
        $bookingRoomCustomers = $this->bookingRoomCustomerRepository->getBookingCustomerGroup($group_id);
        foreach ($bookingRoomCustomers as $booking) {
            $bookingIds[] = $booking->booking_room_id;
        }

        if (!empty($currentItem)) {
            $currentItem->delete();
            $this->bookingRoomCustomerRepository->deleteByGroupId($group_id);
            $this->bookingRoomRepository->deleteByIds($bookingIds);
            $this->groupRepository->deleteGroupCustomer($group_id);

            return redirect()->back()->with('success', 'Đã xoá thành công');
        }

        return redirect()->back()->withErrors('Vui lòng thử lại');
    }

    public function groupBookingInfo(Request $request)
    {
        $group = $this->groupRepository->getBookingInfo($request, false);
        $groups = $this->groupRepository->getBookingInfo($request, true);
        $roomIds = [];
        foreach ($groups as $group) {
            $roomIds[] = $group->room_id;
        }
        $action = 'edit';
        if ($request->ajax()) {
            return view('groups.modal-booking-room-group', compact('group', 'action', 'roomIds'))->render();
        }
    }

    public function cancelBooking(Request $request)
    {
        return $this->groupRepository->cancelBooking($request);
    }

    public function filter(Request $request)
    {
        $groups = $this->groupRepository->filter($request);
        return view('groups.list-group-booking', compact('groups'))->render();
    }
}
