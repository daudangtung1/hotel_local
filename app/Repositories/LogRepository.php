<?php

namespace App\Repositories;

use App\Models\Log;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

/**
 * Class AccountRepository
 *
 * @package App\Repositories
 */
class LogRepository extends ModelRepository
{
    protected $model;
    private static $instance;

    public function __construct(Log $model)
    {
        $this->model = $model;
    }

    public static function instance()
    {
        if(empty(self::$instance)){
            self::$instance = new LogRepository(new Log());
        }
        return self::$instance;
    }

    public function getAll()
    {
        return $this->model->orderBy('ID', 'DESC')->get();
    }

    public function find($request)
    {
        return $this->model->find($request->log_id);
    }

    public function delete($log_id)
    {
        return $this->model->findOrFail($log_id)->delete();
    }

    public function store($subject)
    {
        $log = [];
        $log['subject'] = $subject;
        $log['url'] = Request::fullUrl();
        $log['method'] = Request::method();
        $log['ip'] = Request::ip();
        $log['agent'] = Request::header('user-agent');
        $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
        $this->model::create($log);
    }
}
