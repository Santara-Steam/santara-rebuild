<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class PenarikanController extends Controller
{
    //
    public function user_tarik()
    {
        $wd = Withdraw::where('trader_id',Auth::user()->trader->id)->get();

        return view('user.penarikan.index',compact('wd'));
    }
    
}
