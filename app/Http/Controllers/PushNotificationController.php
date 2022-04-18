<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\notification;
use App\Models\Users;
use App\Models\trader;
use Carbon\Carbon;

class PushNotificationController extends Controller
{

    public $limit = 100;

    public function index($broadcastId)
    {
        $detailBroadcast = $this->getDetailBroadcast($broadcastId);
        $kategori = $detailBroadcast['broadcast_category_name'];
        $targets = $detailBroadcast['target'];
        $notif = $detailBroadcast['list'][0];
        $limit = $this->limit;
        return view('admin.crm.push-notif', compact('broadcastId', 'targets', 'notif', 'kategori', 'limit'));
    }
    
    public function pushNotif($id, Request $request)
    {
        $detailBroadcast = $this->getDetailBroadcast($id);
        $userId = [];
        $statusKYC = "";
        $gender = "";
        $umurAwal = 0;
        $umurAkhir = 0;
        $depoAwal = 0;
        $depoAkhir = 0;
        $regencyName = '';
        $provinsiName = '';
        $totalSahamMinimal = 0;
        $totalSahamMaksimal = 0;
        $jumlahSahamMinimal = 0;
        $jumlahSahamMaksimal = 0;
        $skemaKYC = '';
        $skemaGender = '';
        $skemaUmur = '';
        $skemaPendapatan = '';
        $skemaKota = '';
        $skemaProvinsi = '';
        $skemaKepemilikanSaham = '';
        $skemaJumlahSahamRP = '';
        $skemaJumlahSahamCount = '';
        $skemaSisaLimitInvestasi = '';
        $skemaRataRataPembelian = '';
        $skemaDeposit = '';
        $skemaSID = '';
        $skemaIOS = '';
        $skemaAndroid = '';

        foreach($detailBroadcast['target'] as $target){
            if($target['name'] == 'Status KYC'){
                $skemaKYC .= 1;
                $statusKYC = $target['params'];
            }
            if($target['name'] == 'Gender'){
               $skemaGender .= 2;
               $gender = $target['params'];
            }
            if($target['name'] == 'Umur'){
                $skemaUmur .= 3; 
                $age = explode(" ", $target['params']);
                $umurAwal = $age[0];
                $umurAkhir = $age[2];
            }
            if($target['name'] == 'Pendapatan Per Tahun'){
                $skemaPendapatan .= 4; 
            }
            if($target['name'] == 'Kota/Kabupaten'){
                $skemaKota .= 5; 
                $regencyName = $target['params'];
            }
            if($target['name'] == 'Provinsi'){
                $skemaProvinsi .= 6; 
                $provinsiName = $target['params'];
            }
            if($target['name'] == 'Kepemilikan Saham'){
                $skemaKepemilikanSaham .= 7; 
            }
            if($target['name'] == 'Jumlah Saham (Rp)'){
                $skemaJumlahSahamRP .= 8; 
                $saham = explode(" ", $target['params']);
                $totalSahamMinimal = $saham[0];
                $totalSahamMaksimal = $saham[0];
            }
            if($target['name'] == 'Jumlah Saham (Count)'){
                $skemaJumlahSahamCount .= 9; 
                $saham = explode(" ", $target['params']);
                $jumlahSahamMinimal = $saham[0];
                $jumlahSahamMaksimal = $saham[0];
            }
            if($target['name'] == 'Sisa Limit Investasi'){
                $skemaSisaLimitInvestasi .= 10; 
            }
            if($target['name'] == 'Rata-rata Pembelian'){
                $skemaRataRataPembelian .= 11; 
            }
            if($target['name'] == 'Deposit'){
                $skemaDeposit .= 12; 
                $depo = explode(" ", $target['params']);
                $depoAwal = $depo[0];
                $depoAkhir = $depo[2];
            }
            if($target['name'] == 'SID'){
                $skemaSID .= 13; 
            }
            if($target['name'] == 'Versi Aplikasi (iOs)'){
                $skemaIOS .= 14; 
            }
            if($target['name'] == 'Versi Aplikasi (Android)'){
                $skemaAndroid .= 15; 
            }
        }
        
            $traders = trader::query();

            $traders->leftJoin('deposits as depo', 'depo.trader_id', '=', 'traders.id')
                ->leftJoin('transactions as tr', 'tr.trader_id', '=', 'traders.id');
            $traders->select('traders.user_id', 'traders.birth_date', 'depo.amount', 'tr.amount as amo');
            $traders->where('traders.is_deleted', 0);
            
            if($skemaKYC == 1){
                if($statusKYC == 1){
                    $traders->where('traders.status_kyc1', 'verified');
                    $traders->where('traders.status_kyc2', 'verified');
                    $traders->where('traders.status_kyc3', 'verified');
                    $traders->where('traders.status_kyc4', 'verified');
                    $traders->where('traders.status_kyc5', 'verified');
                    $traders->where('traders.status_kyc6', 'verified');
                }else{
                    $traders->where('traders.status_kyc1', 'empty');
                    $traders->where('traders.status_kyc2', 'empty');
                    $traders->where('traders.status_kyc3', 'empty');
                    $traders->where('traders.status_kyc4', 'empty');
                    $traders->where('traders.status_kyc5', 'empty');
                    $traders->where('traders.status_kyc6', 'empty');
                }
            }

            if($skemaUmur == 2){
                $traders->where('traders.gender', $gender);
            }

            if($skemaUmur == 3){
                $traders->having(\DB::raw('FLOOR(DATEDIFF(CURDATE(), traders.birth_date) / 365)'), '>=' ,$umurAwal);
                $traders->having(\DB::raw('FLOOR(DATEDIFF(CURDATE(), traders.birth_date) / 365)'), '<=' ,$umurAkhir);
            }

            if($skemaKota == 5){
                $traders->where('traders.regency', $regencyName);
            }

            if($skemaProvinsi == 6){
                $traders->where('traders.province', $provinsiName);
            }

            if($skemaJumlahSahamRP == 8){
                $traders->having(\DB::raw('SUM(amo)'), '>=' ,$totalSahamMinimal);       
                $traders->having(\DB::raw('SUM(amo)'), '<=' ,$totalSahamMaksimal);
                $traders->groupBy('tr.trader_id');
            }

            if($skemaJumlahSahamCount == 9){
                $traders->having(\DB::raw('COUNT(amo)'), '>=' ,$jumlahSahamMinimal);       
                $traders->having(\DB::raw('COUNT(amo)'), '<=' ,$jumlahSahamMaksimal);
                $traders->groupBy('tr.trader_id');
            }

            if($skemaDeposit == 12){
                $traders->having(\DB::raw('SUM(depo.amount)'), '>=' ,$depoAwal);       
                $traders->having(\DB::raw('SUM(depo.amount)'), '<=' ,$depoAkhir);
                $traders->groupBy('depo.trader_id');
            }
            $count = $traders->count();
            $traders->groupBy('traders.id');
            $results = $traders->paginate($this->limit);
        return response()->json(["results" => $results, "amount" => $count]);
    }

    public function broadcastNotif(Request $request)
    {
        $userId = explode(",", $request->userId);
        for($i = 0; $i < count($userId); $i++){
            $notif = new notification();
            $notif->uuid = \Str::uuid();
            $notif->action = $request->broadcastCategoryName;
            $notif->user_id = $userId[$i];
            //$notif->user_id = 190382;
            $notif->message = $request->message;
            $notif->title = $request->title;
            $notif->created_at = Carbon::now();
            $notif->updated_at = Carbon::now();
            $notif->is_deleted = 0;
            $notif->created_by = \Auth::user()->id;
            $notif->save();
        }
        return response()->json(["code" => 200, "message" => "Berhasil melakukan broadcast"]);
    }

    public function getDetailBroadcast($id)
    {
        $result = null;
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION'). 'broadcast/detail/' . $id, [
                'form_params' => [
                    'token'     => app('request')->session()->get('token'),
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
