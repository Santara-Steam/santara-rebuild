<?php

namespace App\Http\Controllers;

use App\Models\book_saham;
use App\Models\emiten;
use App\Models\User;
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
        $total_penerbit = emiten::where('is_deleted',0)
        ->count();
        $total_user = User::where('is_verified',1)
        ->where('role_id',2)
        ->count();
        $book_verif = book_saham::where('isValid',0)
        ->where('bukti_tranfer','!=','-')
        ->count();
        $book_vverif = book_saham::where('isValid',0)
        ->where('bukti_tranfer','!=','-')
        ->get();
        $book_valid = book_saham::where('isValid',1)
        ->count();
        $book_lbr = book_saham::select(db::raw('sum(lembar_saham) as lbr'))
        ->where('isValid',1)->first();
        $book_rp= book_saham::select(db::raw('sum(total_amount) as rp'))
        ->where('isValid',1)->first();
        return view('admin.index',compact('total_penerbit','total_user','book_verif','book_vverif','book_valid','book_lbr','book_rp'));
    }
}
