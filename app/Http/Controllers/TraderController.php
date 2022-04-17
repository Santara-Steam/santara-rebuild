<?php

namespace App\Http\Controllers;

use App\Models\notification;
use App\Models\riwayat_user;
use App\Models\trader;
use App\Models\User;
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
        $port = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->leftjoin('categories as c','c.id','=','e.category_id')
                ->where('users.id', $uid)
                ->where('tr.is_deleted', 0)
                ->where('tr.last_status', 'VERIFIED')
                ->select('c.category as cat','e.company_name','e.trademark',db::raw('MAX(tr.created_at) as cr'),db::raw('SUM(tr.amount/e.price) as lembar'),db::raw('SUM(tr.amount) as tot'))
                ->groupBy('e.id')
                ->get();
        return view('user.portofolio.index',compact('port'));
    }

    public function history(){
        $jour = riwayat_user::where('trader_id',Auth::user()->trader->id)->get();
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
            return redirect()->back()->with($notif);
        }
    }

    public function read_message(){

        $notif = notification::where('user_id',Auth::user()->id)->update(['is_deleted' => 1]);

        return redirect()->back();
    }

    public function add_bank(request $request){
        // echo $request->bank;
        $client = new Client();
                    $res = $client->request('POST', env("BASE_API_CLIENT_URL")  . '/v3.7.1/withdraw/insert-new-bankwd', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
                        ],
                        'form_params' => [
                            "bank_wd_id" => $request->bank,
                            "account_currency_bwd" => "IDR",
                            "account_number_bwd" => $request->norek
                        ]
                    ]);

                    echo $res->getBody()->getContents();
    }
}
