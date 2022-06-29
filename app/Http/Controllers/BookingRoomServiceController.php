<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRoomRepository;
use App\Repositories\BookingRoomServiceRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingRoomServiceController extends Controller
{
    public function __construct(BookingRoomServiceRepository $bookingRoomServiceRepository, RoomRepository $roomRepository, ServiceRepository $serviceRepository, BookingRoomRepository $bookingRoomRepository)
    {
        $this->bookingRoomServiceRepository = $bookingRoomServiceRepository;
        $this->bookingRoomRepository = $bookingRoomRepository;
        $this->roomRepository = $roomRepository;
        $this->serviceRepository = $serviceRepository;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->bookingRoomServiceRepository->destroy($request);

        $floors = $this->roomRepository->getAll();
        $services = $this->serviceRepository->getAll();
        $room = $this->roomRepository->find($request);

        return view('room.modal-content-room', compact('room', 'services', 'floors'))->render();
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $bookingRoomService = $this->bookingRoomServiceRepository->getById($id);
            if (empty($request->quantity)) {
                return [
                    'response' => [
                        'code' => 400,
                        'message' => "Số lượng không được để trống"
                    ]
                ];
            }
            if (
                empty($bookingRoomService) ||
                empty($bookingRoomService->service) ||
                ($bookingRoomService->quantity + $bookingRoomService->service->stock) < $request->quantity
            ) {
                return [
                    'response' => [
                        'code' => 400,
                        'message' => "Vượt quá số lượng tồn kho"
                    ]
                ];
            }
            $this->bookingRoomServiceRepository->update($request, $id);

            DB::commit();
            $floors = $this->roomRepository->getAll();
            $services = $this->serviceRepository->getAll();
            $request->room_id = $bookingRoomService->bookingRoom->room_id;
            $room = $this->roomRepository->find($request);

            return view('room.modal-content-room', compact('room', 'services', 'floors'))->render();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return [
                'response' => [
                    'code' => 400,
                    'message' => "Quá trình cập nhật bị lỗi!"
                ]
            ];
        }
    }
}
