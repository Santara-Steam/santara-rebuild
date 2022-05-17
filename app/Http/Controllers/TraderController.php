<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\notification;
use App\Models\riwayat_user;
use App\Models\trader;
use App\Models\User;
use App\Models\Withdraw;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;



class TraderController extends Controller
{
    //
    public function edit_profile($id){
        $user = User::where('id',$id)->first();
        return view('user.profile.edit',compact('user'));
    }
    public function update_profile(request $request,user $user,$id){
        $user = User::where('id',$id)->first();
        if($request->profile == null){
            $profile = 'default1.png';
        }else{
            $profile = str_replace('public/storage/pictures/','',$request->profile);
        }
        $trader = trader::where('user_id',$id)->first();
        $trader->name = $request->name;
        $trader->photo = $profile;
        $trader->save();
        $notif = array(
            'message' => 'Edit Profile Berhasil!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notif);
    }

    public function portofolio(){
        $uid = Auth::user()->id;
        // $port = User::join('traders as t', 't.user_id', '=', 'users.id')
        //         ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
        //         ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
        //         ->leftjoin('categories as c','c.id','=','e.category_id')
        //         ->where('users.id', $uid)
        //         ->where('tr.is_deleted', 0)
        //         ->where('tr.last_status', 'VERIFIED')
        //         ->select('c.category as cat','e.code_emiten','e.company_name','e.trademark',db::raw('MAX(tr.created_at) as cr'),db::raw('SUM(tr.amount/e.price) as lembar'),db::raw('SUM(tr.amount) as tot'))
        //         ->groupBy('e.id')
        //         ->get();
        // return view('user.portofolio.index',compact('port'));
        $client = new \GuzzleHttp\Client();

            $headers = [
                'Authorization' => 'Bearer ' .app('request')->session()->get('token'),
            ];

            $responseToken = $client->request('GET', config('global.BASE_API_ADMIN_URL'). '/v3.7.1/finance-report/list-member-portofolio/?user_id=' . $uid, [
                'headers' => $headers,
            ]);

            if ($responseToken->getStatusCode() == 200) {
                $tokens = json_decode($responseToken->getBody()->getContents(), TRUE);
                // echo json_encode($tokens);
                // return;
                $port = collect($tokens);
                 return view('user.portofolio.index',compact('port'));
                
            }
    }

    public function history(){
        $jour = riwayat_user::where('trader_id',Auth::user()->trader->id)
        ->orderBy('id','DESC')
        ->get();
        // dd($jour);
        return view('user.riwayat_user.index',compact('jour'));
    }

    public function video(){
        
    
        // if (session('search_query')) {
        //     $videoLists = $this->_videoLists(session(['search_query' => '']));
        // } else {
            $videoLists = $this->_videoLists(session(['search_query' => '']));
        // }
        return view('user.video.index', compact('videoLists'));
        // dd($videoLists);
        // return view('index', compact('videoLists'));
    }

    public function results(Request $request)
    {
        session(['search_query' => $request->search_query]);
        $videoLists = $this->_videoLists($request->search_query);
        return view('user.video.index', compact('videoLists'));
    }

    public function watch($id)
    {
        $singleVideo = $this->_singleVideo($id);
        if (session('search_query')) {
            $videoLists = $this->_videoLists(session('search_query'));
        } else {
            $videoLists = $this->_videoLists(session(['search_query' => '']));
        }
        return view('user.video.watch', compact('singleVideo', 'videoLists'));
    }

    // We will get search result here
    protected function _videoLists($keywords)
    {
        $part = 'snippet';
        $country = 'ID';
        $channelId = 'UCUW2hstBsaIbZFIi3ea4DTQ';
        $apiKey = config('services.youtube.api_key');
        $maxResults = 12;
        $youTubeEndPoint = config('services.youtube.search_endpoint');
        $type = 'video'; // You can select any one or all, we are getting only videos

        $url = "$youTubeEndPoint?part=$part&channelId=$channelId&maxResults=$maxResults&regionCode=$country&type=$type&key=$apiKey&q=$keywords";
        $response = Http::get($url);
        $results = json_decode($response);

        // We will create a json file to see our response
        File::put(storage_path() . '/app/public/results.json', $response->body());
        return $results;
    }

    protected function _singleVideo($id)
    {
        $apiKey = config('services.youtube.api_key');
        $part = 'snippet';
        $url = "https://www.googleapis.com/youtube/v3/videos?part=$part&id=$id&key=$apiKey";
        $response = Http::get($url);
        $results = json_decode($response);

        // Will create a json file to see our single video details
        File::put(storage_path() . '/app/public/single.json', $response->body());
        return $results;
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'pin' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }
    public function pinv(){
        return view('user.pin');
    }

    public function pin(request $request){
        if ($request->pin != $request->cpin) {
            # code...
            $notif = array(
                'message' => 'Pin Konfirmasi Tidak Sama',
                'alert-type' => 'fail'
            );
            return redirect()->back()->with($notif);
        }else{

            $user = User::where('id',$request->userid)->first();
            $user->pin = Hash::make($request->pin);
            $user->save();
            $notif = array(
                'message' => 'Pin Berhasil Di buat',
                'alert-type' => 'success'
            );
            return redirect()->to('/user')->with($notif);
        }
    }
    public function pin_reset(){
        return view('user.pin_reset');
    }

    public function pin_reset_post(request $request){
        if ($request->pin != $request->cpin) {
            # code...
            $notif = array(
                'message' => 'Pin Konfirmasi Tidak Sama',
                'alert-type' => 'fail'
            );
            return redirect()->back()->with($notif);
        }else{

            $user = User::where('id',$request->userid)->first();
            $user->pin = Hash::make($request->pin);
            $user->save();
            $notif = array(
                'message' => 'Pin Berhasil Di buat',
                'alert-type' => 'success'
            );
            return redirect()->to('/user')->with($notif);
        }
    }

    public function read_message(){

        $notif = notification::where('user_id',Auth::user()->id)->update(['is_deleted' => 1]);

        return redirect()->back();
    }

    public function add_bank(request $request){
        // echo $request->bank;
        $client = new Client();
                    $res = $client->request('POST', config('global.BASE_API_CLIENT_URL')  . '/v3.7.1/withdraw/insert-new-bankwd', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
                        ],
                        'form_params' => [
                            "bank_code" => $request->bank,
                            "account_number" => $request->norek,
                            "account_name" =>Auth::user()->trader->name
                        ]
                    ]);

