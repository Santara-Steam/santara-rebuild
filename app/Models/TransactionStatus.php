<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = "transaction_statuses";
    protected $fillable = [
        'status',
        'created_at',
        'updated_at',
        'is_deleted',
        'created_by',
        'updated_by',
        'transaction_id'
    ];
}
