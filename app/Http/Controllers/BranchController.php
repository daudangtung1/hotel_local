<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRoomRepository;
use App\Repositories\BranchRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public $userRepository;

    public $BranchRepository;

    public function __construct(BranchRepository $BranchRepository)
    {
        $this->BranchRepository = $BranchRepository;
    }

    public function index(Request $request)
    {
        $items = $this->BranchRepository->getAll(false);
        $menuCategoryManager = true;

        $title = __('Branch_management_f');

        return view('branch.list', compact('items', 'menuCategoryManager', 'title'));
    }

    public function create(Request $request)
    {
        $items = $this->BranchRepository->getAll();
        $menuCategoryManager = true;

        $title = __('Branch_management_f');

        return view('branch.index', compact('items', 'menuCategoryManager', 'title'));
    }

    public function store(Request $request)
    {
        $this->BranchRepository->store($request);

        return redirect()->back()->with('success', __('Msg_create_success'));
    }

    public function edit(Request $request, $id)
    {
        $currentItem = $this->BranchRepository->find($id);
        $menuCategoryManager = true;
        $items = $this->BranchRepository->getAll();
        $title = __('Update_branch');

        return view('branch.index', compact('menuCategoryManager', 'items', 'currentItem', 'title'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->BranchRepository->update($id, $request);

        if ($result) {
            return redirect()->back()->with('success', __('Msg_update_success'));
        }
        return redirect()->back()->withErrors(__('Msg_update_fail'));
    }

    public function destroy(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $currentItem = $this->BranchRepository->find($id);
        if (!empty($currentItem)) {
            $currentItem->delete();

            return redirect()->back()->with('success', __('Msg_deleted_success'));
        }

        return redirect()->back()->withErrors(__('Msg_try_again'));
    }
}
