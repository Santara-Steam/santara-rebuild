<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\emiten;
use App\Models\Category;
use App\Models\Regency;
use App\Models\EmitenStatusHistori;
use App\Exports\CalonPenerbit;
use Maatwebsite\Excel\Facades\Excel;

class PralistingController extends Controller
{

    public function index()
    {
        $pralisting = $this->getDataPralisting();

        $data = [];
        foreach($pralisting as $row){
            $status = \DB::table('emiten_status_histories')->where('emiten_id', $row->id)
                ->select('status')->orderBy('id', 'DESC')->limit(1)
                ->first();

            $investment = \DB::table('emiten_pre_investment_plans')->where('emiten_id', $row->id)
                ->where('is_deleted', 0)
                ->select(\DB::raw('COALESCE(SUM(amount),0) as investment'))
                ->first();

            $total_likes = \DB::table('emiten_votes')->where('likes', 1)
                ->where('emiten_id', $row->id)
                ->where('is_deleted', 0)
                ->select(\DB::raw('COUNT(likes) as total_likes'))
                ->first();

            $total_votes = \DB::table('emiten_votes')->where('vote', 1)
                ->where('emiten_id', $row->id)
                ->where('is_deleted', 0)
                ->select(\DB::raw('COUNT(vote) as total_votes'))
                ->first();

            $totalComents = \DB::select('(SELECT COALESCE(COUNT(comment), 0) + COALESCE(COUNT(ch.comment_histories), 0) as total_coments from emiten_comments left join (select emiten_comment_id, COUNT(comment) as comment_histories from emiten_comment_histories where is_deleted = 0 group by id) as ch on emiten_comments.id = ch.emiten_comment_id where emiten_comments.emiten_id = '.$row->id.' and emiten_comments.is_deleted = 0)');

            array_push($data, [
                "id" => $row->id,
                'company_name' => $row->company_name,
                'trademark' => $row->trademark,
                'capital_needs' => rupiah($row->capital_needs),
                'is_verified' => $row->is_verified,
                'created_at' => tgl_indo(date('Y-m-d', strtotime($row->created_at))),
                'trader_name' => $row->name,
                'phone' => $row->phone,
                "status" => $status != null ? $status->status : '',
                'investment' => rupiah($investment->investment),
                'total_likes' => $total_likes->total_likes,
                'total_votes' => $total_votes->total_votes,
                'total_coments' => $totalComents[0]->total_coments
            ]);
        }
        return view('admin.pralisting.index', compact('data'));
    }

