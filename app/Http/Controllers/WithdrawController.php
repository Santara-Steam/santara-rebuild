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
        if($request->filter != ""){
            $withdraws = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->where('withdraws.is_deleted', 0)
                ->where('withdraws.is_verified', $request->filter)
                ->orderBy('withdraws.id', 'DESC')
                ->select('withdraws.uuid', 't.uuid as trader_uuid', 'withdraws.id', 
                    'withdraws.is_verified', 'withdraws.account_name','withdraws.account_number', 
                    'withdraws.bank_to', 'withdraws.amount', 'withdraws.fee', 'withdraws.created_at', 
                    'withdraws.updated_at', 't.id as trader_id', 't.name as trader_name', 't.phone', 'u.email', 
                    'withdraws.split_fee')
                ->get();
        }else{
            $withdraws = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->where('withdraws.is_deleted', 0)
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

            $updated_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at))).' '.formatJam($row->updated_at);
            
            array_push($data, [
                "trader_name" => $row->trader_name,
                "email" =>$row->email,
                "amount" => rupiah($row->amount),
                "fee" => rupiah($row->fee),
                "bank_to" => $row->bank_to,
                "updated_at" => $updated_at,
                "split_fee" => rupiah($row->split_fee),
                "status" => $status
            ]);
        }
        return response()->json(["data" => $data]);
    }

}