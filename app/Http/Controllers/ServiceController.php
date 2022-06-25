<?php

namespace App\Http\Controllers;

use App\Repositories\ServiceRepository;
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
        $menuSystem = true;
        $services = $this->serviceRepository->getAll();
        $currentItem = null;
        return view('service.create', compact('menuSystem', 'services', 'currentItem'));
    }

    public function store(Request $request)
    {
        // TODO: validate
        $result = $this->serviceRepository->store($request);
        if ($result) {
            return redirect()->back()->with('success', 'Đăng ký thành công');
        }
    }

    public function edit(Request $request, $service_id)
    {
        $request->merge(['service_id' => $service_id]);
        $currentItem = $this->serviceRepository->find($request);

        $menuSetup = true;
        $services = $this->serviceRepository->getAll(false);
        return view('service.create', compact('menuSetup', 'services', 'currentItem'));
    }

    public function destroy(Request $request, $service_id)
    {
        $request->merge(['service_id' => $service_id]);
        $currentItem = $this->serviceRepository->find($request);

        if (!empty($currentItem)) {
            $result = $currentItem->delete();
            if ($result) {
                return redirect()->back()->with('success', 'Đã xoá thành công!');
            }
        }
        return redirect()->back()->with('success', 'Vui lòng thử lại!');
    }

    public function update(Request $request, $service_id)
    {
        $request->merge(['service_id' => $service_id]);
        if (!empty($request->id)) {
            $currentItem = $this->serviceRepository->find($request);
            if (!empty($currentItem)) {

                $result = $currentItem->update([
                    'name'  => $request->name ?? '',
                    'stock' => $request->stock ?? 0,
                    'price' => $request->price ?? 0,
                    'type'  => $request->type ?? 0
                ]);
                if ($result) {
                    return redirect()->back()->with('success', 'Đã lưu lại');
                }
            }
        } else {
            $result = $this->serviceRepository->store($request);
            if ($result) {
                return redirect()->back()->with('success', 'Đã lưu lại');
            }
        }
    }
}
