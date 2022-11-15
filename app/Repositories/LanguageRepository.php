<?php

namespace App\Repositories;

use App\Models\Log;
use App\Models\Language;
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
class LanguageRepository extends ModelRepository
{
    protected $model;
    protected $room;
    private static $instance;

    public function __construct(Language $model)
    {
        $this->model = $model;
    }

    public static function instance()
    {
        if (empty(self::$instance)) {
            self::$instance = app(LanguageRepository::class);
        }
        return self::$instance;
    }

    public function getAll($request = null, $paginate = true)
    {
        $data = $this->model->orderBy('ID', 'DESC');
        if ($request) {
            $data = $data->where('vi', 'LIKE', '%' . $request->s . '%');
            $data = $data->orWhere('en', 'LIKE', '%' . $request->s . '%');
        }
        if($paginate) {
            return $data->paginate(30);
        }
        
        return $data->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, $request)
    {
        return $this->model->where('id', $id)->update([
            'vi'  => $request->vi ?? '',
            'en' => $request->en ?? '',
        ]);
    }
}
