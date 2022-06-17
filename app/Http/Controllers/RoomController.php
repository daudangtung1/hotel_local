<?php

namespace App\Http\Controllers;

use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public $roomRepository;

    public $serviceRepository;

    public function __construct(RoomRepository $roomRepository, ServiceRepository $serviceRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $floors = $this->roomRepository->getAll();
        $services = $this->serviceRepository->getAll();

        return view('room.index', compact('floors', 'services'));
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
