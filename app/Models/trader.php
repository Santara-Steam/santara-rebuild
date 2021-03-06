<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trader extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'traders';
    protected $guarded = ['id']; 
    

    public function usr()
    {
        return $this->belongsTo(user::class,'user_id')->withDefault();
    }
    public function saldo()
    {
        return $this->hasOne(saldo::class,'trader_id');
    }
}
