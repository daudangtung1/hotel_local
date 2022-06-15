<?php

namespace App\Http\Controllers;

use App\Repositories\serviceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $floors = $this->serviceRepository->getAll();

        return view('service.index', compact('floors'));
    }

    public function create()
    {
        $menuSetup = true;
        return view('service.create', compact('menuSetup'));
    }

    public function store(Request $request)
    {
        // TODO: validate
        $result = $this->serviceRepository->store($request);
        if ($result) {
            return redirect()->back()->with('success', 'Đăng ký thành công');
        }
    }
}
