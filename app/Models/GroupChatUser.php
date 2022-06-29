<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChatUser extends Model
{
    use HasFactory;
    protected $connection = 'chat';
    protected $table = 'group_users';
    protected $guarded = ['id']; 
}