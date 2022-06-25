<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\TypeRoom;
use Carbon\Carbon;
use DB;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class TypeRoomRepository extends ModelRepository
{
    protected $model;
    private static $instance;

    public function __construct(TypeRoom $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->orderBy('ID', 'DESC')->paginate(10);
    }

    public function find($request)
    {
        return $this->model->find($request->type_room_id);
    }

    public function delete($type_room_id)
    {
        return $this->model->findOrFail($type_room_id)->delete();
    }

    public function store($request)
    {
        $typeRoomExists = $this->model
            ->where('name', $request->name)->exists();

        if ($typeRoomExists) {
            return [
                'status'  => false,
                'message' => 'Loại phòng đã tồn tại'
            ];
        }

        return $this->model->create([
            'name'       => $request->name,
        ]);
    }

    public function update($request)
    {
        $typeRoomExists = $this->model
            ->where('name', $request->name)
            ->where('id', '<>',$request->type_room_id)
            ->exists();

        if ($typeRoomExists) {
            return [
                'status'  => false,
                'message' => 'Loại phòng đã tồn tại'
            ];
        }

        return $this->model->where('id', $request->type_room_id)->update([
            'name'       => $request->name ?? '',
        ]);
    }
}