<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\LostItem;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class LostItemRepository extends ModelRepository
{
    protected $model;
    protected $room;
    private static $instance;

    public function __construct(LostItem $model, Room $room)
    {
        $this->model = $model;
        $this->room = $room;
    }

    public function getAll()
    {
        return $this->model->orderBy('ID', 'DESC')->paginate(10);
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
            'pay_date'        => null
        ]);
    }

    public function updateStatus($request, $id)
    {
        $lostItem = $this->model->find($id);

        if(empty($lostItem->pay_date)) {
            if ($request->status == 1) {
                $data = [
                    'pay_date' => Carbon::now()
                ];
            } else if ($request->status == 0) {
                $data = [
                    'pay_date' => null
                ];
            }
        }

        if (!empty($request->note)) {
            $data['note'] = $request->note ?? '';
        }

        $this->model->where('id', $id)->update($data);
    }
}