                    echo $res->getBody()->getContents();
    }

    public function pin_check(Request $request){
        $pin = Auth::user()->pin;
        if (Hash::check($request->pin, $pin) == true) {
            dd('ok');
        }else{
            dd('salah');
        }
    }

    public function user_wallet(Request $request){
        $deposit = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
            ->join('users as u', 'u.id', '=', 't.user_id')
            ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
            ->leftJoin('onepay_transaction as ot','ot.deposit_id','=','deposits.id')
            ->where('deposits.trader_id',Auth::user()->trader->id)
            ->select('deposits.id','ot.redirect_url', 'deposits.uuid', 'deposits.amount', 'deposits.fee', 
                'u.email', 'deposits.confirmation_photo', 'deposits.split_fee',
                'deposits.bank_to', 'deposits.bank_from', 'deposits.channel', 'deposits.account_number', 
                'deposits.status', 'deposits.created_at', 'deposits.updated_at', 't.name as trader_name', 
                'deposits.created_by', 'va.account_number as va_account_number', 'va.bank as va_bank')
            ->orderBy('deposits.created_at','DESC')
            ->get();
            $wd = Withdraw::where('trader_id',Auth::user()->trader->id)
            ->orderBy('id','DESC')
            ->get();
            $trader_bank = DB::table('trader_banks')
            ->select('trader_banks.*','bank_withdraws.bank','bank_withdraws.bank_code')
            ->join('bank_withdraws','bank_withdraws.id','=','trader_banks.bank_wd_id')
            ->where('trader_id',Auth::user()->trader->id)->first();
            $bwd = db::table('bank_withdraws')->select('*')->where('is_deleted',0)->get();

            if (!empty($request->start) && !empty($request->end) ) {
                # code...
                $se = db::select(db::raw("SELECT deposits.created_at,'DEPOSIT',deposits.amount,onepay_transaction.redirect_url,deposits.`status` from deposits 
                LEFT JOIN onepay_transaction on onepay_transaction.deposit_id = deposits.id
                where deposits.trader_id = ".Auth::user()->trader->id."
                and DATE(deposits.created_at) BETWEEN '".$request->start."' AND '".$request->end."'
                and deposits.created_at >= last_day(now()) + interval 1 day - interval 3 month
                UNION ALL
                SELECT created_at,'WITHDRAW',amount,'-',is_verified from withdraws where trader_id = ".Auth::user()->trader->id."
                and DATE(created_at) BETWEEN '".$request->start."' AND '".$request->end."'
                and created_at >= last_day(now()) + interval 1 day - interval 3 month
                ORDER BY created_at DESC"));
            }else{
                $se = db::select(db::raw("SELECT deposits.created_at,'DEPOSIT',deposits.amount,onepay_transaction.redirect_url,deposits.`status` from deposits 
                LEFT JOIN onepay_transaction on onepay_transaction.deposit_id = deposits.id
                where deposits.trader_id = ".Auth::user()->trader->id."
                and deposits.created_at >= last_day(now()) + interval 1 day - interval 3 month
                UNION ALL
                SELECT created_at,'WITHDRAW',amount,'-',is_verified from withdraws where trader_id = ".Auth::user()->trader->id."
                and created_at >= last_day(now()) + interval 1 day - interval 3 month
                ORDER BY created_at DESC"));
            }


            // dd($request->start);

            // dd($se);

        return view('user.wallet.index',compact('deposit','wd','trader_bank','bwd','se'));
    }

    public function user_deviden(){
        return view('user.deviden.index');
    }

    public function email_verify($uuid){
        // echo $uuid;
        $user = user::where('uuid',$uuid)->first();
        $user->is_verified = 1;
        $user->save();
        // dd($user);
        $notif = array(
            'message' => 'Verifikasi E-mail Berhasil!! Silahkan Login',
            'alert-type' => 'success'
        );
        return redirect()->route('login')->with($notif);
    }

    public function secmar(){
        $secmar = json_decode(app('request')->session()->get('secondary_market'),TRUE);
        return view('user.secmar',compact('secmar'));
        // $sec = collect($sec);
        // echo $secmar;
        // dd($secmar);
    }

    public function mobile_reset($token){
        
        return view('auth.passwords.email',compact('token'));
    }
}
