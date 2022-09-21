<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userRepository;

    public $serviceRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->getAll();
        $menuSetup = true;

        $title = 'Quản lý người dùng';

        return view('user.create', compact('users', 'menuSetup', 'title'));
    }

    public function store(Request $request)
    {
        $result = $this->userRepository->store($request);
        if (!$result['status']) {
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

        return view('user.create', compact('menuSystem', 'users', 'currentItem', 'title'));
    }

    public function update(Request $request)
    {
        // TODO: validate
        $result = $this->userRepository->update($request);
        if (!$result['status']) {
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
