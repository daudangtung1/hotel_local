<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoomService;

class RoomController extends Controller
{
    public $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function index()
    {
        $floors = $this->roomService->getAll();

        return view('room.index', compact('floors'));
    }

    public function create()
    {
        $menuSetup = true;
        return view('room.create', compact('menuSetup'));
    }
}
