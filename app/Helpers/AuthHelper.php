<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthHelper
{
    public static function getUserIdentitiesByGroup($collection): array
    {
        return array_values($collection->map(function ($item){
            return $item[0]->trader_id;
        })->toArray());
    }

    public static function getEmail()
    {
        return Auth::user()->email;
    }
    public static function getPassword()
    {
        return Session::get('pwd');
    }

}
