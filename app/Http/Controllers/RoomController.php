<?php

namespace App\Http\Controllers;

use App\Repositories\RoomRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function index()
    {
        $floors = $this->roomRepository->getAll();

        return view('room.index', compact('floors'));
    }

    public function create()
    {
        $menuSetup = true;
        return view('room.create', compact('menuSetup'));
    }

    public function store(Request $request)
    {
        // TODO: validate
        $result = $this->roomRepository->store($request);
        if ($result) {
            return redirect()->back()->with('success', 'Đăng ký thành công');
        }
    }
}
