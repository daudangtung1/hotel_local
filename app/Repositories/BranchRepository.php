<?php

namespace App\Repositories;

use App\Models\Log;
use App\Models\Branch;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class BranchRepository extends ModelRepository
{
    protected $model;
    protected $room;
    private static $instance;

    public function __construct(Branch $model)
    {
        $this->model = $model;
    }

    public static function instance()
    {
        if (empty(self::$instance)) {
            self::$instance = app(BranchRepository::class);
        }
        return self::$instance;
    }

    public function getAll()
    {
        return $this->model->orderBy('ID', 'DESC')->paginate(10);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function store($request)
    {
        return $this->model->create([
            'name'    => $request->name ?? '',
            'note'   => $request->note ?? '',
        ]);
    }

    public function filter($request, $paginate = true)
    {
        $data = $this->model->where('name', 'LIKE', '%' . $request->s . '%');
        if (!empty($request->start_date)) {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_date . ' 00:00:00');
            $data->where('created_at', '>', $startDate);
        }

        if (!empty($request->end_date)) {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $request->end_date . ' 00:00:00');
            $data->where('created_at', '<', $endDate);
        }
          
        if ($request->type != '') {
            $data->where('type', $request->type);
        }

        if ($paginate) {
            $data = $data->paginate(10);
        } else {
            $data = $data->get();
        }

        return $data;
    }

    public function update($id, $request)
    {
        return $this->model->where('id', $id)->update([
            'name'  => $request->name ?? '',
            'note' => $request->note ?? '',
        ]);
    }
}
