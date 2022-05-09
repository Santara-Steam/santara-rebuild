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

        $asset =  User::join('traders as t', 't.user_id', '=', 'users.id')
                            ->leftjoin('transactions as tr', 'tr.trader_id', '=', 't.id')
                            ->where('users.id', Auth::user()->id)
                            ->where('tr.is_deleted', 0)
                            ->where('tr.last_status', 'VERIFIED')
                            ->select(db::raw('SUM(tr.amount) as amo'))
                            ->groupBy('users.id')
                            ->first();
        $uid = Auth::user()->id;
        $client = new \GuzzleHttp\Client();

            $headers = [
                'Authorization' => 'Bearer ' .app('request')->session()->get('token'),
            ];

            $responseToken = $client->request('GET', config('global.BASE_API_ADMIN_URL') . 'v3.7.1/finance-report/list-member-portofolio/?user_id=' . $uid, [
                'headers' => $headers,
            ]);

            if ($responseToken->getStatusCode() == 200) {
                $tokens = json_decode($responseToken->getBody()->getContents(), TRUE);
                // echo json_encode($tokens);
                // return;
                //  return view('user.portofolio.index',compact('port'));
                
            }
            $port = collect($tokens);

                $rtransactions = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->leftJoin('onepay_transaction as ot','ot.transaction_id','=','tr.id')
                ->where('users.id', Auth::user()->id)
                ->where('tr.is_deleted', 0)
                ->where('tr.last_status', 'CREATED')
                ->orwhere('users.id', Auth::user()->id)
                ->where('tr.is_deleted', 0)
                ->where('tr.last_status', 'WAITING FOR VERIFICATION')
                ->select('tr.id','ot.redirect_url','tr.expired_date', 'tr.uuid','e.pictures', 't.name as trader_name', 'users.email as user_email', 
                    't.id as trader_id','e.trademark','e.company_name', 'e.code_emiten', DB::raw('CONCAT("SAN","-", tr.id, "-", e.code_emiten) as transaction_serial'), 
                    'tr.channel', 'tr.description', 'tr.is_verified', 'tr.split_fee', 'tr.created_at as created_at', 
                    'tr.amount', 'tr.fee', 'e.price', DB::raw('(tr.amount/e.price) as qty'), 
                    'tr.last_status as status')
                ->orderBy('tr.id','DESC')
                ->get();
                // dd(count($rtransactions));

        return view('user.index',compact('total_saham','total_lbr','psb','psbv','book','asset','port','rtransactions'));
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
