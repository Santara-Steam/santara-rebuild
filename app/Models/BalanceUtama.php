<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceUtama extends Model
{
    use HasFactory;
    protected $table = "balance_utama";
    protected $connection = 'mysql';
}
