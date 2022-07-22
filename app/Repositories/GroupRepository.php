<?php

namespace App\Repositories;

use App\Models\BookingRoom;
use App\Models\Customers;
use App\Models\Groups;
use App\Models\GroupCustomer;
use App\Models\BookingRoomCustomer;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */

 class GroupRepository extends ModelRepository 
 {
    protected $model;
    protected $customer;
    protected $bookingRoom;
    protected $groupCustomer;
    protected $bookingRoomCustomer;


    public function __construct(Groups $model, Customers $customer, BookingRoom $bookingRoom, GroupCustomer $groupCustomer, BookingRoomCustomer $bookingRoomCustomer)
    {
        $this->model = $model;
        $this->customer = $customer;
        $this->bookingRoom = $bookingRoom;
        $this->groupCustomer = $groupCustomer;
        $this->bookingRoomCustomer = $bookingRoomCustomer;
    }

    public function getAll($request = null)
    {
        return $this->model->get();
    }

    public function filter($request)
    {
        $query = $this->model;
        $name = $request->get('group_name');
        if ($name) {
            $query = $query->where('name', 'LIKE', "%{$name}%");
        }

        return $query->get();
    }

    public function find($id)
    {
        // return $this->model->select('customers.*', 'groups.name as group_name', 'groups.note as group_note')
        //                     ->join('group_customers', 'groups.id', '=', 'group_customers.group_id') 
        //                     ->join('customers', 'customers.id', '=', 'group_customers.customer_id')
        //                     ->find($id);

        return $this->model->find($id);
    }

    public function bookingRoom($request) 
    {
        try {
            $roomIds = $request->room_ids;
            print_r($roomIds);
            DB::beginTransaction();

            $group = $this->model->firstOrCreate([
                'name' => $request->get('group_name'),
                'note' => $request->get('note')
            ]);

            $customer = $this->customer->firstOrCreate([
                'name' => $request->get('customer_name'),
                'id_card' => $request->get('customer_id_card'),
                'phone' => $request->get('customer_phone'),
                'address' => $request->get('customer_address')
            ]);

            $groupCustomer = $this->groupCustomer->firstOrCreate([
                'customer_id' => $customer->id,
                'group_id' => $group->id
            ]);
            
            foreach ($roomIds as $roomId) {
                $bookingRoom = $this->bookingRoom->create([
                    'room_id' => $roomId,
                    'start_date' => $request->get('start_date'),
                    'end_date' => $request->get('end_date'),
                    'note' => $request->get('note'),
                    'status' => 6,
                    'user_id' => auth()->user()->id
                ]);

                $bookingRoomCustomer = $this->bookingRoomCustomer->create([
                    'booking_room_id' => $bookingRoom->id,
                    'customer_id' => $customer->id,
                    'group_id' => $group->id,
                    'type' => 2 // khach doan
                ]);
            }

            DB::commit();

        } catch (Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return [
                'code' => 400,
                'message' => 'Dat phong cho khach bi loi'
            ];
        }
    }
 }