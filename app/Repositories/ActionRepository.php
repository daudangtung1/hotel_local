<?php

namespace App\Repositories;

use App\Models\Action;
use App\Models\BookingRoom;
use App\Models\BookingRoomCustomer;
use App\Models\BookingRoomService;
use App\Models\Customers;
use App\Models\Groups;
use App\Models\RevenueAndExpenditure;
use App\Models\Room;
use App\Models\Service;
use Carbon\Carbon;
use DB;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class ActionRepository extends ModelRepository
{
    protected $action;
    protected $revenueAndExpenditure;

    private static $instance;

    public function __construct(Action $action, RevenueAndExpenditure $revenueAndExpenditure)
    {
        $this->action = $action;
        $this->revenueAndExpenditure = $revenueAndExpenditure;
    }

    public function getAll($id = null)
    {
        $data = $this->revenueAndExpenditure->orderBy('ID', 'DESC');

        if ($id) {
            $data = $data->where('user_id', $id);
        }

        return $data->paginate(10);
    }

    public function find($id)
    {
        return $this->bookingRoom->find($id);
    }
}
