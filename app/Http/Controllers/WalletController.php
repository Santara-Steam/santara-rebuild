<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    
    public function index()
    {
        $token = $this->fetchData('token');
        $balance = $this->fetchData('emiten') + $this->fetchData('saldo');
        $saldo = $this->fetchData('saldo');
        return view('admin.wallet.index', compact('token', 'balance', 'saldo'));
    }

    public function fetchData($type) {
        $asset = 0;
        $client = new \GuzzleHttp\Client();

        $headers = [
            'Authorization' => 'Bearer '.config('global.TOKEN'),        
            'Accept'        => 'application/json',
            'Content-type'  => 'application/json'
        ];
        
        if($type == 'token'):
            try {
                $client = new \GuzzleHttp\Client();
                $headers = [
                    'Authorization' => 'Bearer '.config('global.TOKEN'),        
                    'Accept'        => 'application/json',
                    'Content-type'  => 'application/json'
                ];          
                $responseToken = $client->request('GET', config('global.BASE_API_ADMIN_URL').'tokens/', [
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
                $responseSaldo = $client->request('GET', config('global.BASE_API_ADMIN_URL').'traders/idr', [
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
                $responseToken = $client->request('GET', config('global.BASE_API_ADMIN_URL').'tokens/', [
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
