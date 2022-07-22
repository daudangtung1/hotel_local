<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groups extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'groups';
    protected $fillable = ['name', 'note'];

    public function customers()
    {
        return $this->belongsToMany(Customers::class, 'group_customers', 'group_id','customer_id');
    }
}
