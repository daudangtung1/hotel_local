<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GroupRepository;

class GroupController extends Controller
{
    protected $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groups = $this->groupRepository->getAll(true);
        $menuCategoryManager = true;
        $title = 'Quản lý đoàn';

        if ($request->ajax()) {
            return view('groups.modal-booking-room-group')->render();
        }

        return view('groups.index', compact('groups', 'menuCategoryManager', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = $this->groupRepository->find($id);

        return response()->json([
            'group' => $group
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$group_id)
    {
        $request->merge(['group_id' => $group_id]);
        $currentItem = $this->groupRepository->find($group_id);
        if (!empty($currentItem)) {
            $currentItem->delete(); // xóa đoàn nhưng chưa hủy phòng đã đặt.
            // TODO

            return redirect()->back()->with('success', 'Đã xoá thành công');
        }

        return redirect()->back()->withErrors('Vui lòng thử lại');
    }

    public function filter(Request $request)
    {
        $groups = $this->groupRepository->filter($request);
        return view('groups.list-group-booking', compact('groups'))->render();
    }
}
