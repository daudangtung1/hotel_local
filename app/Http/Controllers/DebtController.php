<?php

namespace App\Http\Controllers;

use App\Repositories\DebtRepository;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public $debtRepository;

    public function __construct(
        DebtRepository $debtRepository
    ) {
        $this->debtRepository = $debtRepository;
    }

    public function index(Request $request)
    {
        $items = $this->debtRepository->getAll();
        $menuCategoryManager = true;
        $title = 'Quản lý công nợ';

        return view('debt.index', compact('items', 'menuCategoryManager', 'title'));
    }

    public function store(Request $request)
    {
        $this->lostItemRepository->store($request);
        $items = $this->lostItemRepository->getAll();

        return view('debt.table', compact('items'));
    }

    public function updateStatus(Request $request, $id)
    {
        $this->lostItemRepository->updateStatus($request, $id);
        $items = $this->lostItemRepository->getAll();

        return view('debt.table', compact('items'));
    }
}
