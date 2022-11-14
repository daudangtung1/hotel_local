<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $userRepository;

    public $serviceRepository;

    public function __construct(
        Request $request,
        UserRepository $userRepository
    ) {
        // $this->middleware('permission:role-delete');
        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->getAll();
        $menuSetup = true;
        $roles = Role::pluck('name','name')->all();

        $title = __('User_management');

        return view('user.create', compact('users', 'roles', 'menuSetup', 'title'));
    }

    public function store(Request $request)
    {
        $result = $this->userRepository->store($request);
        if (isset($result['status']) && $result['status'] == false) {
            return redirect()->back()->withErrors($result['message']);
        }
        return redirect()->back()->with('success', __('Msg_create_success'));
    }

    public function edit(Request $request, $user_id)
    {
        $request->merge(['user_id' => $user_id]);
        $currentItem = $this->userRepository->find($request);

        $menuSystem = true;
        $users = $this->userRepository->getAll();
        $title = __('Update_user');
        $roles = Role::pluck('name','name')->all();
        $userRole = $currentItem->roles->pluck('name','name')->all();

        return view('user.create', compact('menuSystem', 'users', 'roles', 'userRole', 'currentItem', 'title'));
    }

    public function update(Request $request)
    {
        $result = $this->userRepository->update($request);
        if (isset($result['status']) && $result['status'] == false) {
            return redirect()->back()->withErrors($result['message']);
        }

        return redirect()->back()->with('success', __('Msg_update_success'));
    }

    public function destroy(Request $request, $user_id)
    {
        $request->merge(['user_id' => $user_id]);
        $currentItem = $this->userRepository->find($request);
        if (!empty($currentItem)) {
            $currentItem->delete();

            return redirect()->back()->with('success', __('Msg_deleted_success'));
        }

        return redirect()->back()->withErrors(__('Msg_try_again'));
    }
}
