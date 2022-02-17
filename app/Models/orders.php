<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_email',
        'order_date',
        'order_items',
        'order_total',
        'address',
        'receive_date',
        'order_status',
    ];
}