    public function indexKycBisnis()
    {
        $pralisting = $this->getDataPralisting();

        $data = [];
        foreach($pralisting as $row){
            $status = \DB::table('emiten_status_histories')->where('emiten_id', $row->id)
                ->select('status')->orderBy('id', 'DESC')->limit(1)
                ->first();

            $investment = \DB::table('emiten_pre_investment_plans')->where('emiten_id', $row->id)
                ->where('is_deleted', 0)
                ->select(\DB::raw('COALESCE(SUM(amount),0) as investment'))
                ->first();

            $total_likes = \DB::table('emiten_votes')->where('likes', 1)
                ->where('emiten_id', $row->id)
                ->where('is_deleted', 0)
                ->select(\DB::raw('COUNT(likes) as total_likes'))
                ->first();

            $total_votes = \DB::table('emiten_votes')->where('vote', 1)
                ->where('emiten_id', $row->id)
                ->where('is_deleted', 0)
                ->select(\DB::raw('COUNT(vote) as total_votes'))
                ->first();
            
            $statusVerifikasi = "";
            if($row->is_verified_bisnis == 1){
                $statusVerifikasi = "Terverifikasi";
            }else if($row->is_verified_bisnis == 2){
                $statusVerifikasi = "Ditolak";
            }else if($row->is_verified_bisnis == null){
                $statusVerifikasi = "";
            }

            $totalComents = \DB::select('(SELECT COALESCE(COUNT(comment), 0) + COALESCE(COUNT(ch.comment_histories), 0) as total_coments from emiten_comments left join (select emiten_comment_id, COUNT(comment) as comment_histories from emiten_comment_histories where is_deleted = 0 group by id) as ch on emiten_comments.id = ch.emiten_comment_id where emiten_comments.emiten_id = '.$row->id.' and emiten_comments.is_deleted = 0)');

            $action = '<a href="' . url('admin/pralisting/konfirmasi/' . $row->uuid) . '" class="btn btn-info btn-sm btn-block" title="konfirmasi">Detail</a> ';
            $action .= '<a href="#" onClick="deleteBisnis(\'' . $row->uuid . '\',\'' . $row->trademark . '\')"  class="btn btn-danger btn-sm btn-block" title="Hapus">Hapus</a>';
            $action .= '<a class="btn btn-info-ghost btn-sm btn-block" href="'.url('admin/kyc/konfirmasi/'.$row->trader_uuid).'">Konfirmasi</a>';
            
            array_push($data, [
                "id" => $row->id,
                'company_name' => $row->company_name,
                'trademark' => $row->trademark,
                'capital_needs' => rupiah($row->capital_needs),
                'is_verified' => $status,
                'created_at' => tgl_indo(date('Y-m-d', strtotime($row->created_at))),
                'trader_name' => $row->name,
                'phone' => $row->phone,
                "status" => $statusVerifikasi,
                'investment' => rupiah($investment->investment),
                'total_likes' => $total_likes->total_likes,
                'total_votes' => $total_votes->total_votes,
                'total_coments' => $totalComents[0]->total_coments,
                'aksi' => $action
            ]);
        }
        return view('admin.pralisting.kyc-bisnis', compact('data'));
    }

    public function exportCalonPenerbit()
    {
        return Excel::download(new CalonPenerbit(), 'Data Calon Penerbit.xlsx');
    }

