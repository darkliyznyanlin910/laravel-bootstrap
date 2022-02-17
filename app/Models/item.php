<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'item_name',
        'state',
        'discount',
        'category',
        'price',
        'img',
        'stock',
        'sale',
        'visit',
    ];
}
