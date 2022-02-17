<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function index() 
    { 
        $files = FileModel::orderBy('created_at','DESC')->paginate(30);
    } 
}
