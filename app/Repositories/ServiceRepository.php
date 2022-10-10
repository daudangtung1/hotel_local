<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\Service;
use Carbon\Carbon;
use DB;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class ServiceRepository extends ModelRepository
{
    protected $model;
    private static $instance;

    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new ServiceRepository(new Service());
        }

        return self::$instance;
    }

    public function getAll($in_stock = false)
    {
        $services = $this->model->where('branch_id', get_branch_id())->orderBy('ID', 'DESC');
        if (!$in_stock) {
            $services = $services->where('stock', '>', 0);
        }
        return $services->paginate(10);
    }

    public function find($request)
    {
        return $this->model->find($request->service_id);
    }

    public function store($request)
    {
        $id = $request->get('id');

        if (!empty($id)) {
            $model = $this->model->find($id);
            $params = [
                'stock' => $model->stock + $request->get('stock'),
                'price' => $request->get('price')
            ];

            return $model->update($params);
        }

        return $this->model->create([
            'name'    => $request->name ?? '',
            'stock'   => $request->stock ?? 1,
            'price'   => $request->price ?? 0,
            'type'    => $request->type ?? 0,
            'sale_type'    => $request->sale_type,
            'user_id' => \Auth::user()->id,
            'branch_id' => get_branch_id(),
        ]);
    }

    public function filter($request)
    {
        $query = $this->model->where('branch_id', get_branch_id());
        if (!empty($request->start_date)) {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_date . ' 00:00:00');
            $query = $query->whereDate('created_at', '>=', $startDate);
        }

        if (!empty($request->end_date)) {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $request->end_date . ' 00:00:00');
            $query = $query->whereDate('created_at', '<=', $endDate);
        }

        return $query->orderBy('id', 'DESC')->paginate(10);
    }
}
