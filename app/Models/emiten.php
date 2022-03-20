<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emiten extends Model
{
    use HasFactory;
    protected $hidden = ['uuid'];
    protected $guarded = ['id','uuid']; 
    protected $connection = 'mysql';
    public function ctg()
    {
        return $this->belongsTo(kategori::class,"category_id")->withDefault();
    }
    public function tr()
    {
        return $this->belongsTo(trader::class,'trader_id')->withDefault();
    }
}
