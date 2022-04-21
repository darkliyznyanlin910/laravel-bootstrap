<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'sku',
        'item_name',
        'state',
        'discount',
        'discount_setting',
        'start_date',
        'end_date',
        'category',
        'price',
        'img',
        'stock',
        'sale',
        'visit',
    ];
}
