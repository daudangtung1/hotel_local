<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class UserRepository extends ModelRepository
{
    protected $model;
    protected $room;

    public function __construct(User $model, Room $room)
    {
        $this->model = $model;
        $this->room = $room;
    }

    public function getAll()
    {
        return $this->model->orderBy('ID', 'DESC')->where('id', '<>', Auth::user()->id)->paginate(10);
    }

    public function find($request)
    {
        return $this->model->find($request->user_id);
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
                'message' => __('Msg_email_exist')
            ];
        }

        $emailExists = $this->model->where('name', $request->name)->exists();

        if ($emailExists) {
            return [
                'status'  => false,
                'message' => __('Msg_username_exist')
            ];
        }

        $data = [
            'name'  => $request->name ?? '',
            'email' => $request->email ?? '',
            'branch_id' => $request->branch_id ?? get_branch_id(),
        ];

        if (!empty($request->password) && !empty($request->re_password)) {
            $data['password'] = bcrypt($request->password);
        }
        $user = $this->model->create($data);
        $user->assignRole($request->input('roles'));
        return $user;
    }

    public function update($request)
    {
        $emailExists = $this->model
            ->where('email', $request->email)
            ->where('id', '!=', $request->user_id)->exists();

        if ($emailExists) {
            return [
                'status'  => false,
                'message' => __('Msg_email_exist')
            ];
        }

        $data = [
            'email' => $request->email ?? '',
            'branch_id' => $request->branch_id ?? '',
        ];

        if (!empty($request->password) && !empty($request->re_password)) {
            $data['password'] = bcrypt($request->password);
        }
        $user = $this->model->where('id', $request->user_id)->update($data);
        DB::table('model_has_roles')->where('model_id', $request->user_id)->delete();
        $this->model->find($request->user_id)->assignRole($request->input('roles'));
        return $user;
    }
}
