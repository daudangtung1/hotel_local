<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRoomRepository;
use App\Repositories\RevenueAndExpenditureRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class RevenueAndExpenditureController extends Controller
{
    public $userRepository;

    public $revenueAndExpenditureRepository;

    public function __construct(
        Request $request,
        RevenueAndExpenditureRepository $revenueAndExpenditureRepository
    ) {
        $this->request = $request;
        $this->revenueAndExpenditureRepository = $revenueAndExpenditureRepository;
    }

    public function index(Request $request)
    {
        $items = $this->revenueAndExpenditureRepository->getAll();
        $menuCategoryManager = true;

        $title = __('Revenue_management');

        return view('revenue_and_expenditure.index', compact('items', 'menuCategoryManager', 'title'));
    }

    public function store(Request $request)
    {
        $this->revenueAndExpenditureRepository->store($request);

        return redirect()->back()->with('success', __('Msg_create_success'));
    }

    public function edit(Request $request, $id)
    {
        $currentItem = $this->revenueAndExpenditureRepository->find($id);
        $menuCategoryManager = true;
        $items = $this->revenueAndExpenditureRepository->getAll();
        $title = __('Update_revenue_expenditure');

        return view('revenue_and_expenditure.index', compact('menuCategoryManager', 'items', 'currentItem', 'title'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->revenueAndExpenditureRepository->update($id, $request);

        if ($result) {
            return redirect()->back()->with('success', __('Msg_update_success'));
        }
        return redirect()->back()->withErrors(__('Msg_update_fail'));
    }

    public function destroy(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $currentItem = $this->revenueAndExpenditureRepository->find($id);
        if (!empty($currentItem)) {
            $currentItem->delete();

            return redirect()->back()->with('success', __('Msg_deleted_success'));
        }

        return redirect()->back()->withErrors(__('Msg_try_again'));
    }
}
