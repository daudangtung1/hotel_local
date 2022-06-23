<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\Service;
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

    public function getAll()
    {
        return $this->model->orderBy('ID', 'ASC')->get();
    }

    public function find($request)
    {
        return $this->model->find($request->service_id);
    }

    public function store($request)
    {
        return $this->model->create([
            'name'    => $request->name,
            'stock'   => $request->stock,
            'price'   => $request->price,
            'type'    => $request->type,
            'user_id' => \Auth::user()->id
        ]);
    }
}
