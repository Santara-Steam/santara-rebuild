<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    //
    public function user_depo()
    {
        return view('user.deposit.index');
    }
}
