<?php

namespace App\Http\Controllers;

use App\Exports\ServiceExport;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public $serviceRepository;

    public function __construct(
        Request $request,
        ServiceRepository $serviceRepository
    ) {
        $this->request = $request;
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
       abort(404);
    }

    public function create()
    {
        $menuSystem = true;
        $services = $this->serviceRepository->getAll(true);
        $currentItem = null;
        $title = __('Create_service');

        return view('service.create', compact('menuSystem', 'services', 'currentItem', 'title'));
    }

    public function store(Request $request)
    {
        $result = $this->serviceRepository->store($request);
        if ($result) {
            return redirect()->back()->with('success', __('Msg_create_success'));
        }
    }

    public function edit(Request $request, $service_id)
    {
        $request->merge(['service_id' => $service_id]);
        $currentItem = $this->serviceRepository->find($request);

        $menuSetup = true;
        $services = $this->serviceRepository->getAll();
        $title = __('Update_service');

        return view('service.create', compact('menuSetup', 'services', 'currentItem', 'title'));
    }

    public function destroy(Request $request, $service_id)
    {
        $request->merge(['service_id' => $service_id]);
        $currentItem = $this->serviceRepository->find($request);

        if (!empty($currentItem)) {
            $result = $currentItem->delete();
            if ($result) {
                return redirect()->back()->with('success', __('Msg_deleted_success'));
            }
        }
        return redirect()->back()->with('success', __('Msg_try_again'));
    }

    public function update(Request $request, $service_id)
    {
        $request->merge(['service_id' => $service_id]);
        if (!empty($request->id)) {
            $currentItem = $this->serviceRepository->find($request);
            if (!empty($currentItem)) {

                $result = $currentItem->update([
                    'name'  => $request->name ?? '',
                    'stock' => $request->stock ?? 100,
                    'price' => $request->price ?? 0,
                    'type'  => $request->type ?? 0,
                    'sale_type'  => $request->sale_type ?? 0,
                ]);
                if ($result) {
                    return redirect()->back()->with('success', __('Msg_saved'));
                }
            }
        } else {
            $result = $this->serviceRepository->store($request);
            if ($result) {
                return redirect()->back()->with('success', __('Msg_saved'));
            }
        }
    }

    public function report(Request $request)
    {
        $menuReport = true;
        if (!empty($request->export)) {
            return (app(ServiceExport::class))->download('services.xlsx');
        }
        $title = __('Import_goods_report');
        $services = $this->serviceRepository->filter($request);

        return view('service.report', compact('services', 'menuReport', 'title'));
    }
}