    public function flagNowPlaying()
    {
        $pralisting = $this->getDataPralisting();
        $emiten = [];
        foreach($pralisting as $row){
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
                'ktg' => $row['ktg']
            ]);
        }
        return view('admin.pralisting.flag-now-playing', compact('emiten'));
    }

    public function getDataPralisting()
    {
        $pralisting = emiten::leftjoin('categories', 'categories.id','=','emitens.category_id')
                ->leftjoin('emiten_votes as ev','ev.emiten_id','=','emitens.id')
                ->leftjoin('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
                ->leftjoin('traders as t', 't.id', '=', 'emitens.trader_id')
                ->select('emitens.id', 'emitens.uuid', 'emitens.company_name', 'emitens.trademark', 'emitens.code_emiten', 'emitens.price',
                    'emitens.supply', 'emitens.is_deleted', 'emitens.is_active', 'emitens.begin_period', 'emitens.created_at',
                    'categories.category as ktg','emitens.begin_period as sd', 'emitens.end_period as ed', 'emitens.capital_needs', 'emitens.is_verified',
                    't.name', 't.phone', 'emitens.is_verified_bisnis', 't.uuid as trader_uuid', 't.name as nama_trader')
                ->where('emitens.is_deleted',0)
                ->where('emitens.is_verified',1)
                ->where('emitens.is_pralisting',1)
                ->where('emitens.is_coming_soon',1)
                ->groupBy('emitens.id')
                ->orderby('emitens.created_at','DESC')
                ->get();
        return $pralisting;
    }

    public function verifiedEmitenBisnis(Request $request)
    {
        $uuid = $request->uuid;
        $status = $request->status;

        $bisnis = emiten::where('uuid', $uuid)->update([
            'is_verified_bisnis' => $status,
        ]);

        if($bisnis){
            echo json_encode(['msg' => '200']);
        }else{
            echo json_encode(['msg' => '404']);
        }
    }


    public function konfirmasi($uuid)
    {
        $emiten = emiten::where('uuid', $uuid)
            ->first();
        $category = Category::find($emiten->category_id);
        $subcategory = \DB::table('sub_categories')->where('id', $emiten->sub_category_id)->first();
        $regency = Regency::find($emiten->regency_id);
        $emiten->category = $category != null ? $category->category : "";
        $emiten->subcategory = $subcategory != null ? $subcategory->sub_category : "";
        $emiten->regency = $regency != null ? $regency->name : "";
        $emiten->pictures = explode(',', $emiten->pictures);
        $type = "konfirmasi";
        return view('admin.pralisting.konfirmasi', compact('emiten', 'type'));
    }

    public function acceptPralisting(Request $request)
    {
        $uuid = $request->uuid;
        $status = $request->status;
        emiten::where('uuid', $uuid)->update([
            'is_verified' => $status
        ]);

        if($status == 1){
            $status = 'verified';
        }elseif($status == 2){
            $status = 'rejected';
        }else{
            $status = 'waiting for verification';
        }
        $emiten = emiten::where('uuid', $uuid)->first();
        $emitenStatusHistori = new EmitenStatusHistori();
        $emitenStatusHistori->uuid = \Str::uuid();
        $emitenStatusHistori->emiten_id = $emiten->id;
        $emitenStatusHistori->status = $status;
        $emitenStatusHistori->save();


        if ($status == 2) {
            $input = $request->input;
            $user = emiten::join('traders as t', 'emitens.trader_id', '=', 't.id')
                    ->join('users as u', 't.user_id', '=', 'u.id')
                    ->where('emitens.uuid', $uuid)
                    ->select('emitens.id', 'emitens.company_name', 
                        'emitens.trademark', 't.name', 'u.email' )->first();
            $details = [
                'name' => $user->name,
                'trademark' => $user->trademark,
                'reason' => $input
            ];
                        
            $kirimEmail = \Mail::to($user->email)->send(new \App\Mail\RejectPenerbit($details));
            if($kirimEmail){
                echo json_encode(['msg' => 200, "emiten" => $emiten->id]);
            }else{
                echo json_encode(['msg' => 404, "det" => "Gagal Kirim Email"]);
            }
        }else {
            echo json_encode(['msg' => 200, "emiten" => $emiten->id]);
        }
        
    }

    public function acceptpOffice(Request $request)
    {
        $uuid = $request->uuid;
        $status = $request->status;

        $bisnis = emiten::where('uuid', $uuid)->update([
            'is_verified' => 0,
            'is_pralisting' => 0
        ]);

        if($bisnis){
            $this->notification($uuid);
            echo json_encode(['msg' => '200']);
        }else{
            echo json_encode(['msg' => '404']);
        }
    }

    public function notification($uuid) {
        $return = false;
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Authorization' => 'Bearer ' . app('request')->session()->get('token'),        
            'Accept'        => 'application/json',
            'Content-type'  => 'application/json'
        ];  
        $endpoint = '/emitens/new-emiten-notification/';

        try {        
            $response = $client->request('GET',  config('global.BASE_API_CLIENT_URL').'/'.config('global.API_CLIENT_VERSION') . $endpoint . $uuid, [
                'headers' => $headers,
            ]);

            if ( $response->getStatusCode() == 200 ) {
                $return = true;
            }

        } catch (\Exception $exception) {
            $return = false;
        }

        return $return;
	}

    public function delete($uuid)
    {
        $emiten = emiten::where('uuid', $uuid)
            ->select('trader_id')
            ->first();
        if ($emiten->trader_id == null) {
            echo json_encode(['msg' => '400']);
            return;
        }
        $delete = emiten::where('uuid', $uuid)->update([
                'is_deleted' => 1
            ]);
        if ($delete) {
            echo json_encode(['msg' => '200']);
        } else {
            echo json_encode(['msg' => '400']);
        }
    }

}
