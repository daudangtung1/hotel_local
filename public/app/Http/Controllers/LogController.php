<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Repositories\LogRepository;
use Illuminate\Http\Request;

class LogController extends Controller
{
    protected $logRepository;

    public function __construct(
        Request $request,
        LogRepository $logRepository
    ) {
        $this->request = $request;
        $this->logRepository = $logRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $logs = $this->logRepository->getAll($request);
        $menuReport = true;
        $title = 'Quản lý hoạt động';

        return view('log.index', compact('logs', 'menuReport', 'title'));
    }
}
