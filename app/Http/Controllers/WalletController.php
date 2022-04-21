<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BalanceUtama;
use App\Models\Transactions;

class WalletController extends Controller
{
    
    public function index()
    {
        $saldoData = BalanceUtama::select(\DB::raw('SUM(balance) as jumlahBalance'))->first();
        $transaksiData = Transactions::join('traders as t', 't.id', '=', 'transactions.trader_id')
            ->join('emitens as e', 'e.id', '=', 'transactions.emiten_id')
            ->where('transactions.is_verified', 1)
            ->select(\DB::raw('SUM(transactions.amount) as amo'))
            ->first();
        $saldo = $saldoData->jumlahBalance;
        $transaksi = $transaksiData->amo;
        // $token = $this->fetchData('token');
        // $balance = $this->fetchData('emiten') + $this->fetchData('saldo');
        // $saldo = $this->fetchData('saldo');
        return view('admin.wallet.index', compact('saldo', 'transaksi'));
    }

    public function fetchData($type) {
        $asset = 0;
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Authorization' => 'Bearer '.app('request')->session()->get('token'),        
            'Accept'        => 'application/json',
            'Content-type'  => 'application/json'
        ];
        
        if($type == 'token'):
            try {
                $client = new \GuzzleHttp\Client();
                $headers = [
                    'Authorization' => 'Bearer '.app('request')->session()->get('token'),        
                    'Accept'        => 'application/json',
                    'Content-type'  => 'application/json'
                ];          
                $responseToken = $client->request('GET', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'tokens/', [
                    'headers' => $headers,
                ]);
                if ( $responseToken->getStatusCode() == 200 ) {
                    $asset = json_decode($responseToken->getBody()->getContents(), TRUE);
                }
    
            } catch (\Exception $exception) {
                $asset = 0;
            }
        endif;

        if($type == 'saldo'):
            $saldo = 0;
            try {        
                $responseSaldo = $client->request('GET', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'traders/idr', [
                    'headers' => $headers,
                ]);

                if ( $responseSaldo->getStatusCode() == 200 ) {
                    $saldo = json_decode($responseSaldo->getBody()->getContents(), TRUE); 
                    $asset = $saldo['idr'];
                }

            } catch (\Exception $exception) {
                $asset = 0;
            }

        endif;

        if($type == 'emiten'):
            $token = 0;
            try {        
                $responseToken = $client->request('GET', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'tokens/', [
                    'headers' => $headers,
                ]);

                if ( $responseToken->getStatusCode() == 200 ) {
                    $token = json_decode($responseToken->getBody()->getContents(), TRUE); 
                    if ($token > 0){
                        $asset = array_sum(array_column($token, 'amount'));
                    }
                }

            } catch (\Exception $exception) {
                $asset = 0;
            }

        endif; 

        return $asset;
	}


}
