<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class PenarikanController extends Controller
{
    //
    public function user_tarik()
    {
        return view('user.penarikan.index');
    }
}
