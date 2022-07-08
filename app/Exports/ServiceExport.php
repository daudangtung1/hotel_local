<?php

namespace App\Exports;

use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ServiceExport implements FromView
{
    use Exportable;

    protected $serviceRepository;
    protected $request;

    public function __construct(ServiceRepository $serviceRepository, Request $request)
    {
        $this->serviceRepository = $serviceRepository;
        $this->request = $request;
    }

    public function getServices()
    {
        $services = $this->serviceRepository->filter($this->request);

        return $services;
    }

    public function view(): View
    {
        $services = $this->getServices();

        return view('exports.services', [
            'services' => $services
        ]);
    }
}
