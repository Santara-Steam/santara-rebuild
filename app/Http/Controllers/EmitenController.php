<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Helpers\Misc;
use App\Models\Deposit;
use App\Models\emiten;
use App\Models\emiten_journey;
use App\Models\kategori;
use App\Models\trader;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Google\Cloud\Storage\StorageClient;
use Carbon\Carbon;
use DB;

class EmitenController extends Controller
{
    //
    public function index(){
        $soldout = emiten::select('emitens.id', 'emitens.company_name', 'emitens.trademark', 'emitens.code_emiten', 'emitens.price',
            'emitens.supply', 'emitens.is_deleted', 'emitens.is_active', 'emitens.begin_period', 'emitens.created_at',
            'categories.category as ktg','emitens.begin_period as sd', 'emitens.end_period as ed')
            ->leftjoin('categories', 'categories.id','=','emitens.category_id')
            ->leftjoin('transactions','transactions.emiten_id','=','emitens.id')
            ->where('emitens.is_deleted',0)
            ->groupBy('emitens.id')
            ->havingRaw('CONVERT(ROUND(
                IF(
                  (SUM(
                    IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply > 1, 1,
                      (SUM(
                        IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply) * 100, 2), char) = 100.00
                        and
                        emitens.is_deleted = 0
                        and emitens.is_active = 1
                        and emitens.begin_period < now()')
            ->get();
        // $commingsoon = emiten::select('emitens.id', 'emitens.company_name', 'emitens.trademark', 'emitens.code_emiten', 'emitens.price',
        //     'emitens.supply', 'emitens.is_deleted', 'emitens.is_active', 'emitens.begin_period', 'emitens.created_at',
        //     'categories.category as ktg','emitens.begin_period as sd', 'emitens.end_period as ed')
        //     ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        //     ->leftjoin('emiten_votes as ev','ev.emiten_id','=','emitens.id')
        //     ->leftjoin('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
        //     ->where('emitens.is_deleted',0)
        //     ->where('emitens.is_verified',1)
        //     ->where('emitens.is_pralisting',1)
        //     ->where('emitens.is_coming_soon',1)
        //     ->groupBy('emitens.id')
        //     ->orderby('created_at','DESC')
        //     ->get();
        $dtNowPlaying = emiten::select('emitens.id', 'emitens.company_name', 'emitens.trademark', 'emitens.code_emiten', 'emitens.price',
        'emitens.supply', 'emitens.is_deleted', 'emitens.is_active', 'emitens.begin_period', 'emitens.created_at',
        'categories.category as ktg','emitens.begin_period as sd', 'emitens.end_period as ed',
        DB::raw('CONVERT(ROUND(
            IF(
              (SUM(
                IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply > 1, 1,
                  (SUM(
                    IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply) * 100, 2), char) as sold_out'))
            ->leftjoin('categories', 'categories.id','=','emitens.category_id')
            ->leftjoin('transactions', function($query){
                $query->on('transactions.emiten_id','=','emitens.id')
                    ->where('transactions.channel', '<>', 'MARKET');
            })
            ->where('emitens.is_active', 1)
            ->where('emitens.is_deleted',0)
            ->groupBy('emitens.id')
            ->get();
        $nowPlaying = [];

        // $collection = collect($soldout);
        // $merged = $collection->merge($commingsoon);
        // $mergedData = $merged->all();

        $mergedData = [];
        foreach($soldout as $row){
            array_push($mergedData, [
                'id' => $row->id,
                'company_name' => $row->company_name,
                'trademark' => $row->trademark,
                'code_emiten' => $row->code_emiten,
                'price' => $row->price,
                'supply' => $row->supply,
                'is_deleted' => $row->is_deleted,
                'is_active' => $row->is_active,
                'begin_period' => $row->begin_period,
                'created_at' => $row->created_at,
                'ktg' => $row->ktg,
            ]);
        }

        foreach($dtNowPlaying as $row){
            if($row->sold_out != '100.00'){
                array_push($mergedData, [
                    'id' => $row->id,
                    'company_name' => $row->company_name,
                    'trademark' => $row->trademark,
                    'code_emiten' => $row->code_emiten,
                    'price' => $row->price,
                    'supply' => $row->supply,
                    'is_deleted' => $row->is_deleted,
                    'is_active' => $row->is_active,
                    'begin_period' => $row->begin_period,
                    'created_at' => $row->created_at,
                    'ktg' => $row->ktg,
                ]);
            }
        }
        $emiten = [];
        foreach($mergedData as $row){
                $latestJourney = $this->getLatestJourney($row['id']);
                array_push($emiten, [
                    'id' => $row['id'],
                    'company_name' => $row['company_name'],
                    'trademark' => $row['trademark'],
                    'code_emiten' => $row['code_emiten'],
                    'price' => $row['price'],
                    'supply' => $row['supply'],
                    'is_deleted' => $row['is_deleted'],
                    'is_active' => $row['is_active'],
                    'begin_period' => $row['begin_period'],
                    'created_at' => $row['created_at'],
                    'last_emiten_journey' => $latestJourney['title'],
                    'ktg' => $row['ktg'],
                    'sd' => $latestJourney['date'],
                    'ed' => $latestJourney['end_date']
                ]);
        }
        //echo json_encode($emiten);
        return view('admin.emiten.index',compact('emiten'));
    }

    public function getLatestJourney($emitenId)
    {
        $emitenJourney = emiten_journey::where('emiten_id', $emitenId)
            ->orderBy('created_at', 'DESC')
            ->first();
        return $emitenJourney;
    }

    public function add(){
        $badanUsaha = (object) [
            '1' => 'PT',
            '2' => 'CV',
            '3' => 'UD',
            '4' => 'Firma',
            '5' => 'Koperasi',
            '6' => 'Yang Lain'
        ];
        $sistemPencatatan = (object) [
            '1' => 'Terkomputerisasi/Software akuntansi',
            '2' => 'Catatan pembukuan sederhana/POS',
            '3' => 'Hanya berupa bukti dokumentasi',
            '4' => 'Tidak ada'
        ];
        $posisiPasar = (object) [
            '1' => 'Tidak memiliki pinjaman',
            '2' => 'Memiliki pinjaman lancar',
            '3' => 'Pernah bermasalah namun lunas',
            '4' => 'Sedang/pernah bermasalah dan belum lunas'
        ];
        $marketPositition = (object) [
            '1' => 'Pemimpin pasar lokal/nasional',
            '2' => 'Mampu bersaing di pasar lokal/nasional',
            '3' => 'Berusaha bersaing di pasar lokal/nasional',
            '4' => 'Tidak mampu bersaing di pasar'
        ];
        $strategiEmiten = (object) [
            '1' => 'Punya milestone jangka panjang owner & infrastruktur siap',
            '2' => 'Milestone sedang disusun owner & infrastruktur sedang diperkuat',
            '3' => 'Lebih menekankan strategi jangka pendek agar optimal',
            '4' => 'Strategi case by case/tentavie agar efektif'
        ];
        $statusKantor = (object) [
            '1' => 'Milik sendiri/sewa > 5 Tahun',
            '2' => 'Sewa > 2 s.d 5 Tahun',
            '3' => 'Sewa < 2 Tahun',
            '4' => 'Sewa Bulanan'
        ];
        $levelKompetisi = (object) [
            '1' => 'Mampu memenangkan persaingan',
            '2' => 'Mampu bersaing namun bukan pemimpin pasar',
            '3' => 'Berusaha bersaing namun bukan pemimpin pasar',
            '4' => 'Sedang/Pernah bermasalah dan belum lunas'
        ];
        $kemapuanManager = (object) [
            '1' => 'Mampu memenangkan persaingan',
            '2' => 'Mampu bersaing namun bukan pemimpin pasar',
            '3' => 'Berusaha bersaing namun bukan pemimpin pasar',
            '4' => 'Tidak mampu bersaing di pasar'
        ];
        $kemapuanTeknis = (object) [
            '1' => 'Owner/Manajemen ahli di bisnis ini',
            '2' => 'Owner/Manajemen baru dibisnis ini namun memiliki pengalaman bisnis yang sejenis',
            '3' => 'Owner/Manajemen belum pernah memiliki keahlian/pengalaman di bisnis ini dan sejenisnya namun telah memiliki pengalaman di sektor lain',
            '4' => 'Owner/Manajemen baru mulai berbisnis/belum ada track record'
        ];
        return view('admin.emiten.add', compact('badanUsaha',
            'sistemPencatatan',
            'posisiPasar',
            'marketPositition',
            'strategiEmiten',
            'statusKantor',
            'levelKompetisi',
            'kemapuanManager',
            'kemapuanTeknis'
        ));
    }

    public function getCategories(Request $request)
    {
        $search = $request->search;
        if($search != ""){
            $kategori = kategori::where('is_deleted', 0)
                ->where('category', 'like', '%'.$search.'%')
                ->select('id', 'category')
                ->get();
        }else{
            $kategori = kategori::where('is_deleted', 0)
                ->limit(5)
                ->select('id', 'category')
                ->get();
        }
        return response()->json($kategori);
    }

    public function getUser(Request $request)
    {
        $search = $request->search;
        if($search != ""){
            $users = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->where('users.role_id', 2)
                ->where('users.is_deleted', 0)
                ->where('users.email', 'like', '%'.$search.'%')
                ->limit(5)
                ->select('t.id', 'users.email')
                ->get();
        }else{
            $users = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->where('users.role_id', 2)
                ->where('users.is_deleted', 0)
                ->limit(5)
                ->select('t.id', 'users.email')
                ->get();
        }
        return response()->json($users);
    }

    public function validator(array $data){
        return Validator::make($data,[
            'company_name' => ['required'],
            'logo' => ['required'],

        ]);
    }

    public function addDate45(Request $request)
    {
        $startDate = Carbon::parse($request->start_date);
        $newDate = $startDate->addDays(45);
        return response()->json(["data" => $newDate]);
    }

    public function store(Request $request)
    {
        $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
        $bucket = $storage->bucket($storageBucketName);
        $folderName = 'santara.co.id/token';

        if(!isset($request->thumbnail)){
            $logo = 'no-image.png';
        }else{
            $logo = $request->thumbnail;
        }
        if(!isset($request->banner)){
            $cover = 'no-image.png';
        }else{
            $cover = $request->banner;
        }
        if(!isset($request->galeri1)){
            $galeri = 'no-image.png';
        }else{
            $galeri = $request->galeri1;
        }
        if(!isset($request->galeri2)){
            $galeri2 = 'no-image.png';
        }else{
            $galeri2 = $request->galeri2;
        }
        if(!isset($request->galeri3)){
            $galeri3 = 'no-image.png';
        }else{
            $galeri3 = $request->galeri3;
        }
        if(!isset($request->owner)){
            $owner = 'no-image.png';
        }else{
            $owner = $request->owner;
        }

        $em = new emiten();
        $em->uuid = \Str::uuid();
        $em->company_name = $request->get('company_name');
        $em->owner_name = $request->get('nama_owner');
        $em->category_id = $request->get('kategori');
        $em->trader_id = $request->get('trader');
        $em->avg_annual_turnover_previous_year = str_replace(".", "", $request->get('omset1'));
        $em->avg_annual_turnover_current_year = str_replace(".", "", $request->get('omset2'));
        $em->avg_capital_needs = str_replace(".", "", $request->get('perkiraan_dana'));
        $em->avg_general_share_amount = str_replace(".", "", $request->get('saham_dilepas'));
        $em->avg_turnover_after_becoming_a_publisher= str_replace(".", "", $request->get('omset_penerbit'));
        $em->avg_annual_dividen= str_replace(".", "", $request->get('deviden_tahunan'));
        $em->youtube= str_replace("youtu.be/", "www.youtube.com/embed/", $request->get('video_profile'));
        $em->facebook= $request->get('fb');
        $em->website= $request->get('web');
        $em->instagram= $request->get('ig');
        $em->business_description= $request->get('deskripsi');
        $em->admin_desc= $request->get('bio_owner');
        $em->period = $request->get('period');
        $em->pictures = $logo.','.$cover.','.$owner.','.$galeri.','.$galeri2.','.$galeri3;
        $em->code_emiten = $request->get('code_emiten');
        $em->trademark = $request->get('brand');
        $em->price = str_replace(".", "", $request->get('harga_saham'));
        if(isset($request->regency_id)){
            $em->regency_id = $request->regency_id;
        }
        if(isset($request->business_entity)){
            $em->business_entity =  $request->business_entity;
        }
        if(isset($request->address)){
            $em->address = $request->address;
        }
        if(isset($request->business_lifespan)){
            $em->business_lifespan = $request->business_lifespan;
        }
        if(isset($request->branch_company)){
            $em->branch_company = $request->branch_company;
        }
        if(isset($request->employee)){
            $em->employee = $request->employee;
        }
        if(isset($request->capital_needs)){
            $em->capital_needs = $request->capital_needs;
        }
        if(isset($request->monthly_turnover)){
            $em->monthly_turnover = $request->monthly_turnover;
        }
        if(isset($request->monthly_profit)){
            $em->monthly_profit = $request->monthly_profit;
        }
        if(isset($request->monthly_turnover_previous_year)){
            $em->monthly_turnover_previous_year =  $request->monthly_turnover_previous_year;
        }
        if(isset($request->monthly_profit_previous_year)){
            $em->monthly_profit_previous_year =  $request->monthly_profit_previous_year;
        }
        if(isset($request->total_bank_debt)){
            $em->total_bank_debt =  $request->total_bank_debt;
        }
        if(isset($request->bank_name_financing)){
            $em->bank_name_financing =  $request->bank_name_financing;
        }
        if(isset($request->total_paid_capital)){
            $em->total_paid_capital = $request->total_paid_capital;
        }
        if(isset($request->financial_recording_system)){
            $em->financial_recording_system =  $request->financial_recording_system;
        }
        if(isset($request->bank_loan_reputation)){
            $em->bank_loan_reputation = $request->bank_loan_reputation;
        }
        if(isset($request->market_position_for_the_product)){
            $em->market_position_for_the_product = $request->market_position_for_the_product;
        }
        if(isset($request->strategy_emiten)){
            $em->strategy_emiten =  $request->strategy_emiten;
        }
        if(isset($request->office_status)){
            $em->office_status =  $request->office_status;
        }
        if(isset($request->level_of_business_competition)){
            $em->level_of_business_competition =  $request->level_of_business_competition;
        }
        if(isset($request->managerial_ability)){
            $em->managerial_ability = $request->managerial_ability;
        }if(isset($request->technical_ability)){
            $em->technical_ability = $request->technical_ability;
        }
        if(isset($request->dynamic_link)){
            $em->dynamic_link = $request->dynamic_link;
        }

        if($request->hasFile("prospektus")){
            $fileProspektus = fopen($request->file('prospektus')->getPathName(), 'r');
            $prospektusFileSave = 'prospektus'.time().'.pdf';
            $fileProspektus = $folderName.'/'.$prospektusFileSave;
            $bucket->upload($fileProspektus, [
                'predefinedAcl' => 'publicRead',
                'name' => $fileProspektus
            ]);
            $em->prospektus = $prospektusFileSave;
        }

        if(isset($request->video_url)){
            $em->video_url = $request->video_url;
        }
        $em->save();

        $emj = new emiten_journey();
        $emj->emiten_id = $em->id;
        $emj->title = "Pra Penawaran Saham";
        $emj->save();
        $notif = array(
            'message' => 'Emiten Berhasil Di Tambahkan',
            'alert-type' => 'success'
        );

        // $array = $logoFileSave.','.$coverFileSave.','.$galeriFileSave.','.$ownerFileSave;
        // dd($em);
        // return response()->json(['status' => 'Mantap']);
        return redirect('/admin/emiten')->with($notif);
    }

    public function edit(emiten $emiten,$id){
        $emiten = emiten::where('emitens.id',$id)->leftJoin('categories as ct', 'ct.id', '=', 'emitens.category_id')
            ->leftJoin('traders as t', 't.id', '=', 'emitens.trader_id')
            ->leftJoin('users as u', 'u.id', '=', 't.user_id')
            ->leftJoin('regencies as r', 'r.id', '=', 'emitens.regency_id')
            ->select('emitens.*', 'ct.category', 'u.email', 'r.name as kota')->first();
        $picture = explode(',',$emiten->pictures);
        if(empty($picture[0])){
            $picture[0] = '-';
        }else{
            $picture[0];
        }
        if(empty($picture[1])){
            $picture[1] = '-';
        }else{
            $picture[1];
        }
        if(empty($picture[2])){
            $picture[2] = '-';
        }else{
            $picture[2];
        }
        if(empty($picture[3])){
            $picture[3] = '-';
        }else{
            $picture[3];
        }
        if(empty($picture[4])){
            $picture[4] = '-';
        }else{
            $picture[4];
        }
        if(empty($picture[5])){
            $picture[5] = '-';
        }else{
            $picture[5];
        }
        if(empty($picture[6])){
            $picture[6] = '-';
        }else{
            $picture[6];
        }
        // dd($s);
        $badanUsaha = (object) [
            '1' => 'PT',
            '2' => 'CV',
            '3' => 'UD',
            '4' => 'Firma',
            '5' => 'Koperasi',
            '6' => 'Yang Lain'
        ];
        $sistemPencatatan = (object) [
            '1' => 'Terkomputerisasi/Software akuntansi',
            '2' => 'Catatan pembukuan sederhana/POS',
            '3' => 'Hanya berupa bukti dokumentasi',
            '4' => 'Tidak ada'
        ];
        $posisiPasar = (object) [
            '1' => 'Tidak memiliki pinjaman',
            '2' => 'Memiliki pinjaman lancar',
            '3' => 'Pernah bermasalah namun lunas',
            '4' => 'Sedang/pernah bermasalah dan belum lunas'
        ];
        $marketPositition = (object) [
            '1' => 'Pemimpin pasar lokal/nasional',
            '2' => 'Mampu bersaing di pasar lokal/nasional',
            '3' => 'Berusaha bersaing di pasar lokal/nasional',
            '4' => 'Tidak mampu bersaing di pasar'
        ];
        $strategiEmiten = (object) [
            '1' => 'Punya milestone jangka panjang owner & infrastruktur siap',
            '2' => 'Milestone sedang disusun owner & infrastruktur sedang diperkuat',
            '3' => 'Lebih menekankan strategi jangka pendek agar optimal',
            '4' => 'Strategi case by case/tentavie agar efektif'
        ];
        $statusKantor = (object) [
            '1' => 'Milik sendiri/sewa > 5 Tahun',
            '2' => 'Sewa > 2 s.d 5 Tahun',
            '3' => 'Sewa < 2 Tahun',
            '4' => 'Sewa Bulanan'
        ];
        $levelKompetisi = (object) [
            '1' => 'Mampu memenangkan persaingan',
            '2' => 'Mampu bersaing namun bukan pemimpin pasar',
            '3' => 'Berusaha bersaing namun bukan pemimpin pasar',
            '4' => 'Sedang/Pernah bermasalah dan belum lunas'
        ];
        $kemapuanManager = (object) [
            '1' => 'Mampu memenangkan persaingan',
            '2' => 'Mampu bersaing namun bukan pemimpin pasar',
            '3' => 'Berusaha bersaing namun bukan pemimpin pasar',
            '4' => 'Tidak mampu bersaing di pasar'
        ];
        $kemapuanTeknis = (object) [
            '1' => 'Owner/Manajemen ahli di bisnis ini',
            '2' => 'Owner/Manajemen baru dibisnis ini namun memiliki pengalaman bisnis yang sejenis',
            '3' => 'Owner/Manajemen belum pernah memiliki keahlian/pengalaman di bisnis ini dan sejenisnya namun telah memiliki pengalaman di sektor lain',
            '4' => 'Owner/Manajemen baru mulai berbisnis/belum ada track record'
        ];
        return view('admin.emiten.edit',compact(
            'emiten','picture','badanUsaha',
            'sistemPencatatan',
            'posisiPasar',
            'marketPositition',
            'strategiEmiten',
            'statusKantor',
            'levelKompetisi',
            'kemapuanManager',
            'kemapuanTeknis'));
    }

    public function edit_bisnis($id){
        $emiten = emiten::where('emitens.id',$id)->leftJoin('categories as ct', 'ct.id', '=', 'emitens.category_id')
        ->join('traders as t', 't.id', '=', 'emitens.trader_id')
        ->join('users as u', 'u.id', '=', 't.user_id')
        ->leftJoin('regencies as r', 'r.id', '=', 'emitens.regency_id')
        ->select('emitens.*', 'ct.category', 'u.email', 'r.name as kota')->first();
        $picture = explode(',',$emiten->pictures);
        if(empty($picture[0])){
            $picture[0] = '-';
        }else{
            $picture[0];
        }
        if(empty($picture[1])){
            $picture[1] = '-';
        }else{
            $picture[1];
        }
        if(empty($picture[2])){
            $picture[2] = '-';
        }else{
            $picture[2];
        }
        if(empty($picture[3])){
            $picture[3] = '-';
        }else{
            $picture[3];
        }
        if(empty($picture[4])){
            $picture[4] = '-';
        }else{
            $picture[4];
        }
        if(empty($picture[5])){
            $picture[5] = '-';
        }else{
            $picture[5];
        }
        if(empty($picture[6])){
            $picture[6] = '-';
        }else{
            $picture[6];
        }
        $badanUsaha = (object) [
            '1' => 'PT',
            '2' => 'CV',
            '3' => 'UD',
            '4' => 'Firma',
            '5' => 'Koperasi',
            '6' => 'Yang Lain'
        ];
        $sistemPencatatan = (object) [
            '1' => 'Terkomputerisasi/Software akuntansi',
            '2' => 'Catatan pembukuan sederhana/POS',
            '3' => 'Hanya berupa bukti dokumentasi',
            '4' => 'Tidak ada'
        ];
        $posisiPasar = (object) [
            '1' => 'Tidak memiliki pinjaman',
            '2' => 'Memiliki pinjaman lancar',
            '3' => 'Pernah bermasalah namun lunas',
            '4' => 'Sedang/pernah bermasalah dan belum lunas'
        ];
        $marketPositition = (object) [
            '1' => 'Pemimpin pasar lokal/nasional',
            '2' => 'Mampu bersaing di pasar lokal/nasional',
            '3' => 'Berusaha bersaing di pasar lokal/nasional',
            '4' => 'Tidak mampu bersaing di pasar'
        ];
        $strategiEmiten = (object) [
            '1' => 'Punya milestone jangka panjang owner & infrastruktur siap',
            '2' => 'Milestone sedang disusun owner & infrastruktur sedang diperkuat',
            '3' => 'Lebih menekankan strategi jangka pendek agar optimal',
            '4' => 'Strategi case by case/tentavie agar efektif'
        ];
        $statusKantor = (object) [
            '1' => 'Milik sendiri/sewa > 5 Tahun',
            '2' => 'Sewa > 2 s.d 5 Tahun',
            '3' => 'Sewa < 2 Tahun',
            '4' => 'Sewa Bulanan'
        ];
        $levelKompetisi = (object) [
            '1' => 'Mampu memenangkan persaingan',
            '2' => 'Mampu bersaing namun bukan pemimpin pasar',
            '3' => 'Berusaha bersaing namun bukan pemimpin pasar',
            '4' => 'Sedang/Pernah bermasalah dan belum lunas'
        ];
        $kemapuanManager = (object) [
            '1' => 'Mampu memenangkan persaingan',
            '2' => 'Mampu bersaing namun bukan pemimpin pasar',
            '3' => 'Berusaha bersaing namun bukan pemimpin pasar',
            '4' => 'Tidak mampu bersaing di pasar'
        ];
        $kemapuanTeknis = (object) [
            '1' => 'Owner/Manajemen ahli di bisnis ini',
            '2' => 'Owner/Manajemen baru dibisnis ini namun memiliki pengalaman bisnis yang sejenis',
            '3' => 'Owner/Manajemen belum pernah memiliki keahlian/pengalaman di bisnis ini dan sejenisnya namun telah memiliki pengalaman di sektor lain',
            '4' => 'Owner/Manajemen baru mulai berbisnis/belum ada track record'
        ];
        $kategori = kategori::where('is_deleted', 0)
        ->select('id', 'category')
        ->get();
        // $user = User::where('role_id',2)
        // ->limit(100)
        // ->get();
        // dd($s);
        return view('user.emiten.edit',compact('kategori','emiten','picture','badanUsaha',
        'sistemPencatatan',
        'posisiPasar',
        'marketPositition',
        'strategiEmiten',
        'statusKantor',
        'levelKompetisi',
        'kemapuanManager',
        'kemapuanTeknis'));
    }

    public function update(request $request,emiten $emiten,$id){
        $emiten = emiten::find($id);
        $picture = explode(',',$emiten->pictures);

        if(empty($picture[0])){
            $picture[0] = '-';
        }else{
            $picture[0];
        }
        if(empty($picture[1])){
            $picture[1] = '-';
        }else{
            $picture[1];
        }
        if(empty($picture[2])){
            $picture[2] = '-';
        }else{
            $picture[2];
        }
        if(empty($picture[3])){
            $picture[3] = '-';
        }else{
            $picture[3];
        }
        if(empty($picture[4])){
            $picture[4] = '-';
        }else{
            $picture[4];
        }
        if(empty($picture[5])){
            $picture[5] = '-';
        }else{
            $picture[5];
        }
        if(empty($picture[6])){
            $picture[6] = '-';
        }else{
            $picture[6];
        }

        $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
        $bucket = $storage->bucket($storageBucketName);
        $folderName = 'santara.co.id/token';

        if(!isset($request->thumbnail)){
            $logo = 'no-image.png';
        }else{
            $logo = $request->thumbnail;
        }
        if(!isset($request->banner)){
            $cover = 'no-image.png';
        }else{
            $cover = $request->banner;
        }
        if(!isset($request->galeri1)){
            $galeri = 'no-image.png';
        }else{
            $galeri = $request->galeri1;
        }
        if(!isset($request->galeri2)){
            $galeri2 = 'no-image.png';
        }else{
            $galeri2 = $request->galeri2;
        }
        if(!isset($request->galeri3)){
            $galeri3 = 'no-image.png';
        }else{
            $galeri3 = $request->galeri3;
        }
        if(!isset($request->owner)){
            $owner = 'no-image.png';
        }else{
            $owner = $request->owner;
        }

        $emiten->company_name = $request->get('company_name');
        $emiten->owner_name = $request->get('nama_owner');
        if(isset($request->kategori)){
            $emiten->category_id = $request->get('kategori');
        }
        if(isset($request->trader)){
            $emiten->trader_id = $request->get('trader');
        }
        $emiten->avg_annual_turnover_previous_year = str_replace(".", "", $request->get('omset1'));
        $emiten->avg_annual_turnover_current_year = str_replace(".", "", $request->get('omset2'));
        $emiten->avg_capital_needs = str_replace(".", "", $request->get('perkiraan_dana'));
        $emiten->avg_general_share_amount = str_replace(".", "", $request->get('saham_dilepas'));
        $emiten->avg_turnover_after_becoming_a_publisher= str_replace(".", "", $request->get('omset_penerbit'));
        $emiten->avg_annual_dividen= str_replace(".", "", $request->get('deviden_tahunan'));
        // $emiten->youtube= $request->get('video_profile');
        $emiten->youtube= str_replace("youtu.be/", "www.youtube.com/embed/", $request->get('video_profile'));
        $emiten->facebook= $request->get('fb');
        $emiten->website= $request->get('web');
        $emiten->instagram= $request->get('ig');
        $emiten->business_description= $request->get('deskripsi');
        $emiten->admin_desc= $request->get('bio_owner');
        $emiten->pictures = $logo.','.$cover.','.$owner.','.$galeri.','.$galeri2.','.$galeri3;
        //$emiten->pictures = $request->thumbnail.','.$request->banner.','.$request->owner.','.$request->galer1.','.$request->galer2.','.$request->galer3;
        $emiten->code_emiten = $request->get('code_emiten');
        $emiten->trademark = $request->get('brand');
        $emiten->price = str_replace(".", "", $request->get('harga_saham'));
        if(isset($request->regency_id)){
            $emiten->regency_id = $request->get('regency_id');
        }
        $emiten->business_entity = $request->business_entity;
        $emiten->address = $request->address;
        $emiten->business_lifespan = $request->business_lifespan;
        $emiten->branch_company = $request->branch_company;
        $emiten->employee = $request->employee;
        $emiten->capital_needs = $request->capital_needs;
        $emiten->monthly_turnover = $request->monthly_turnover;
        $emiten->monthly_profit = $request->monthly_profit;
        $emiten->monthly_turnover_previous_year = $request->monthly_turnover_previous_year;
        $emiten->monthly_profit_previous_year = $request->monthly_profit_previous_year;
        $emiten->total_bank_debt = $request->total_bank_debt;
        $emiten->bank_name_financing = $request->bank_name_financing;
        $emiten->total_paid_capital = $request->total_paid_capital;
        $emiten->financial_recording_system = $request->financial_recording_system;
        $emiten->bank_loan_reputation = $request->bank_loan_reputation;
        $emiten->market_position_for_the_product = $request->market_position_for_the_product;
        $emiten->strategy_emiten = $request->strategy_emiten;
        $emiten->office_status = $request->office_status;
        $emiten->level_of_business_competition = $request->level_of_business_competition;
        $emiten->managerial_ability = $request->managerial_ability;
        $emiten->dynamic_link = $request->dynamic_link;
        $emiten->period = $request->period;
        $emiten->technical_ability = $request->technical_ability;
        if($request->hasFile("prospektus")){
            $fileProspektus = fopen($request->file('prospektus')->getPathName(), 'r');
            $prospektusFileSave = 'prospektus'.time().'.pdf';
            $fileProspektus = $folderName.'/'.$prospektusFileSave;
            $bucket->upload($fileProspektus, [
                'predefinedAcl' => 'publicRead',
                'name' => $fileProspektus
            ]);
            $emiten->prospektus = $prospektusFileSave;
        }
        $emiten->save();
        $notif = array(
            'message' => 'Bisnis Berhasil Di Edit',
            'alert-type' => 'success'
        );
        // dd($logoFileSave);
        return redirect('/admin/emiten')->with($notif);
        // dd(str_replace(".", "", $request->get('omset2')));
    }

    public function update_bisnis(request $request,emiten $emiten,$id){
        $emiten = emiten::where('id',$id)->first();
        $picture = explode(',',$emiten->pictures);

        if(empty($picture[0])){
            $picture[0] = '-';
        }else{
            $picture[0];
        }
        if(empty($picture[1])){
            $picture[1] = '-';
        }else{
            $picture[1];
        }
        if(empty($picture[2])){
            $picture[2] = '-';
        }else{
            $picture[2];
        }
        if(empty($picture[3])){
            $picture[3] = '-';
        }else{
            $picture[3];
        }
        if(empty($picture[4])){
            $picture[4] = '-';
        }else{
            $picture[4];
        }
        if(empty($picture[5])){
            $picture[5] = '-';
        }else{
            $picture[5];
        }
        if(empty($picture[6])){
            $picture[6] = '-';
        }else{
            $picture[6];
        }

        if($request->hasFile('thumbnail')){
            $logoNameWithExt = $request->file('thumbnail')->getClientOriginalName() ;
            $logoFileName = pathinfo ($logoNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientoriginalExtension();
            $logoFileSave = 'thumbnail'.time().'.'.$extension;
            $path = $request->file('thumbnail')->storeAs('public/pictures',$logoFileSave) ;
        }else{
            $logoFileSave = $picture[0];
        }

        if($request->hasFile('banner')){
            $coverNameWithExt = $request->file('banner')->getClientOriginalName() ;
            $coverFileName = pathinfo ($coverNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('banner')->getClientoriginalExtension();
            $coverFileSave = 'banner'.time().'.'.$extension;
            $path = $request->file('banner')->storeAs('public/pictures',$coverFileSave) ;
        }else{
            $coverFileSave = $picture[1];
        }

        if($request->hasFile("owner")){
            $ownerNameWithExt = $request->file('owner')->getClientOriginalName() ;
            $ownerFileName = pathinfo ($ownerNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('owner')->getClientoriginalExtension();
            $ownerFileSave = 'owner'.time().'.'.$extension;
            $path = $request->file('owner')->storeAs('public/pictures',$ownerFileSave) ;
        }else{
            $ownerFileSave = $picture[2];
        }
        if($request->hasFile("galeri1")){
            $galeriNameWithExt = $request->file('galeri1')->getClientOriginalName() ;
            $galeriFileName = pathinfo ($galeriNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('galeri1')->getClientoriginalExtension();
            $galeriFileSave = 'galeri1'.time().'.'.$extension;
            $path = $request->file('galeri1')->storeAs('public/pictures',$galeriFileSave) ;
        }else{
            $galeriFileSave = $picture[3];
        }
        if($request->hasFile("galeri2")){
            $galeri2NameWithExt = $request->file('galeri2')->getClientOriginalName() ;
            $galeri2FileName = pathinfo ($galeri2NameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('galeri2')->getClientoriginalExtension();
            $galeri2FileSave = 'galeri2'.time().'.'.$extension;
            $path = $request->file('galeri2')->storeAs('public/pictures',$galeri2FileSave) ;
        }else{
            $galeri2FileSave = $picture[4];
        }
        if($request->hasFile("galeri3")){
            $galeri3NameWithExt = $request->file('galeri3')->getClientOriginalName() ;
            $galeri3FileName = pathinfo ($galeri3NameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('galeri3')->getClientoriginalExtension();
            $galeri3FileSave = 'galeri3'.time().'.'.$extension;
            $path = $request->file('galeri3')->storeAs('public/pictures',$galeri3FileSave) ;
        }else{
            $galeri3FileSave = $picture[4];
        }

        if($request->logo == null){
            $logo = 'default1.png';
        }else{
            $logo = str_replace('public/upload/','',$request->logo);
        }
        if($request->cover == null){
            $cover = 'default2.png';
        }else{
            $cover = str_replace('public/upload/','',$request->cover);
        }
        if($request->galeri == null){
            $galeri = 'default.png';
        }else{
            $galeri = str_replace('public/upload/','',$request->galeri);
        }
        if($request->galeri2 == null){
            $galeri2 = 'default.png';
        }else{
            $galeri2 = str_replace('public/upload/','',$request->galeri2);
        }
        if($request->galeri3 == null){
            $galeri3 = 'default.png';
        }else{
            $galeri3 = str_replace('public/upload/','',$request->galeri3);
        }
        if($request->owner == null){
            $owner = 'default1.png';
        }else{
            $owner = str_replace('public/upload/','',$request->owner);
        }

        $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
        $bucket = $storage->bucket($storageBucketName);
        $folderName = 'santara.co.id/token';

        $emiten->company_name = $request->get('company_name');
        $emiten->owner_name = $request->get('nama_owner');
        $emiten->category_id = $request->get('kategori');
        $emiten->avg_annual_turnover_previous_year = str_replace(".", "", $request->get('omset1'));
        $emiten->avg_annual_turnover_current_year = str_replace(".", "", $request->get('omset2'));
        $emiten->avg_capital_needs = str_replace(".", "", $request->get('perkiraan_dana'));
        $emiten->avg_general_share_amount = str_replace(".", "", $request->get('saham_dilepas'));
        $emiten->avg_turnover_after_becoming_a_publisher= str_replace(".", "", $request->get('omset_penerbit'));
        $emiten->avg_annual_dividen= str_replace(".", "", $request->get('deviden_tahunan'));
        // $emiten->youtube= $request->get('video_profile');
        $emiten->youtube= str_replace("youtu.be/", "www.youtube.com/embed/", $request->get('video_profile'));
        $emiten->facebook= $request->get('fb');
        $emiten->website= $request->get('web');
        $emiten->instagram= $request->get('ig');
        $emiten->business_description= $request->get('deskripsi');
        $emiten->admin_desc= $request->get('bio_owner');
        $emiten->pictures = $logo.','.$cover.','.$owner.','.$galeri.','.$galeri2.','.$galeri3;
        // $emiten->pictures = $logoFileSave.','.$coverFileSave.','.$ownerFileSave.','.$galeriFileSave.','.$galeri2FileSave.','.$galeri3FileSave;
        $emiten->code_emiten = $request->get('code_emiten');
        $emiten->trademark = $request->get('brand');
        $emiten->price = str_replace(".", "", $request->get('harga_saham'));
        if(isset($request->regency_id)){
            $emiten->regency_id = $request->get('regency_id');
        }
        $emiten->business_entity = $request->business_entity;
        $emiten->address = $request->address;
        $emiten->business_lifespan = $request->business_lifespan;
        $emiten->branch_company = $request->branch_company;
        $emiten->employee = $request->employee;
        $emiten->capital_needs = $request->capital_needs;
        $emiten->monthly_turnover = $request->monthly_turnover;
        $emiten->monthly_profit = $request->monthly_profit;
        $emiten->monthly_turnover_previous_year = $request->monthly_turnover_previous_year;
        $emiten->monthly_profit_previous_year = $request->monthly_profit_previous_year;
        $emiten->total_bank_debt = $request->total_bank_debt;
        $emiten->bank_name_financing = $request->bank_name_financing;
        $emiten->total_paid_capital = $request->total_paid_capital;
        $emiten->financial_recording_system = $request->financial_recording_system;
        $emiten->bank_loan_reputation = $request->bank_loan_reputation;
        $emiten->market_position_for_the_product = $request->market_position_for_the_product;
        $emiten->strategy_emiten = $request->strategy_emiten;
        $emiten->office_status = $request->office_status;
        $emiten->level_of_business_competition = $request->level_of_business_competition;
        $emiten->managerial_ability = $request->managerial_ability;
        $emiten->technical_ability = $request->technical_ability;
        if($request->hasFile("prospektus")){
            $fileProspektus = fopen($request->file('prospektus')->getPathName(), 'r');
            $prospektusFileSave = 'prospektus'.time().'.pdf';
            $fileProspektus = $folderName.'/'.$prospektusFileSave;
            $bucket->upload($fileProspektus, [
                'predefinedAcl' => 'publicRead',
                'name' => $fileProspektus
            ]);
            $emiten->prospektus = $prospektusFileSave;
        }
        $emiten->save();
        $notif = array(
            'message' => 'Bisnis Berhasil Di Edit',
            'alert-type' => 'success'
        );
        // dd($logoFileSave);
        return redirect('/user/bisnis_anda')->with($notif);
    }

    public function delete($id){
        $emiten = emiten::where('id',$id)->first();
        $emiten->is_deleted = 1;
        $emiten->save();
        $notif = array(
            'message' => 'Emiten Berhasil Di Hapus',
            'alert-type' => 'success'
        );
        return redirect('/admin/emiten')->with($notif);
    }

    public function emiten_status(Request $request,$id){

        DB::transaction(function() use ($request, $id) {
            $emj = new emiten_journey();
            $emj->emiten_id = $id;
            $emj->title = $request->get('title');
            $emj->date = $request->get('start_date');
            $emj->end_date = $request->get('end_date');
            $emj->save();

            $emiten = emiten::find($id);
            $emiten->begin_period = $request->get('start_date');
            $emiten->end_period = $request->get('end_date');
            $emiten->last_emiten_journey = $request->get('title');
            if($request->get('title') == 'Penawaran Saham'){
                $emiten->is_coming_soon = 0;
            }
            if($request->get('title') == 'Pra Penawaran Saham'){
                $emiten->is_active = 0;
            }else{
                $emiten->is_active = 1;
            }
            $emiten->save();

            $transactions = $emiten->transactions->where('is_verified', '=', 1)
                ->where('is_deleted', '=', 0)
                ->groupBy('trader_id');

            if ($request->get('title') == 'Pendanaan Terpenuhi') {
                $users = AuthHelper::getUserIdentitiesByGroup($transactions);

                $response = Http::withHeaders([
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                    "email" => AuthHelper::getEmail(),
                    "password" => AuthHelper::getPassword(),
                ])->post(env('SANTARA_CHAT_BASE_URL') . '/api/groups', [
                    "name" => $emiten->company_name,
                    "description" => $emiten->business_desc,
                    "group_type" => 1, //closed group
                    "privacy" => 2, //private group
                    "photo_url" => $emiten->pictures,
                    "users" => [1],
                    "emiten_id" => $emiten->id
                ])->json();

                if (!$response['success']) {
                    return redirect()->back()->with([
                       'message' => 'Error when creating group chat',
                       'alert-type' => 'danger'
                    ]);
                }
            }
        });

        $notif = array(
            'message' => 'Update Status Emiten Berhasil!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif);
    }
    public function logocropImg()
    {


            $data = $_POST['image'];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'thumbnail_' . time() . '.png';
            // file_put_contents($image_name, $data);

            $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
            $storage = new StorageClient([
                'keyFile' => json_decode($googleConfigFile, true)
            ]);
            $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
            $bucket = $storage->bucket($storageBucketName);
            $folderName = 'santara.co.id/token';
            $pictures = $folderName.'/'.$image_name;
            $bucket->upload($data, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);

            echo $image_name;
    }
    public function profilecropImg()
    {
          $data = $_POST['image'];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'profile_' . time() . '.png';
            // file_put_contents($image_name, $data);
            $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
            $storage = new StorageClient([
                'keyFile' => json_decode($googleConfigFile, true)
            ]);
            $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET2');
            $bucket = $storage->bucket($storageBucketName);
            $folderName = 'kyc';
            $pictures = $folderName.'/'.$image_name;
            $bucket->upload($data, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);
            echo $image_name;
    }
    public function galericropImg()
    {
          $data = $_POST['image'];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'galeri_' . time() . '.png';
            // file_put_contents($image_name, $data);
            $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
            $storage = new StorageClient([
                'keyFile' => json_decode($googleConfigFile, true)
            ]);
            $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
            $bucket = $storage->bucket($storageBucketName);
            $folderName = 'santara.co.id/token';
            $pictures = $folderName.'/'.$image_name;
            $bucket->upload($data, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);
            echo $image_name;
    }
    public function covercropImg()
    {
          $data = $_POST['image'];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'banner_' . time() . '.png';
            // file_put_contents($image_name, $data);
            $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
            $storage = new StorageClient([
                'keyFile' => json_decode($googleConfigFile, true)
            ]);
            $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
            $bucket = $storage->bucket($storageBucketName);
            $folderName = 'santara.co.id/token';
            $pictures = $folderName.'/'.$image_name;
            $bucket->upload($data, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);
            echo $image_name;
    }
    public function ownercropImg()
    {
          $data = $_POST['image'];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'owner_' . time() . '.png';
            // file_put_contents($image_name, $data);
            $googleConfigFile = file_get_contents(config_path('santara-cloud-1261a9724a56.json'));
            $storage = new StorageClient([
                'keyFile' => json_decode($googleConfigFile, true)
            ]);
            $storageBucketName = config('global.STORAGE_GOOGLE_BUCKET');
            $bucket = $storage->bucket($storageBucketName);
            $folderName = 'santara.co.id/token';
            $pictures = $folderName.'/'.$image_name;
            $bucket->upload($data, [
                'predefinedAcl' => 'publicRead',
                'name' => $pictures
            ]);
            echo $image_name;
    }

    public function index_user(){
        $emiten = emiten::where('emitens.is_deleted',0)
        ->select('emitens.*','categories.category as ktg','emiten_journeys.title as sts','emiten_journeys.date as sd', 'emiten_journeys.end_date as ed')
        ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        ->leftjoin('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
        ->whereRaw('emiten_journeys.created_at in (SELECT max(created_at) from emiten_journeys GROUP BY emiten_journeys.emiten_id)')
        ->get();

        return view('user.emiten.index',compact('emiten'));
    }

    public function user_emiten(){
        $emiten = emiten::where('emitens.is_deleted',0)
        ->select('emitens.*','emitens.uuid as euuid','categories.category as category','emiten_journeys.title as sts','emiten_journeys.date as sd', 'emiten_journeys.end_date as ed')
        ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        ->leftjoin('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
        ->where('emitens.trader_id',Auth::user()->trader->id)
        ->where('emitens.is_deleted',0)
                // ->where('emitens.is_active',0)
                    ->where('emitens.is_verified',1)
                    ->whereRaw('emiten_journeys.created_at in (SELECT max(created_at) from emiten_journeys GROUP BY emiten_journeys.emiten_id)')
        ->groupBy('emitens.id')
        ->get();
//  dd($emiten);
        // $data = null;
        $data['list'] = $emiten;
        // try {
        //     $client = new \GuzzleHttp\Client();

        //     $headers = [
        //         'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
        //         'Accept'        => 'application/json',
        //         'Content-type'  => 'application/json'
        //     ];

        //     $response = $client->request('GET', config('global.BASE_API_CLIENT_URL'). '/v3.7.1/finance-report/all-business/', [
        //         'headers' => $headers,
        //     ]);


        //     $data = json_decode($response->getBody()->getContents(), TRUE)['data'];
        //     // $data = null;
        //     // dd($data);
        // } catch (\Exception $exception) {
        //     $data = null;
        // }
        // $data = [];
        // foreach($emiten as $row){
        //     array_push($data, [
        //         'id' => $row->id,
        //         'company_name' => $row->company_name,
        //         'trademark' => $row->trademark,
        //         'code_emiten' => $row->code_emiten,
        //         'price' => $row->price,
        //         'supply' => $row->supply,
        //         'is_deleted' => $row->is_deleted,
        //         'is_active' => $row->is_active,
        //         'begin_period' => $row->begin_period,
        //         'created_at' => $row->created_at,
        //         'ktg' => $row->ktg,
        //     ]);
        // }


        return view('user.emiten.bisnis',compact('data'));
        // return $data;
        // dd($data['list']);

    }

    public function fetchEmiten(Request $request)
    {
        $emiten = emiten::where('is_deleted', 0)
            ->where('company_name', 'like', '%'.$request->search.'%')
            ->select('id', 'company_name')
            ->limit(5)
            ->get();
        return response()->json($emiten);
    }

    public function detail_bisnis($uuid){
        $reports = $this->getDataReport($uuid, 0, 12);
        $data = $this->getDataPlan($uuid);
        $last_report = $this->getLastReport($uuid);
        $emiten = emitenbyuuid($uuid);
        // if($emiten->supply == null || empty($emiten->supply)){
        //     $emiten->avg_general_share_amount = $emiten->supply;
        // }
        // $emiten->supply = 200;
        $tutorial = 0;
        $tersisa = ($emiten->supply - $emiten->terjual > 0) ? ($emiten->supply - $emiten->terjual) : 0;
        $terjual = ($emiten->terjual > $emiten->supply) ? $emiten->supply : $emiten->terjual;
        $terjual_percentage = ($terjual / $emiten->supply) * 100;
        $terjual_percentage = ($terjual_percentage >= 0) ? ($terjual_percentage > 100 ? 100 : $terjual_percentage) : 0;
        $progress = number_format($terjual_percentage, 2, '.', '.');

        $info  = (object)[
            "tersisa_percentage" => number_format($tersisa / $emiten->supply * 100, 2, ',', '.'),
            "tersisa_total"      => number_format($tersisa, 0, ',', '.'),
            "tersisa_total_rp"     => number_format($tersisa * $emiten->price, 0, ',', '.'),
            "terjual_percentage" => number_format($terjual_percentage, 2, ',', '.'),
            "terjual_total"      => number_format($terjual, 0, ',', '.'),
            "terjual_total_rp"     => number_format($terjual * $emiten->price, 0, ',', '.')
        ];

        $now              = new DateTime(); // or your date as well
        $finish           = new DateTime($emiten->end_period);
        $diff_now         = $finish->diff($now);
        $sisa_waktu     = "0 Hari";
        if ($now < $finish) {
            $format = ($diff_now->days > 0) ? "%a Hari" : "%h Jam %i Menit";
            $sisa_waktu     = $diff_now->format($format);
        }
        $type          = ($data != null) ? 'update' : 'create';
        // dd($reports);
        return view('user.emiten.detail',compact('emiten','progress','last_report','info','sisa_waktu','uuid','tutorial','data','type'));
    }

    private function getDataPlan($uuid)
    {
        // if (!$this->session->user) {
        //     redirect('user/login');
        // }

        $data = null;

        try {
            $client = new \GuzzleHttp\Client();

            $headers = [
                'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
                'Accept'        => 'application/json',
                'Content-type'  => 'application/json'
            ];

            $response = $client->request('GET', config('global.BASE_API_CLIENT_URL') . '/v3.7.1/finance-report/fund-plans/' . $uuid, [
                'headers' => $headers,
            ]);


            $data = json_decode($response->getBody()->getContents(), TRUE)['data'];
        } catch (\Exception $exception) {
            $data = null;
        }

        // echo json_encode(['data' => $data]);
        return $data;
    }

    private function getLastReport($uuid)
    {
        // if (!$this->session->user) {
        //     redirect('user/login');
        // }

        $data = null;

        try {
            $client = new \GuzzleHttp\Client();

            $headers = [
                'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
                'Accept'        => 'application/json',
                'Content-type'  => 'application/json'
            ];

            $response = $client->request('GET', config('global.BASE_API_CLIENT_URL'). '/v3.7.1/finance-report/last/' . $uuid, [
                'headers' => $headers,
            ]);


            $data = json_decode($response->getBody()->getContents(), TRUE)['data'];
        } catch (\Exception $exception) {
            $data = null;
        }

        return $data;
    }

    private function getDataReport($uuid, $limit, $offset)
    {
        // if (!$this->session->user) {
        //     redirect('user/login');
        // }

        $data = null;
        $limit = $limit + 1;

        try {
            $client = new \GuzzleHttp\Client();

            $headers = [
                'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
                'Accept'        => 'application/json',
                'Content-type'  => 'application/json'
            ];

            $response = $client->request('GET', config('global.BASE_API_CLIENT_URL') . '/v3.7.1/finance-report/list/' . $uuid . '?limit=' . $limit . '&offset=' . $offset . '', [
                'headers' => $headers,
            ]);

            $data = json_decode($response->getBody()->getContents(), TRUE)['data'];
        } catch (\Exception $exception) {
            $data = null;
        }

        return $data;
    }

    public function get_riwayat_laporan_keuangan(Request $request,$uuid)
    {
        // if (!$this->session->user) {
        //     redirect('user/login');
        // }

        $trademark = $request->get("trademark");
        // $this->load->helper('month');

        $draw   = intval($request->get("draw"));
        $start  = intval($request->get("start"));
        $length = intval($request->get("length"));

        // $this->load->model('Deposit_model');
        $filter = $request->get("filter");
        $reports = $this->getDataReport($uuid, $start, $length);

        $data = [];
        $no   = 1;
        foreach ($reports['data'] as $report) {

            $action = '';

            if ((($report['status'] != 'update data')  || (($report['status'] == 'update data') && ($report['last_status'] == 'rejected')))) {
                $action .=  '<a href="' . $report['finance_report'] . ' " class="btn btn-santara-red btn-sm btn-block" title="Lihat" >Lihat</a>';
            }

            if ($report['editable'] == 1 && $report['status'] != 'verifying') :
                $action .=
                    '<a href="'.url("user/laporan-keuangan/detail"). '/' . $uuid . '/' . $report['id'] . '" type="button" class="btn btn-sm btn-santara-white btn-block">
                    <span class="menu-title" data-i18n="">Edit</span>
                </a>
                <button type="button" onclick="return deleteReport(\'' . $report['id'] . '\', \'' . $uuid . '\')" class="btn btn-sm btn-santara-white btn-block">
                    <span class="menu-title" data-i18n="">Hapus</span>
                </button>';
            endif;

            if ($report['status'] == 'rejected') {
                $status = '<a href="#" title="deskripsi" onclick="showDesc(\'' . $report['last_status_desc'] . '\')">Ditolak</a>';
            } elseif ($report['status'] == 'verifying') {
                $status = 'Menunggu Verifikasi';
            } elseif ($report['status'] == 'verified') {
                $status = 'Terverifikasi';
            } elseif ($report['status'] == 'update data') {
                if ($report['last_status'] == 'rejected') {
                    $status = '<a href="#" title="deskripsi" onclick="showDesc(\'' . $report['last_status_desc'] . '\')">Ditolak</a>';
                } else {
                    $status = 'Perbaharui Data';
                }
            } else {
                $status = '-';
            }

            array_push($data, [
                $no++,
                $report['id'],
                $report['version'],
                $report['periode'],
                $status,
                $action
            ]);
        }

        $output = [
            "draw"            => $draw,
            "recordsTotal"    => Deposit::count(),
            "recordsFiltered" => count($data),
            "data"            => $data
        ];
        echo json_encode($output);
        exit();
        // echo $trademark;
    }

    public function savePlan(Request $request,$type)
    {
        // if (!$this->session->user) {
        //     redirect('user/login');
        // }

        // $data = array('emiten_uuid' => $request->emiten_uuid,'list_fund_plans' => $request->list_fund_plans);
        $data = array_merge($request->all(), ['index' => 'value']);
        // $data = array('0');

        $data['emiten_uuid'] = strip_tags($data['emiten_uuid']);
        $list_fund_plans = array_values((array)json_decode(json_encode($data['list_fund_plans'])));
        foreach ($list_fund_plans as $key => $value) {
            $value->name        = strip_tags($value->name);
            $value->subtotal    = str_replace(".", "", strip_tags($value->subtotal));
            $value->desc        = (isset($value->desc)) ? strip_tags($value->desc) : '';
            $value->sublist     = array_values((array)$value->sublist);
            foreach ($value->sublist as $v) {
                $v->amount = str_replace(".", "", strip_tags($v->amount));
            }
        }

        $data['list_fund_plans'] = $list_fund_plans;

        $method = 'POST';
        $url = '/v3.7.1/finance-report/fund-plans/';
        if ($type == 'update') {
            $method = 'PUT';
            $url = '/v3.7.1/finance-report/fund-plans/' . $data['emiten_uuid'];
        }

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request($method, config('global.BASE_API_CLIENT_URL') . $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . app('request')->session()->get('token')
                ],
                'json' => $data
            ]);

            echo json_encode(['msg' => $response->getStatusCode()]);
            return;
        } catch (\Exception $exception) {
            $response = $exception->getResponse();
            $responseBody = $response->getBody()->getContents();
            $body = json_decode($responseBody, true);
            echo json_encode(['msg' => $body['message']]);
            return;
        }
    }
}
