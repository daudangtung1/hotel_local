<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupCustomer extends Model
{
    use HasFactory;

    protected $table = 'group_customers';
    protected $fillable = ['customer_id', 'group_id'];
}