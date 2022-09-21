<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Action extends Model
{
    use SoftDeletes;
    protected $fillable = [
      'user_id',
      'step',
      'data',
    ];
}
