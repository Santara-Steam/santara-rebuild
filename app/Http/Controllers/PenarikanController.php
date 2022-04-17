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
        $trader_bank = db::table('trader_banks')->where('trader_id',Auth::user()->trader->id)->first();
        $bwd = db::table('bank_withdraws')->select('*')->where('is_deleted',0)->get();

        return view('user.penarikan.index',compact('wd','trader_bank','bwd'));
        // dd($trader_bank);
    }
    
}
