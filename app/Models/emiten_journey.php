<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emiten_journey extends Model
{
    use HasFactory;
    protected $table = 'emiten_journeys';
    protected $guarded = ['id']; 
}
