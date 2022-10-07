<?php

namespace App\Repositories;

use App\Models\BookingRoom;
use App\Models\Customers;
use App\Models\Groups;
use App\Models\GroupCustomer;
use App\Models\BookingRoomCustomer;
use App\Models\Room;
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


    public function __construct(
        Groups $model,
        Customers $customer,
        BookingRoom $bookingRoom,
        GroupCustomer $groupCustomer,
        BookingRoomCustomer $bookingRoomCustomer
    ) {
        $this->model = $model;
        $this->customer = $customer;
        $this->bookingRoom = $bookingRoom;
        $this->groupCustomer = $groupCustomer;
        $this->bookingRoomCustomer = $bookingRoomCustomer;
    }

    public function getAll($paginate = false, $request = null)
    {
        $query = $this->model->where('branch_id', get_branch_id());

        if ($paginate) {
            $query = $query->paginate(10);
        } else {
            $query = $query->get();
        }

        return $query;
    }

    public function filter($request)
    {
        $query = $this->model->where('branch_id', get_branch_id());
        $name = $request->get('group_name');
        if ($name) {
            $query = $query->where('name', 'LIKE', "%{$name}%");
        }

        return $query->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function getInfoGroupBooking($request)
    {
        return $this->bookingRoom->select('booking_rooms.start_date', 'booking_rooms.end_date', 'customers.name as customer_name', 'customers.phone as customer_phone', 'customers.id as customer_id', 'groups.*')
            ->from('booking_rooms')
            ->join('booking_room_customers', 'booking_rooms.id', '=', 'booking_room_customers.booking_room_id')
            ->join('groups', 'groups.id', '=', 'booking_room_customers.group_id')
            ->join('customers', 'customers.id', '=', 'booking_room_customers.customer_id')
            ->where('booking_rooms.branch_id', get_branch_id())
            ->distinct()
            ->paginate(15);
    }

    public function getBookingInfo($request, $get_all = true)
    {
        if (empty($request->all())) {
            return [];
        }

        $query = $this->bookingRoom->select('booking_rooms.id as bk_room_id', 'booking_rooms.start_date', 'booking_rooms.room_id', 'booking_rooms.end_date', 'customers.address', 'customers.id_card', 'customers.name as customer_name', 'customers.phone as customer_phone', 'customers.id as customer_id', 'groups.*')
            ->from('booking_rooms')
            ->join('booking_room_customers', 'booking_rooms.id', '=', 'booking_room_customers.booking_room_id')
            ->join('groups', 'groups.id', '=', 'booking_room_customers.group_id')
            ->join('customers', 'customers.id', '=', 'booking_room_customers.customer_id')
            ->where('groups.id', $request->group_id)
            ->where('customers.id', $request->customer_id)
            ->where('booking_rooms.start_date', $request->start_date)
            ->where('booking_rooms.end_date', $request->end_date)
            ->where('booking_rooms.branch_id', get_branch_id());

        if ($get_all) {
            return $query->get();
        }

        return $query->first();
    }

    public function cancelBooking($request)
    {
        $groupsBooking = $this->getBookingInfo($request, true);
        $arrRoomId = [];
        foreach ($groupsBooking as $booking) {
            $arrRoomId[] = $booking->room_id;
        }
        try {
            DB::beginTransaction();

            $this->deleteGroupCustomer($request->group_id);
            $this->bookingRoomCustomer->where('branch_id', get_branch_id())->where('group_id', $request->group_id)->delete();

            if (!empty($arrRoomId)) {
                $this->bookingRoom->where('branch_id', get_branch_id())->whereIn('id', $arrRoomId)->delete();
            }

            DB::commit();

            return [
                'code'    => 400,
                'message' => 'Hủy thành công.'
            ];
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return [
                'code'    => 400,
                'message' => 'Hủy thất bại, vui lòng thử lại.'
            ];
        }
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $group = $this->model->where('id', $request->group_id)->update([
                'name' => $request->get('group_name'),
                'note' => $request->get('note')
            ]);

            $customer = $this->customer->where('id', $request->customer_id)->update([
                'name'    => $request->get('customer_name'),
                'id_card' => $request->get('customer_id_card'),
                'phone'   => $request->get('customer_phone'),
                'address' => $request->get('customer_address')
            ]);

            $roomIds = $request->room_ids;

            $bookingRooms = $this->getBookingInfo($request, true);
            if (!empty($bookingRooms)) {
                foreach ($bookingRooms as $bookingRoom) {
                    $this->bookingRoom->where('id', $bookingRoom->bk_room_id)->delete();
                }
            }

            $this->bookingRoom($request);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
    }

    public function bookingRoom($request)
    {
        try {
            $roomIds = $request->room_ids;
            print_r($roomIds);
            DB::beginTransaction();

            $group = $this->model->firstOrCreate([
                'name' => $request->get('group_name'),
                'note' => $request->get('note'),
                'branch_id' => get_branch_id(),
            ]);

            $customer = $this->customer->firstOrCreate([
                'name'    => $request->get('customer_name'),
                'id_card' => $request->get('customer_id_card'),
                'phone'   => $request->get('customer_phone'),
                'address' => $request->get('customer_address'),
                'branch_id' => get_branch_id(),
            ]);

            $groupCustomer = $this->groupCustomer->firstOrCreate([
                'customer_id' => $customer->id,
                'group_id'    => $group->id,
            ]);
            foreach ($roomIds as $roomId) {
                $bookingRoom = $this->bookingRoom->create([
                    'room_id'    => $roomId,
                    'start_date' => $request->get('start_date'),
                    'end_date'   => $request->get('end_date'),
                    'note'       => $request->get('note'),
                    'status'     => Room::BOOKED,
                    'user_id'    => auth()->user()->id,
                    'branch_id' => get_branch_id(),
                ]);

                $bookingRoomCustomer = $this->bookingRoomCustomer->create([
                    'booking_room_id' => $bookingRoom->id,
                    'customer_id'     => $customer->id,
                    'group_id'        => $group->id,
                    'type'            => 2,
                    'branch_id' => get_branch_id(),
                ]);
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return [
                'code'    => 400,
                'message' => 'Dat phong cho khach bi loi'
            ];
        }
    }

    public function deleteGroupCustomer($group_id)
    {
        $this->groupCustomer->where('group_id', $group_id)->delete();
    }
}
