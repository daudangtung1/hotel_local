<?php

namespace App\Repositories;

use App\Models\Debt;
use App\Models\Room;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Illuminate\Support\Facades\DB as DBTransaction;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class RoomRepository extends ModelRepository
{
    protected $model;
    private static $instance;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new RoomRepository(new Room());
        }

        return self::$instance;
    }

    public function getAll($sortByFloor = true, $paginate = false, $request = null)
    {
        $rooms = $this->model->where('branch_id', get_branch_id());

        if ($request) {
            $typeRoom = $request->get('type_room');
            $orderBy = $request->get('order_by', 'ASC');
            $area = $request->get('area');
            if ($area) {
                $rooms = $rooms->where('floor', $area);
            }

            if (isset($typeRoom)) {
                $rooms = $rooms->where('status', $typeRoom);
            }

            $rooms = $rooms->orderBy('id', $orderBy);
        }

        $rooms = $rooms->orderBy('floor', 'ASC')->whereNotNull('floor');

        if ($paginate) {
            $rooms = $rooms->paginate(10);
        } else {
            $rooms = $rooms->get();
        }

        if (!$sortByFloor) {
            return $rooms;
        }

        $data = [];
        if (!empty($rooms)) {
            $floorData = array_unique($rooms->pluck('floor')->toArray());
            sort($floorData);
            foreach ($floorData as $floor) {
                foreach ($rooms as $room) {
                    if ($floor == $room->floor) {
                        $data[$room->floor][] = $room;
                    }
                }
            }
        }
        return $data;
    }

    public function filterRoomBookingByDate($request, $roomIds = false)
    {
        $startDate = $request->get('start_date') ?? Carbon::now();
        $endDate   = $request->get('end_date') ?? Carbon::now();
        $rooms = $this->model->select('rooms.*')
            ->whereNotIn('id', function ($q) use ($startDate, $endDate, $roomIds) {
                $q->select('room_id')->from(function ($query) use ($startDate, $endDate) {
                    $query->select('room_id')->from('booking_rooms')
                        ->join('rooms', 'rooms.id', '=', 'booking_rooms.room_id')
                        ->where(\DB::raw("'$startDate' BETWEEN booking_rooms.start_date AND booking_rooms.end_date
                                        OR '$endDate' BETWEEN booking_rooms.start_date AND booking_rooms.end_date
                                        OR booking_rooms.start_date BETWEEN '$startDate' AND '$endDate'
                                        OR booking_rooms.end_date BETWEEN '$startDate' AND '$endDate'"));
                });
                if (!empty($roomIds)) {
                    $q->whereNotIn('room_id', $roomIds);
                }
            })
            ->whereNotNull('floor')
            ->where('rooms.branch_id', get_branch_id())
            ->orderBy('rooms.id', 'ASC')
            ->orderBy('floor', 'ASC')
            ->get();
        $data = [];
        if (!empty($rooms)) {
            $floorData = array_unique($rooms->pluck('floor')->toArray());
            sort($floorData);
            foreach ($floorData as $floor) {
                foreach ($rooms as $room) {
                    if ($floor == $room->floor) {
                        $data[$room->floor][] = $room;
                    }
                }
            }
        }

        return $data;
    }

    public function find($request)
    {
        return $this->model->find($request->room_id);
    }

    public function findByTypeRoomId($type_room_id)
    {
        return $this->model->where('type_room_id', $type_room_id)->exists();
    }

    public function changeStatus($request)
    {
        $room = $this->model->find($request->room_id);

        if (!empty($room) && $room->status > 0) {
            try {
                $bookingRoom = $room->bookingRooms()->where('branch_id', get_branch_id())->whereIn('status', [1,3,5])->where('status', '<>', 7)->first();

                if ($room->status == $this->model::HAVE_GUEST) {
                    DBTransaction::beginTransaction();
                    if (empty($request->money_received) && empty($request->money_unpaid)) {
                        return 'Vui lòng nhập số tiền nhận hoặc số tiền nợ.';
                    }

                    if (!empty($request->money_received) && $request->money_received > $bookingRoom->getTotalPrice(true, false)) {
                        return 'Số tiền nhận không được lớn hơn tổng tiền khách phải trả.';
                    }

                    if (
                        !empty($request->money_received) &&
                        !empty($request->money_unpaid) &&
                        ($request->money_received +  $request->money_unpaid) != $bookingRoom->getTotalPrice(true, false)
                    ) {
                        return 'Tổng số tiền nhận và nợ không trùng khớp với số tiền khách phải trả, vui lòng refresh trình duyệt.';
                    }
                    $room->update(['status' => $this->model::DIRTY]);

                    $data = [
                        'status'        => $this->model::DIRTY,
                        'end_date'      => Carbon::now(),
                        'checkout_date' => Carbon::now()
                    ];

                    if (!empty($request->money_received)) {
                        $data['money_received'] = $request->money_received ?? 0;
                    }

                    if (!empty($request->money_unpaid) && $request->money_unpaid > 0) {
                        $data['money_unpaid'] = $request->money_unpaid ?? 0;
                    }

                    $room->bookingRooms()->where('status', $this->model::HAVE_GUEST)->update($data);
                    $bookingRoom = $room->bookingRooms()->where('status', $this->model::DIRTY)->first();
                    if ($bookingRoom) {
                        create_revenue_expenditures('Thanh toán tiền phòng', $bookingRoom->getTotalPrice(false, false), 2);
                    }

                    if (!empty($request->money_unpaid) && $request->money_unpaid > 0 && !empty($bookingRoom)) {
                        $str = '';
                        foreach ($bookingRoom->bookingRoomCustomers()->get() as $bookingRoomCustomer) {
                            $str .= "<p>";
                            $str .= $bookingRoomCustomer->Customer->name . ' - ';
                            $str .= $bookingRoomCustomer->Customer->id_card . ' - ';
                            $str .= $bookingRoomCustomer->Customer->phone . ' - ';
                            $str .= $bookingRoomCustomer->Customer->address;
                            $str .= "</p>";
                        }
                        Debt::create([
                            'name' => $str,
                            'booking_room_id' => $bookingRoom->id,
                            'price' => $request->money_unpaid ?? 0,
                            'status' => 0,
                            'branch_id' => get_branch_id()
                        ]);
                    }
                    DBTransaction::commit();
                } else if (in_array($room->status, [2, 3, 5])) {
                    $room->update(['status' => $this->model::READY]);
                    $room->bookingRooms()->whereIn('status', [2, 3, 5])->update([
                        'status' => $this->model::CLOSED,
                        'end_date'      => Carbon::now()
                    ]);
                } else {
                }
            } catch (\Throwable $e) {
                DBTransaction::rollBack();
                return 'Có lỗi xảy ra, vui lòng thử lại sau!';
            }
        }

        return true;
    }

    public function delete($room_id)
    {
        return $this->model->findOrFail($room_id)->delete();
    }

    public function store($request)
    {
        return $this->model->create([
            'name'         => $request->name,
            'floor'        => $request->floor,
            'type'         => $request->type,
            'month_price'  => $request->month_price ?? 0,
            'day_price'    => $request->day_price ?? 0,
            'hour_price'   => $request->hour_price ?? 0,
            'status'       => $request->status ?? 0,
            'user_id'      => \Auth::user()->id,
            'type_room_id' => $request->type ?? null,
            'branch_id' => get_branch_id(),
        ]);
    }

    public function update($request)
    {
        $data = [
            'name'         => $request->name ?? '',
            'floor'        => $request->floor ?? '',
            'type'         => $request->type ?? 0,
            'month_price'  => $request->month_price ?? 0,
            'day_price'    => $request->day_price ?? 0,
            'hour_price'   => $request->hour_price ?? 0,
            'type_room_id' => $request->type ?? null,

        ];

        if ($request->status != '') {
            $data['status'] = $request->status ?? 0;
            $data['status_desc'] = $request->status_desc ?? null;
        }

        return $this->model->where('id', $request->room_id)->update($data);
    }

    public function all()
    {
        return $this->model->where('branch_id', get_branch_id())->get();
    }
}
