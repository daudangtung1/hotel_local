<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupCustomer extends Model
{
    use HasFactory;

    protected $table = 'group_customers';
    protected $fillable = [
        'branch_id', 'customer_id', 'group_id'
    ];
}
