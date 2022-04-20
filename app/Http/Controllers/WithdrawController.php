<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraw;

class WithdrawController extends Controller
{

    public function index()
    {
        return view('admin.withdraw.index');
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

        if($request->filter != ""){
            $totalRecords = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->where('withdraws.is_deleted', 0)
                ->where('withdraws.is_verified', $request->filter)
                ->orderBy('withdraws.id', 'DESC')
                ->select('count(*) as allcount')
                ->count();
            $totalRecordswithFilter = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->where('withdraws.is_deleted', 0)
                ->where('withdraws.is_verified', $request->filter)
                ->where('withdraws.account_name', 'like', '%' .$searchValue . '%')
                ->orderBy('withdraws.id', 'DESC')
                ->count();

            $withdraws = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->where('withdraws.is_deleted', 0)
                ->where('withdraws.is_verified', $request->filter)
                ->skip($start)
                ->take($rowperpage)
                ->orderBy('withdraws.id', 'DESC')
                ->select('withdraws.uuid', 't.uuid as trader_uuid', 'withdraws.id', 
                    'withdraws.is_verified', 'withdraws.account_name','withdraws.account_number', 
                    'withdraws.bank_to', 'withdraws.amount', 'withdraws.fee', 'withdraws.created_at', 
                    'withdraws.updated_at', 't.id as trader_id', 't.name as trader_name', 't.phone', 'u.email', 
                    'withdraws.split_fee')
                ->get();
        }else{
            $totalRecords = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->where('withdraws.is_deleted', 0)
                ->orderBy('withdraws.id', 'DESC')
                ->select('count(*) as allcount')
                ->count();
            $totalRecordswithFilter = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->where('withdraws.is_deleted', 0)
                ->where('withdraws.account_name', 'like', '%' .$searchValue . '%')
                ->orderBy('withdraws.id', 'DESC')
                ->count();
            $withdraws = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->where('withdraws.is_deleted', 0)
                ->skip($start)
                ->take($rowperpage)
                ->orderBy('withdraws.id', 'DESC')
                ->select('withdraws.uuid', 't.uuid as trader_uuid', 'withdraws.id', 
                    'withdraws.is_verified', 'withdraws.account_name','withdraws.account_number', 
                    'withdraws.bank_to', 'withdraws.amount', 'withdraws.fee', 'withdraws.created_at', 
                    'withdraws.updated_at', 't.id as trader_id', 't.name as trader_name', 't.phone', 'u.email', 
                    'withdraws.split_fee')
                ->get();
        }

        $data = [];
        foreach($withdraws as $row){
            $totalWithdraw = rupiah(($row->amount - $row->fee));
            // saldo Available didapat dari proses fetch api, itu menyusul
            // $saldoAvailable = rupiah($this->get_saldo($withdraw->trader_uuid), 2, ',', '.');
            $member = '<div class="row"><div class="col-5">Nama :</div><div class="col-7">'.$row->trader_name
                .'</div></div><div class="row"><div class="col-5">Email :</div><div class="col-7">'
                .$row->email.'</div></div><div class="row"><div class="col-5">HP :</div><div class="col-7">'.$row->phone.'</div></div><div class="row"><div class="col-5">Bank to:</div><div class="col-7">'
                .$row->bank_to.'</div></div>';
            $date = '<div class="row"><div class="col-5">Date :</div><div class="col-7">'.tgl_indo(date('Y-m-d', strtotime($row->created_at)))
                .'</div></div><div class="row"><div class="col-5">Time :</div><div class="col-7">'.formatJam($row->created_at).'</div></div>';
            $amount = '<div class="row"><div class="col-5">Withdrawal :</div><div class="col-7">'.rupiah($row->amount).'</div></div><div class="row"><div class="col-5">Fee :</div><div class="col-7">'
                .rupiah($row->fee).'</div></div><div class="row"><div class="col-5">Total :</div><div class="col-7">'.(rupiah($row->amount - $row->fee)).'</div></div>';
            $saldoAvailable = "";
            if($row->is_verified == 0 || $row->is_verified == null){
                $status = '<a href="#" onClick="confirmWithdraw(\''.$row->uuid.'\',
                            \''.$row->account_name.'\',
                            \''.$row->account_number.'\',
                            \''.$row->bank_to.'\',                                                                    
                            \''.$totalWithdraw.'\',
                            \''.$saldoAvailable.'\')"  class="btn btn-info btn-sm btn-block" title="Verifikasi" >Verifikasi</a> 
                    <a href="#" onClick="rejectWithdraw(\'' . $row->uuid . '\')" class="btn btn-danger btn-sm btn-block" title="Tolak" >Tolak</a>';
            }elseif($row->is_verified == 2){
                $status = '<div class="status badge badge-danger badge-pill badge-sm" style="display:block">Ditolak</div>';
            }elseif($row->is_verified == 1) {
                $status = '<div class="status badge badge-success badge-pill badge-sm" style="display:block">Sudah Verifikasi</div>';
            }else{
                $status = '<div class="status badge badge-warning badge-pill badge-sm" style="display:block">Tidak Diketahui</div>';
            }

            $created_at = tgl_indo(date('Y-m-d', strtotime($row->created_at))).' '.formatJam($row->created_at);
            
            array_push($data, [
                "member" => $member,
                "date" => $date,
                "amount" => $amount,
                "split_fee" => rupiah($row->split_fee),
                "status" => $status
            ]);
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data
        );
    
        echo json_encode($response);
        exit;
    }

    

}