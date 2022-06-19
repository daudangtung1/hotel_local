<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = ['name', 'id_card', 'phone', 'address', 'created_at', 'updated_at'];

}
