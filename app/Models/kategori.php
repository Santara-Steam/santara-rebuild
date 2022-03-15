<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'categories';
    protected $guarded = ['id']; 
}
