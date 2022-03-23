<?php

namespace App\Http\Controllers;

use App\Models\book_saham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function indexuser()
    {
        $total_saham = book_saham::where('trader_id',Auth::user()->trader->id)
        ->where('isValid',1)
        ->select(DB::raw('COALESCE(SUM(total_amount),0) as ta'))->first();

        $total_lbr = book_saham::where('trader_id',Auth::user()->trader->id)
        ->where('isValid',1)
        ->select(DB::raw('COALESCE(SUM(lembar_saham),0) as ls'))->first();

        $psb = book_saham::where('trader_id',Auth::user()->trader->id)
        ->where('isValid',0)
        ->where('bukti_tranfer','-')
        ->count();
        $psbv = book_saham::where('trader_id',Auth::user()->trader->id)
        ->where('isValid',1)
        ->count();

        $book = book_saham::where('trader_id',Auth::user()->trader->id)
        ->where('isValid',0)
        ->where('bukti_tranfer','-')
        ->get();

        return view('user.index',compact('total_saham','total_lbr','psb','psbv','book'));
    }
    public function indexadmin()
    {
        return view('admin.index');
    }
}
