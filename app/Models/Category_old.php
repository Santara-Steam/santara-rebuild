<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_old extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'category';
    public function ctg()
    {
        return $this->belongsTo(kategori::class,"category_id")->withDefault();
    }
}
