<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\notification;
use App\Models\Users;
use App\Models\trader;

class PushNotificationController extends Controller
{
    
    public function pushNotif($id)
    {
        $detailBroadcast = $this->getDetailBroadcast($id);
        $userId = [];
        $statusKYC = "";
        $gender = "";
        $umurAwal = 0;
        $umurAkhir = 0;
        $depoAwal = 0;
        $depoAkhir = 0;
        $beforeSkema = '';
        foreach($detailBroadcast['target'] as $target){
            if($target['name'] == 'Status KYC'){
                $beforeSkema .= 1;
                $statusKYC = $target['params'];
            }
            if($target['name'] == 'Gender'){
               $beforeSkema .= 2;
               $gender = $target['params'];
            }
            if($target['name'] == 'Umur'){
                $beforeSkema .= 3; 
                $age = explode(" ", $target['params']);
                $umurAwal = $age[0];
                $umurAkhir = $age[2];
            }
            if($target['name'] == 'Pendapatan Per Tahun'){
                $beforeSkema .= 4; 
            }
            if($target['name'] == 'Kota/Kabupaten'){
                $beforeSkema .= 5; 
            }
            if($target['name'] == 'Provinsi'){
                $beforeSkema .= 6; 
            }
            if($target['name'] == 'Kepemilikan Saham'){
                $beforeSkema .= 7; 
            }
            if($target['name'] == 'Kepemilikan Saham'){
                $beforeSkema .= 7; 
            }
            if($target['name'] == 'Jumlah Saham (Rp)'){
                $beforeSkema .= 8; 
            }
            if($target['name'] == 'Jumlah Saham (Count)'){
                $beforeSkema .= 8; 
            }
            if($target['name'] == 'Rata-rata Pembelian'){
                $beforeSkema .= 9; 
            }
            if($target['name'] == 'Kepemilikan Saham'){
                $beforeSkema .= 10; 
            }
            if($target['name'] == 'SID'){
                $beforeSkema .= 10; 
            }
            if($target['name'] == 'Deposit'){
                $beforeSkema .= 12; 
                $depo = explode(" ", $target['params']);
                $depoAwal = $depo[0];
                $depoAkhir = $depo[2];
            }
            if($target['name'] == 'Versi Aplikasi (iOs)'){
                $beforeSkema .= 13; 
            }
            if($target['name'] == 'Versi Aplikasi (Android)'){
                $beforeSkema .= 14; 
            }
        }
        if($beforeSkema == 123456771088912101314){
            # oke
        }
        if($beforeSkema == 12){
            if($statusKYC == "1"){
                $traders = trader::join('kyc_submissions as ks', 'ks.trader_id', '=', 'traders.id')
                            ->where('traders.is_deleted', 0)
                            ->where('ks.status', 'verified')
                            ->where('traders.gender', $gender)
                            ->select('traders.user_id')
                            ->get();
                foreach($traders as $row){
                    array_push($userId, $row->user_id);
                }
            }
        }
        if($beforeSkema == 2312){
            $traders = trader::join('kyc_submissions as ks', 'ks.trader_id', '=', 'traders.id')
                        ->select('traders.user_id', \DB::raw('FLOOR(DATEDIFF(CURDATE(), traders.birth_date) / 365) as age'))
                        ->where('traders.is_deleted', 0)
                        ->whereBetween('age', [$umurAwal, $umurAkhir])
                        ->where('ks.status', 'verified')
                        ->get();
            foreach($traders as $row){
                array_push($userId, $row->user_id);
            }
        }
        return response()->json($traders);

        //for($i = 0; $i < count($detailBroadcast['target']); $i++){
            //if($detailBroadcast['target'][$i]['name']);
            // if($target['name'] == 'Status KYC'){
            //     if(intval($target['params']) == 0){
            //         $traders = trader::leftJoin('kyc_submissions as ks', 'ks.trader_id', '=', 'traders.id')
            //             ->whereNull('ks.status')
            //             ->where('traders.is_deleted', 0)
            //             ->select('traders.user_id')
            //             ->get();
            //         foreach($traders as $row){
            //             array_push($userIdKYC, $row->user_id);
            //         }
            //     }else{
            //         $traders = trader::join('kyc_submissions as ks', 'ks.trader_id', '=', 'traders.id')
            //             ->where('traders.is_deleted', 0)
            //             ->where('ks.status', 'verified')
            //             ->select('traders.user_id')
            //             ->get();
            //         foreach($traders as $row){
            //             array_push($userIdKYC, $row->user_id);
            //         }
            //     }
            // }
            // if($target['name'] == 'Gender'){
            //     $traders = trader::where('gender', 'm')
            //         ->where('is_deleted', 0)
            //         ->select('traders.user_id')
            //         ->get();
            //     foreach($traders as $row){
            //         array_push($userIdGender, $row->user_id);
            //     }
            // }
        //}
        // echo $detailBroadcast['target'][0]['name'];
        // return response()->json([
        //     "kyc" => $userIdKYC, 
        //     "gender" => $userIdGender
        // ]);
    }

    public function getDetailBroadcast($id)
    {
        $result = null;
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', env('BASE_API_ADMIN_URL').env('API_ADMIN_VERSION'). 'broadcast/detail/' . $id, [
                'form_params' => [
                    'token'     => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOjg3MDI4LCJkYXRhIjp7ImlkIjo4NzAyOCwidXVpZCI6ImIzNDM2MjZkLTE4MTktNDk1My04OWQ0LTBjMTZlMTdjZTAwNCIsImVtYWlsIjoibWFyaW9naWxAc3BhbTQubWUiLCJjcmVhdGVkX2F0IjoiMjAyMC0wNi0wNCAwMTo1MTo0NyIsInVwZGF0ZWRfYXQiOiIyMDIwLTEwLTAxIDE1OjQzOjI0IiwiZGVsZXRlZF9hdCI6bnVsbCwicm9sZV9pZCI6MiwiaXNfdmVyaWZpZWQiOjEsInR3b19mYWN0b3JfYXV0aCI6MCwidHdvX2ZhY3Rvcl9zZWNyZXQiOm51bGwsImlzX2xvZ2dlZF9pbiI6MSwiaXNfZGVsZXRlZCI6MCwiY3JlYXRlZF9ieSI6bnVsbCwidXBkYXRlZF9ieSI6bnVsbCwiaXNfb3RwIjoxLCJhdHRlbXB0IjowLCJhdHRlbXB0X2VtYWlsIjowLCJmaW5nZXJfcHJpbnQiOjAsImF0dGVtcHRfb3RwIjoxfSwiaWF0IjoxNjAxNTQyMDY3fQ.hF9V_fFbYD_QQZAHFz2N7rf1X6x3UEf4EPi3WD7d1OM',
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $detail = json_decode($response->getBody()->getContents(), TRUE);
                $result = $detail['data'];
            }
        } catch (\Exception $exception) {
            $result = null;
        }

        return $result;
    }

}
