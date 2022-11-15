<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\TypeRoomRepository;
use Illuminate\Http\Request;

class TypeRoomController extends Controller
{
    public $typeRoomRepository;
    public $roomRepository;

    public function __construct(
        Request $request,
        TypeRoomRepository $typeRoomRepository,
        RoomRepository $roomRepository
    ) {
        $this->request = $request;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->roomRepository = $roomRepository;
    }

    public function store(Request $request)
    {
        $result = $this->typeRoomRepository->store($request);

        if (isset($result['status']) && $result['status'] == false) {
            return redirect()->back()->withErrors($result['message']);
        }

        return redirect()->back()->with('success', __('Msg_create_success'));
    }

    public function update(Request $request)
    {
        $result = $this->typeRoomRepository->update($request);

        if (isset($result['status']) && $result['status'] == false) {
            return redirect()->back()->withErrors($result['message']);
        }

        return redirect()->back()->with('success', __('Msg_update_success'));
    }

    public function edit(Request $request, $type_room_id)
    {
        $request->merge(['type_room_id' => $type_room_id]);
        $currentTypeRoom = $this->typeRoomRepository->find($request);
        $menuSetup = true;
        $rooms = $this->roomRepository->getAll(false, true);
        $typeRooms = $this->typeRoomRepository->getAll();
        $typeRoomsSelect = $this->typeRoomRepository->getAll(false);
        $title = __('Room_management_f');
        return view('room.create', compact('typeRoomsSelect', 'menuSetup', 'rooms', 'typeRooms', 'currentTypeRoom', 'title'));
    }

    public function destroy(Request $request, $type_room_id)
    {
        $request->merge(['type_room_id' => $type_room_id]);
        $currentRoom = $this->typeRoomRepository->find($request);

        if ($this->roomRepository->findByTypeRoomId($type_room_id)) {
            return redirect()->back()->withErrors(__('Msg_delete_in_use_room'));
        }

        if (!empty($currentRoom)) {
            $currentRoom->delete();

            return redirect()->back()->with('success', __('Msg_deleted_success'));
        }

        return redirect()->back()->withErrors(__('Msg_try_again'));
    }
}
