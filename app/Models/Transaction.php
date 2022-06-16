<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = "transactions";

    public function emiten()
    {
        return $this->belongsTo(emiten::class);
    }

    public function trader()
    {
        return $this->belongsTo(trader::class);
    }
}
