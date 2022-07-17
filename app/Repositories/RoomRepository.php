<?php

namespace App\Repositories;

use App\Models\Room;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class RoomRepository extends ModelRepository
{
    protected $model;
    private static $instance;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new RoomRepository(new Room());
        }

        return self::$instance;
    }

    public function getAll($sortByFloor = true, $paginate = false, $request = null)
    {
        $rooms = $this->model;

        if ($request) {
            $typeRoom = $request->get('type_room');
            $orderBy = $request->get('order_by', 'ASC');
            $area = $request->get('area');
            if ($area) {
                $rooms = $rooms->where('floor', $area);
            }

            if (isset($typeRoom)) {
                $rooms = $rooms->where('status', $typeRoom);
            }

            $rooms = $rooms->orderBy('id', $orderBy);
        }

        $rooms = $rooms->orderBy('floor', 'ASC')->whereNotNull('floor');

        if ($paginate) {
            $rooms = $rooms->paginate(10);
        } else {
            $rooms = $rooms->get();
        }

        if (!$sortByFloor) {
            return $rooms;
        }

        $data = [];
        if (!empty($rooms)) {
            $floorData = array_unique($rooms->pluck('floor')->toArray());
            sort($floorData);
            foreach ($floorData as $floor) {
                foreach ($rooms as $room) {
                    if ($floor == $room->floor) {
                        $data[$room->floor][] = $room;
                    }
                }
            }
        }
        return $data;
    }

    public function filterRoomBookingByDate($request)
    { 
        $startDate = $request->get('start_date');
        $endDate   = $request->get('end_date');
        $rooms = $this->model->select('rooms.*')
                             ->whereNotIn('id', function($q) use($startDate, $endDate) {
                                 $q->select('room_id')->from('booking_rooms')
                                                  ->join('rooms', 'rooms.id', '=', 'booking_rooms.room_id')
                                                  ->where(\DB::raw("'$startDate' BETWEEN booking_rooms.start_date AND booking_rooms.end_date
                                                  OR '$endDate' BETWEEN booking_rooms.start_date AND booking_rooms.end_date
                                                  OR booking_rooms.start_date BETWEEN '$startDate' AND '$endDate'
                                                  OR booking_rooms.end_date BETWEEN '$startDate' AND '$endDate'"));
                            })
                            ->whereNotNull('floor')
                            ->orderBy('rooms.id', 'ASC')
                            ->orderBy('floor', 'ASC')
                            ->get();
        $data = [];
        if (!empty($rooms)) {
            $floorData = array_unique($rooms->pluck('floor')->toArray());
            sort($floorData);
            foreach ($floorData as $floor) {
                foreach ($rooms as $room) {
                    if ($floor == $room->floor) {
                        $data[$room->floor][] = $room;
                    }
                }
            }
        }
        
        return $data;
    }

    public function find($request)
    {
        return $this->model->find($request->room_id);
    }

    public function findByTypeRoomId($type_room_id)
    {
        return $this->model->where('type_room_id', $type_room_id)->exists();
    }

    public function changeStatus($request)
    {
        $room = $this->model->find($request->room_id);

//        if (!in_array($room->status, [1, 2])) {
//            return 'Trạng thái phòng không hợp lệ.';
//        }

        if (!empty($room) && $room->status > 0) {
            if ($room->status == $this->model::HAVE_GUEST) {
                $room->update(['status' => $this->model::DIRTY]);
                $room->bookingRooms()->where('status', $this->model::HAVE_GUEST)->update([
                    'status'        => $this->model::DIRTY,
                    'checkout_date' => Carbon::now()
                ]);
            } else if (in_array($room->status, [2, 3, 5])) {
                $room->update(['status' => $this->model::READY]);
                $room->bookingRooms()->whereIn('status', [2, 3, 5])->update([
                    'status' => $this->model::CLOSED,
                ]);
            } else {

            }
        }

        return true;
    }

    public function delete($room_id)
    {
        return $this->model->findOrFail($room_id)->delete();
    }

    public function store($request)
    {
        return $this->model->create([
            'name'         => $request->name,
            'floor'        => $request->floor,
            'type'         => $request->type,
            'month_price'  => $request->month_price ?? 0,
            'day_price'    => $request->day_price ?? 0,
            'hour_price'   => $request->hour_price ?? 0,
            'status'       => $request->status ?? 0,
            'user_id'      => \Auth::user()->id,
            'type_room_id' => $request->type ?? null
        ]);
    }

    public function update($request)
    {
        return $this->model->where('id', $request->room_id)->update([
            'name'         => $request->name ?? '',
            'floor'        => $request->floor ?? '',
            'type'         => $request->type ?? 0,
            'month_price'  => $request->month_price ?? 0,
            'day_price'    => $request->day_price ?? 0,
            'hour_price'   => $request->hour_price ?? 0,
            'status'       => $request->status ?? 0,
            'type_room_id' => $request->type ?? null
        ]);
    }
}
