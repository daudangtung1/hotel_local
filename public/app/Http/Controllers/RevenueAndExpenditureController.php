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

        $title = 'Quản lý thu chi';

        return view('revenue_and_expenditure.index', compact('items', 'menuCategoryManager', 'title'));
    }

    public function store(Request $request)
    {
        $this->revenueAndExpenditureRepository->store($request);

        return redirect()->back()->with('success', 'Đăng ký thành công');
    }

    public function edit(Request $request, $id)
    {
        $currentItem = $this->revenueAndExpenditureRepository->find($id);
        $menuCategoryManager = true;
        $items = $this->revenueAndExpenditureRepository->getAll();
        $title = 'Cập nhật thu chi';

        return view('revenue_and_expenditure.index', compact('menuCategoryManager', 'items', 'currentItem', 'title'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->revenueAndExpenditureRepository->update($id, $request);

        if ($result) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        }
        return redirect()->back()->withErrors('Cập nhật thất bại.');
    }

    public function destroy(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $currentItem = $this->revenueAndExpenditureRepository->find($id);
        if (!empty($currentItem)) {
            $currentItem->delete();

            return redirect()->back()->with('success', 'Đã xoá thành công');
        }

        return redirect()->back()->withErrors('Vui lòng thử lại');
    }
}
