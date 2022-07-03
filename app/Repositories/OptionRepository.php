<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\Option;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class OptionRepository
 *
 * @package App\Repositories
 */
class OptionRepository extends ModelRepository
{
    protected $model;
    protected $room;
    private static $instance;

    public function __construct(Option $model, Room $room)
    {
        $this->model = $model;
        $this->room = $room;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function find()
    {
        return $this->model->first();
    }

    public function update($request)
    {
       $this->model->updateOrCreate([
           'id' => 1,
       ], [
           'name' => $request->name ?? '',
           'address' => $request->address ?? '',
           'phone' => $request->phone ?? '',
           'email' => $request->email ?? '',
           'fax' => $request->fax ?? '',
       ]);
    }
}
