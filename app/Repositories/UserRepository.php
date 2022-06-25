<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use DB;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class UserRepository extends ModelRepository
{
    protected $model;
    private static $instance;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->orderBy('ID', 'DESC')->get();
    }

    public function find($request)
    {
        return $this->model->find($request->user_id);
    }

    public function changeStatus($request)
    {
        $room = $this->model->find($request->user_id);

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

    public function delete($user_id)
    {
        return $this->model->findOrFail($user_id)->delete();
    }

    public function store($request)
    {
        $emailExists = $this->model->where('email', $request->email)->exists();

        if ($emailExists) {
            return [
                'status'  => false,
                'message' => 'Email đã tồn tại'
            ];
        }

        $emailExists = $this->model->where('name', $request->name)->exists();

        if ($emailExists) {
            return [
                'status'  => false,
                'message' => 'Tên tài khoản đã tồn tại'
            ];
        }

        $data = [
            'name'  => $request->name ?? '',
            'email' => $request->email ?? '',
        ];

        if (!empty($request->password) && !empty($request->re_password)) {
            $data['password'] = bcrypt($request->password);
        }
        return $this->model->create($data);
    }

    public function update($request)
    {
        $emailExists = $this->model
            ->where('email', $request->email)
            ->where('id', '!=', $request->user_id)->exists();

        if ($emailExists) {
            return [
                'status'  => false,
                'message' => 'Email đã tồn tại'
            ];
        }

        $data = [
            'email' => $request->email ?? '',
        ];

        if (!empty($request->password) && !empty($request->re_password)) {
            $data['password'] = bcrypt($request->password);
        }

        return $this->model->where('id', $request->user_id)->update($data);
    }
}
