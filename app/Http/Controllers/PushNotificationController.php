<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\notification;
use App\Models\Users;
use App\Models\trader;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PushNotificationController extends Controller
{

    public $limit = 10000;

    public function index($broadcastId)
    {
        $detailBroadcast = $this->getDetailBroadcast($broadcastId);
        $kategori = $detailBroadcast['broadcast_category_name'];
        $namaBroadcast = $detailBroadcast['name'];
        $targets = $detailBroadcast['target'];
        $notif = $detailBroadcast['list'][0];
        $limit = $this->limit;
       // return response()->json(["data" => $detailBroadcast]);
        return view('admin.crm.push-notif', compact('broadcastId', 'targets', 'kategori', 'notif', 'namaBroadcast', 'limit'));
    }
    
    public function pushNotif($id)
    {
        $detailBroadcast = $this->getDetailBroadcast($id);
        $userId = [];
        $statusKYC = "";
        $gender = "";
        $umurAwal = 0;
        $umurAkhir = 0;
        $pendapatanAwal = 0;
        $pendapatanAkhir = 0;
        $depoAwal = 0;
        $depoAkhir = 0;
        $regencyName = '';
        $provinsiName = '';
        $kepemilikanSaham = ''; 
        $totalSahamMinimal = 0;
        $totalSahamMaksimal = 0;
        $jumlahSahamMinimal = 0;
        $jumlahSahamMaksimal = 0;
        $unlimitedInvest = false;
        $limitAwalInvest = 0;
        $limitAkhirInvest = 0;
        $rataPembelianAwal = 0;
        $rataPembelianAkhir = 0;
        $statusSID = '';
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
                $income = explode(" ", $target['params']);
                $pendapatanAwal = $income[0];
                $pendapatanAkhir = $income[2];
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
                $kepemilikanSaham = $target['params'];
            }
            if($target['name'] == 'Jumlah Saham (Rp)'){
                $skemaJumlahSahamRP .= 8; 
                $saham = explode(" ", $target['params']);
                $totalSahamMinimal = $saham[0];
                $totalSahamMaksimal = $saham[2];
            }
            if($target['name'] == 'Jumlah Saham (Count)'){
                $skemaJumlahSahamCount .= 9; 
                $saham = explode(" ", $target['params']);
                $jumlahSahamMinimal = $saham[0];
                $jumlahSahamMaksimal = $saham[2];
            }
            if($target['name'] == 'Sisa Limit Investasi'){
                $skemaSisaLimitInvestasi .= 10; 
                if($target['params'] == '999999999999'){
                    $unlimitedInvest = true;
                }else{
                    $limit = explode(" ", $target['params']);
                    $limitAwalInvest = $limit[0];
                    $limitAkhirInvest = $limit[2];
                }
            }
            if($target['name'] == 'Rata-rata Pembelian'){
                $skemaRataRataPembelian .= 11; 
                $rata2 = explode(" ", $target['params']);
                $rataPembelianAwal = $rata2[0];
                $rataPembelianAkhir = $rata2[2];
            }
            if($target['name'] == 'Deposit'){
                $skemaDeposit .= 12; 
                $depo = explode(" ", $target['params']);
                $depoAwal = $depo[0];
                $depoAkhir = $depo[2];
            }
            if($target['name'] == 'SID'){
                $skemaSID .= 13; 
                $statusSID = $target['params'];
            }
            if($target['name'] == 'Versi Aplikasi (iOs)'){
                $skemaIOS .= 14; 
            }
            if($target['name'] == 'Versi Aplikasi (Android)'){
                $skemaAndroid .= 15; 
            }
        }
        
            $traders = trader::query();

            $traders->join('users as u', 'u.id', '=', 'traders.user_id')
                ->join('jobs as j', 'j.trader_id', '=', 'traders.id')
                ->leftJoin('trader_banks as tb', 'tb.trader_id', 'traders.id')
                ->leftJoin('deposits as depo', 'depo.trader_id', '=', 'traders.id')
                ->leftJoin('transactions as tr', 'tr.trader_id', '=', 'traders.id');
            $traders->select('traders.user_id', 'traders.birth_date', 'depo.amount', 'tr.amount as amo', 'u.email',
                    'j.income', 'tr.trader_id', 'tr.is_deleted', 'tr.last_status', \DB::raw('SUM(tr.amount) as total'));
            // $traders->select('traders.user_id');
            $traders->where('traders.is_deleted', 0);
            
            if($skemaKYC == 1){
                if($statusKYC == 1){
                    $traders->where('users.is_verified_kyc', 1);
                }else{
                    $traders->where('users.is_verified_kyc', 0);
                }
            }

            if($skemaGender == 2){
                $traders->where('traders.gender', $gender);
            }

            if($skemaUmur == 3){
                $traders->having(\DB::raw('FLOOR(DATEDIFF(CURDATE(), traders.birth_date) / 365)'), '>=' ,$umurAwal);
                $traders->having(\DB::raw('FLOOR(DATEDIFF(CURDATE(), traders.birth_date) / 365)'), '<=' ,$umurAkhir);
            }

            if($skemaPendapatan == 4){
                $traders->having(\DB::raw('j.income'), '>=', $pendapatanAwal);
                $traders->having(\DB::raw('j.income'), '<=', $pendapatanAkhir);
            }

            if($skemaKota == 5){
                $traders->where('traders.regency', $regencyName);
            }

            if($skemaProvinsi == 6){
                $traders->where('traders.province', $provinsiName);
            }

            if($skemaProvinsi == 7){
                if($kepemilikanSaham == "1"){
                    $traders->whereNotNull("tr.trader_id");
                }else{
                    $traders->whereNull("tr.trader_id");
                }
            }

            if($skemaJumlahSahamRP == 8){
                $traders->having(\DB::raw('SUM(amo)'), '>=' ,$totalSahamMinimal);       
                $traders->having(\DB::raw('SUM(amo)'), '<=' ,$totalSahamMaksimal);
                $traders->where('tr.is_deleted', 0);
                $traders->where('tr.last_status', 'VERIFIED');
                $traders->groupBy('tr.trader_id');
            }

            if($skemaJumlahSahamCount == 9){
                $traders->having(\DB::raw('COUNT(amo)'), '>=' ,$jumlahSahamMinimal);       
                $traders->having(\DB::raw('COUNT(amo)'), '<=' ,$jumlahSahamMaksimal);
                $traders->where('tr.is_deleted', 0);
                $traders->where('tr.last_status', 'VERIFIED');
            }

            if($skemaSisaLimitInvestasi == 10){
                if($unlimitedInvest){
                    $traders->where('j.is_unlimited_invest', 1);
                }else{
                    $traders->where('j.is_unlimited_invest', 0);
                    if($limitAwalInvest > 500000000){
                        $traders->having(\DB::raw('income * 10 /100'), '>=' ,$limitAwalInvest); 
                        $traders->having(\DB::raw('income * 10 /100'), '<=' ,$limitAkhirInvest); 
                    }else{
                        $traders->having(\DB::raw('income * 5 /100'), '>=' ,$limitAwalInvest); 
                        $traders->having(\DB::raw('income * 5 /100'), '<=' ,$limitAkhirInvest); 
                    }
                }
            }

            if($skemaRataRataPembelian == 11){
                $traders->having(\DB::raw('SUM(amo) / COUNT(amo)'), '>=' ,$rataPembelianAwal); 
                $traders->having(\DB::raw('SUM(amo) / COUNT(amo)'), '<=' ,$rataPembelianAkhir); 
            }

            if($skemaDeposit == 12){
                $traders->having(\DB::raw('SUM(depo.amount)'), '>=' ,$depoAwal);       
                $traders->having(\DB::raw('SUM(depo.amount)'), '<=' ,$depoAkhir);
                $traders->groupBy('depo.trader_id');
            }

            if($skemaSID == 13){
                if($statusSID == 'IS NOT NULL'){
                    $traders->whereNotNull('tb.sid_number');
                }else{
                    $traders->whereNull('tb.sid_number');
                }
            }

            $traders->groupBy('traders.user_id');
            $traders->orderBy('traders.user_id', 'ASC');
            $results = $traders->paginate($this->limit);
        return response()->json(["results" => $results]);
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

    public function schedulerbroadcastNotif(Request $request)
    {
        $s = Carbon::now();
        $broad = DB::table('broadcasts')->whereDate('send_on',$s->toDateString())->first();
        // $id = $broad->id;
        // $test = $this->pushNotif($id);
        // if ($broad) {
        //     # code...
        //     $userId = explode(",", $request->userId);
        //     for($i = 0; $i < count($userId); $i++){
        //         $notif = new notification();
        //         $notif->uuid = \Str::uuid();
        //         $notif->action = 'Informasi';
        //         $notif->user_id = $userId[$i];
        //         //$notif->user_id = 190382;
        //         $notif->message = $request->message;
        //         $notif->title = $request->title;
        //         $notif->created_at = Carbon::now();
        //         $notif->updated_at = Carbon::now();
        //         $notif->is_deleted = 0;
        //         $notif->created_by = Auth::user()->id;
        //         $notif->save();
        //     }
        // }
        // $userId = explode(",", $request->userId);
        // for($i = 0; $i < count($userId); $i++){
        //     $notif = new notification();
        //     $notif->uuid = \Str::uuid();
        //     $notif->action = 'Informasi';
        //     $notif->user_id = $userId[$i];
        //     //$notif->user_id = 190382;
        //     $notif->message = $request->message;
        //     $notif->title = $request->title;
        //     $notif->created_at = Carbon::now();
        //     $notif->updated_at = Carbon::now();
        //     $notif->is_deleted = 0;
        //     $notif->created_by = \Auth::user()->id;
        //     $notif->save();
        // }
        // return response()->json(["code" => 200, "message" => "Berhasil melakukan broadcast"]);
        
        dd($this->getDetailBroadcast(321));
        // echo $dt->toDateString();	2015-04-21
        // echo $dt->toFormattedDateString();	Apr 21, 2015
        // echo $dt->toTimeString();	22:32:05
        // echo $dt->toDateTimeString();	2015-04-21 22:32:05
        // echo $dt->toDayDateTimeString();	Tue, Apr 21, 2015 10:32 PM
    }

    public function broadcastEmail(Request $request)
    {
        $email = explode(",", $request->email);
        for($i = 0; $i < count($email); $i++){
            $details = [
                'title' => $request->title,
                'body' => $request->message,
                'image' => $request->image,
                'redirection' => $request->redirection,
                'subject' => $request->namaBroadcast
            ]; 
    
            \Mail::to($email[$i])->send(new \App\Mail\NotificationMail($details));
        }
        return response()->json(["code" => 200, "message" => "Berhasil melakukan broadcast email"]);
    }

    public function getDetailBroadcast($id)
    {
        $result = null;
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION'). 'broadcast/detail/' . $id, [
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
