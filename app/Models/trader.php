<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trader extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'traders';
    protected $guarded = ['id']; 
    


}
