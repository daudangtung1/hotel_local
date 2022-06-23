<?php

namespace App\Repositories;

use App\Models\Room;
use Carbon\Carbon;
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

    public function getAll($sortByFloor = true)
    {
        $rooms = $this->model->orderBy('floor', 'ASC')->whereNotNull('floor')->get();
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

    public function find($request)
    {
        return $this->model->find($request->room_id);
    }

    public function changeStatus($request)
    {
        $room = $this->model->find($request->room_id);

        if (!in_array($room->status, [1, 2])) {
            return 'Trạng thái phòng không hợp lệ.';
        }

        if (!empty($room)) {
            if ($room->status == 1) {
                $room->update(['status' => $this->model::DIRTY]);
                $room->bookingRooms()->where('status', 1)->update(['status' => 2, 'checkout_date' => Carbon::now()]);
            } else if ($room->status == 2) {
                $room->update(['status' => $this->model::READY]);
                $room->bookingRooms()->where('status', 2)->update([
                    'status' => 3,
                ]);
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
            'name'       => $request->name,
            'floor'      => $request->floor,
            'type'       => $request->type,
            'day_price'  => $request->day_price,
            'hour_price' => $request->hour_price,
            'status'     => $request->status,
            'user_id'    => \Auth::user()->id
        ]);
    }

    public function update($request)
    {
        return $this->model->where('id', $request->room_id)->update([
            'name'       => $request->name ?? '',
            'floor'      => $request->floor ?? '',
            'type'       => $request->type ?? 0,
            'day_price'  => $request->day_price ?? 0,
            'hour_price' => $request->hour_price ?? 0,
            'status'     => $request->status ?? 0,
        ]);
    }
}
