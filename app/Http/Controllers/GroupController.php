<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GroupRepository;
use App\Repositories\BookingRoomCustomerRepository;
use App\Repositories\BookingRoomRepository;
use App\Repositories\RoomRepository;

class GroupController extends Controller
{
    protected $groupRepository;
    protected $bookingRoomCustomerRepository;
    protected $bookingRoomRepository;
    protected $RoomRepository;

    public function __construct(
        Request $request,
        GroupRepository $groupRepository,
        RoomRepository $roomRepository,
        BookingRoomCustomerRepository $bookingRoomCustomerRepository,
        BookingRoomRepository $bookingRoomRepository
    ) {
        $this->request = $request;
        $this->groupRepository = $groupRepository;
        $this->bookingRoomCustomerRepository = $bookingRoomCustomerRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
        $this->RoomRepository = $roomRepository;
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
        $floors = $this->RoomRepository->filterRoomBookingByDate($request);

        $menuCategoryManager = true;
        $title = __('Group_management');

        if ($request->ajax()) {
            return view('groups.modal-booking-room-group', compact('groups', 'menuCategoryManager', 'title'))->render();
        }

        return view('groups.index', compact('groups', 'menuCategoryManager', 'title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $group = $this->groupRepository->find($id);

        return response()->json([
            'group' => $group
        ]);
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
        $this->groupRepository->update($request, $id);

        return redirect()->back()->with('success', __('Msg_update_success'));
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

            return redirect()->back()->with('success', __('Msg_deleted_success'));
        }

        return redirect()->back()->withErrors(__('Msg_try_again'));
    }

    public function groupBookingInfo(Request $request)
    {
        $group = $this->groupRepository->getBookingInfo($request, false);
        $groups = $this->groupRepository->getBookingInfo($request, true);
        $roomIds = [];
        foreach ($groups as $group) {
            $roomIds[] = $group->room_id;
        }
        $floors = $this->RoomRepository->filterRoomBookingByDate($request, $roomIds);
        $action = 'edit';
        if ($request->ajax()) {
            return view('groups.modal-booking-room-group', compact('group', 'action', 'floors', 'roomIds'))->render();
        }
    }

    public function updateInfoBookingGroup($request)
    {
        return $this->groupRepository->updateInfoBooking($request);
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
