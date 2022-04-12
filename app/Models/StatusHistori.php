<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusHistori extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = "status_histories";
    protected $fillable = [
        'uuid',
        'transaction_id',
        'status_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'is_deleted',
    ];
}
