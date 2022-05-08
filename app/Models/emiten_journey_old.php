<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emiten_journey_old extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'emiten_journeys';
    protected $guarded = ['id']; 
}
