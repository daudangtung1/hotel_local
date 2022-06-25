<?php

namespace App\Repositories;

use App\Models\BookingRoomCustomer;
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
class BookingRoomCustomerRepository extends ModelRepository
{
    protected $model;
    private static $instance;

    public function __construct(BookingRoomCustomer $model)
    {
        $this->model = $model;
    }

    public function delete($booking_room_customer_id)
    {
        return $this->model->findOrFail($booking_room_customer_id)->delete();
    }
}
