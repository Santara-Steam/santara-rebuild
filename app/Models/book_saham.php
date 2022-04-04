<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_saham extends Model
{
    use HasFactory;
    protected $connection = 'mysql';

    // public function trader(){
    //     return $this->belongsTo(trader::class);
    // }
    // public function trd(){
    // 	return $this->belongsToMany(trader::class,'book_sahams', 'id', 'trader_id');
    // }
    public function trd()
    {
        return $this->belongsTo(trader::class,"trader_id")->withDefault();
    }
    public function emtn()
    {
        return $this->belongsTo(emiten::class,"emiten_id")->withDefault();
    }
}
