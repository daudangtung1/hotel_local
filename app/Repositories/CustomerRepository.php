<?php

namespace App\Repositories;

use App\Models\Customers;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use DB;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class CustomerRepository extends ModelRepository
{
    protected $model;
    private static $instance;

    public function __construct(Customers $model)
    {
        $this->model = $model;
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new CustomerRepository(new Customers());
        }

        return self::$instance;
    }

    public function getAll()
    {
        return $this->model->orderBy('ID', 'DESC')->paginate(10);
    }

    public function find($request)
    {
        return $this->model->find($request->customer_id);
    }

    public function delete($customer_id)
    {
        return $this->model->findOrFail($customer_id)->delete();
    }

    public function store($request)
    {
        $card = $this->model->where('id_card', $request->id_card)->exists();

        if ($card) {
            return [
                'status'  => false,
                'message' => 'CMND/HC đã tồn tại'
            ];
        }

        $phone = $this->model->where('phone', $request->phone)->exists();

        if ($phone) {
            return [
                'status'  => false,
                'message' => 'Số điện thoại đã tồn tại'
            ];
        }

        $data = [
            'name'    => $request->name ?? '',
            'id_card' => $request->id_card ?? '',
            'phone'   => $request->phone ?? '',
            'address' => $request->address ?? '',
        ];

        return $this->model->create($data);
    }

    public function update($request)
    {
        $card = $this->model->where('id_card', $request->id_card)
            ->where('id', '!=', $request->customer_id)->exists();

        if ($card) {
            return [
                'status'  => false,
                'message' => 'CMND/HC đã tồn tại'
            ];
        }

        $phone = $this->model->where('phone', $request->phone)
            ->where('id', '!=', $request->customer_id)->exists();

        if ($phone) {
            return [
                'status'  => false,
                'message' => 'Số điện thoại đã tồn tại'
            ];
        }

        $data = [
            'name'    => $request->name ?? '',
            'id_card' => $request->id_card ?? '',
            'phone'   => $request->phone ?? '',
            'address' => $request->address ?? '',
        ];

        return $this->model->where('id', $request->customer_id)->update($data);
    }

    public function filter($request)
    {
        $query = $this->model;
        if (!empty($request->name)) {
            $query = $query->where('name', 'LIKE', "%{$request->name}%");
        }

        if (!empty($request->id_card)) {
            $query = $query->where('id_card', 'LIKE', "%{$request->id_card}%");
        }

        return $query->orderBy('id','DESC')->paginate(10);
    }

    public function searchByCustomerName($name, $type = 'name') 
    {
        if (empty($name)) return [];
    
        return $this->model->where($type, 'LIKE', "%{$name}%")->orderBy('id','DESC')->get();
    }
}
