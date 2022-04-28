<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\emiten;
use App\Models\Category;
use App\Models\Regency;
use App\Models\EmitenStatusHistori;

class PralistingController extends Controller
{

    public function index()
    {
        return view('admin.pralisting.index');
    }
    
    public function fetchData(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $filter = $request->get('filter');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; 
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir']; 
        $searchValue = $search_arr['value'];

        $totalRecords = emiten::join('traders as t', 't.id', '=', 'emitens.trader_id')
            ->where('emitens.is_deleted', 0)
            ->where('emitens.is_active', 0)
            ->select('emitens.id', 'emitens.uuid','emitens.company_name', 'emitens.trademark',
                'emitens.capital_needs', 'emitens.is_verified', 'emitens.created_at', 't.name',
                't.phone')
            ->groupBy('emitens.id')
            ->count();
        $totalRecordswithFilter = emiten::join('traders as t', 't.id', '=', 'emitens.trader_id')
            ->where('emitens.is_deleted', 0)
            ->where('emitens.is_active', 0)
            ->where('emitens.company_name', 'like', '%' .$searchValue . '%')
            ->select('emitens.id', 'emitens.uuid','emitens.company_name', 'emitens.trademark',
                'emitens.capital_needs', 'emitens.is_verified', 'emitens.created_at', 't.name',
                't.phone')
            ->groupBy('emitens.id')
            ->count();
          
        $pralisting = emiten::join('traders as t', 't.id', '=', 'emitens.trader_id')
            ->where('emitens.is_deleted', 0)
            ->where('emitens.is_active', 0)
            ->where('emitens.company_name', 'like', '%' .$searchValue . '%')
            ->select('emitens.id', 'emitens.uuid','emitens.company_name', 'emitens.trademark',
                'emitens.capital_needs', 'emitens.is_verified', 'emitens.created_at', 't.name',
                't.phone')
            ->skip($start)
            ->take($rowperpage)
            ->groupBy('emitens.id')
            ->orderBy('emitens.created_at', 'DESC')
            ->get();

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

            $action = '<a href="' . url('admin/pralisting/konfirmasi/' . $row->uuid) . '" class="btn btn-info btn-sm btn-block" title="konfirmasi">Detail</a> ';
            $action .= '<a href="#" onClick="deleteBisnis(\'' . $row->uuid . '\',\'' . $row->trademark . '\')"  class="btn btn-danger btn-sm btn-block" title="Hapus">Hapus</a>';
            
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
                'total_coments' => $totalComents[0]->total_coments,
                'aksi' => $action
            ]);
        }
        return response()->json(["data" => $data]);
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

}
