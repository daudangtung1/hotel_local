<?php

namespace App\Repositories;

use App\Models\Debt;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class DebtRepository
 *
 * @package App\Repositories
 */
class DebtRepository extends ModelRepository
{
    protected $model;
    protected $room;

    public function __construct(Debt $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->where('branch_id', get_branch_id())->orderBy('ID', 'DESC')->paginate(10);
    }

    public function find($request)
    {
        return $this->model->find($request->user_id);
    }

    public function delete($user_id)
    {
        return $this->model->findOrFail($user_id)->delete();
    }

    public function store($request)
    {
        return $this->model->create([
            'note'            => $request->note ?? '',
            'user_id'         => Auth::user()->id,
            'booking_room_id' => $request->booking_room_id,
            'pay_date'        => null,
            'branch_id'         => get_branch_id(),
        ]);
    }

    public function updateStatus($request, $id)
    {
        $debtItem = $this->model->find($id);

        if (empty($debtItem->status)) {
            $data = [
                'updated_at' => Carbon::now(),
                'status' => 1,
            ];
        }

        $this->model->where('id', $id)->update($data);
    }
}
