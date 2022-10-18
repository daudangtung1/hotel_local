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
        // $this->middleware('permission:edit articles');
        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->getAll();
        $menuSetup = true;
        $roles = Role::pluck('name','name')->all();

        $title = 'Quản lý người dùng';

        return view('user.create', compact('users', 'roles', 'menuSetup', 'title'));
    }

    public function store(Request $request)
    {
        $result = $this->userRepository->store($request);
        if (isset($result['status']) && $result['status'] == false) {
            return redirect()->back()->withErrors($result['message']);
        }
        return redirect()->back()->with('success', 'Đăng ký thành công');
    }

    public function edit(Request $request, $user_id)
    {
        $request->merge(['user_id' => $user_id]);
        $currentItem = $this->userRepository->find($request);

        $menuSystem = true;
        $users = $this->userRepository->getAll();
        $title = 'Cập nhật người dùng';
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

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    public function destroy(Request $request, $user_id)
    {
        $request->merge(['user_id' => $user_id]);
        $currentItem = $this->userRepository->find($request);
        if (!empty($currentItem)) {
            $currentItem->delete();

            return redirect()->back()->with('success', 'Đã xoá thành công');
        }

        return redirect()->back()->withErrors('Vui lòng thử lại');
    }
}
