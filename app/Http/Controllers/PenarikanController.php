<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;

class PenarikanController extends Controller
{
    //
    public function user_tarik()
    {
        $wd = Withdraw::where('trader_id',Auth::user()->trader->id)->get();
        $trader_bank = db::table('trader_banks')
        ->select('trader_banks.*','bank_withdraws.bank','bank_withdraws.bank_code')
        ->join('bank_withdraws','bank_withdraws.id','=','trader_banks.bank_wd_id')
        ->where('trader_id',Auth::user()->trader->id)->first();
        $bwd = db::table('bank_withdraws')->select('*')->where('is_deleted',0)->get();

        return view('user.penarikan.index',compact('wd','trader_bank','bwd'));
        // dd($trader_bank);
    }

    public function create(Request $request){
        $pin = Auth::user()->pin;
        if (Hash::check($request->pin, $pin) == true) {
                                        $client = new Client();
                                        $response = $client->request('POST', env("BASE_API_CLIENT_URL") . '/v3.7.1/withdraw/', [
                                            'headers' => [
                                                'Authorization' => 'Bearer ' .  app('request')->session()->get('token')
                                            ],
                                            'form_params' => [
                                                'amount'         => $request->amou,
                                                // 'account_name'   => strip_tags($data['account_name']),
                                                // 'account_number' => strip_tags($data['account_number']),
                                                // 'bank_to'        => strip_tags($data['bank_to']),
                                                'pin'            => $request->pin,
                                                'finger'         => false
                                            ]
                                        ]);

                                        // echo json_encode(['msg' => $response->getStatusCode()]);
                                        $notif = array(
                                            'message' => 'Request withdraw dalam proses',
                                            'alert-type' => 'success'
                                        );
                                        return redirect()->back()->with($notif);
                                    }else{
                                        $notif = array(
                                            'message' => 'PIN yang anda masukan salah',
                                            'alert-type' => 'fail'
                                        );
                                        return redirect()->back()->with($notif);
                                    }
    }
    
}
