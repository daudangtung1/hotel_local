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

    public function __construct(TypeRoom $model)
    {
        $this->model = $model;
    }

    public function getAll($paginate = true, $orderBy = 'DESC')
    {
        $query = $this->model->where('branch_id', get_branch_id())->orderBy('ID', $orderBy);

        if ($paginate) {
            return $query->paginate(10);
        }

        return $query->get();
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
            ->where('branch_id', get_branch_id())
            ->where('name', $request->name)->exists();

        if ($typeRoomExists) {
            return [
                'status'  => false,
                'message' => __('Msg_room_type_exist')
            ];
        }

        return $this->model->create([
            'name'       => $request->name,
            'branch_id' => get_branch_id(),
        ]);
    }

    public function update($request)
    {
        $typeRoomExists = $this->model
            ->where('name', $request->name)
            ->where('id', '<>', $request->type_room_id)
            ->exists();

        if ($typeRoomExists) {
            return [
                'status'  => false,
                'message' => __('Room_type_exists')
            ];
        }

        return $this->model->where('id', $request->type_room_id)->update([
            'name'       => $request->name ?? '',
        ]);
    }
}
