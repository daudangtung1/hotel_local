<?php

namespace App\Repositories;

use App\Models\Room;
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

    public function getAll()
    {
        $rooms = $this->model->orderBy('floor', 'ASC')->get();
        $data = [];

        foreach ($rooms as $room) {
            $data[$room->floor][] = $room;
        }

        return $data;
    }
}
