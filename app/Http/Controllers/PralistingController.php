<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\emiten;

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

            $action = '<a href="' . url('user/pralisting/konfirmasi/' . $row->uuid) . '" class="btn btn-info btn-sm btn-block" title="konfirmasi">Detail</a> ';
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

}
