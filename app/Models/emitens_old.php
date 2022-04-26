<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emitens_old extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'emitens';
    public function ctg()
    {
        return $this->belongsTo(kategori_old::class,"category_id")->withDefault();
    }
}
