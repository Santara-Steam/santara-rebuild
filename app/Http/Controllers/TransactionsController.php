<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\User;
use DB;

class TransactionsController extends Controller
{
    
    public function index()
    {
        return view('admin.transactions.index');
    }

    public function fetchData(Request $request)
    {
        if($request->filter != ""){
            $transactions = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->where('tr.is_deleted', 0)
                ->where('tr.last_status', $request->filter)
                ->select('tr.id', 'tr.uuid', 't.name as trader_name', 'users.email as user_email', 
                    't.id as trader_id', 'e.code_emiten', DB::raw('CONCAT("SAN","-", tr.id, "-", e.code_emiten) as transaction_serial'), 
                    'tr.channel', 'tr.description', 'tr.is_verified', 'tr.split_fee', 'tr.created_at as created_at', 
                    'tr.amount', 'tr.fee', 'e.price', DB::raw('(tr.amount/e.price) as qty'), 
                    'tr.last_status as status')
                ->get();
        }else{
            $transactions = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->where('tr.is_deleted', 0)
                ->select('tr.id', 'tr.uuid', 't.name as trader_name', 'users.email as user_email', 
                    't.id as trader_id', 'e.code_emiten', DB::raw('CONCAT("SAN","-", tr.id, "-", e.code_emiten) as transaction_serial'), 
                    'tr.channel', 'tr.description', 'tr.is_verified', 'tr.split_fee', 'tr.created_at as created_at', 
                    'tr.amount', 'tr.fee', 'e.price', DB::raw('(tr.amount/e.price) as qty'), 
                    'tr.last_status as status')
                ->get();
        }
       
        $data = [];
        foreach($transactions as $row){
            $class_action = "btn btn-outline-info btn-sm";
			$text_action  = "Detail";

            if ($row->status == 'CREATED') :
				$status = '<div class="status badge badge-secondary badge-sm" style="display:block">Belum Konfirmasi</div>';
				$status_transaction = 1;
			elseif ($row->status == 'WAITING FOR VERIFICATION') :
				$status = '<div class="status badge badge-warning badge-sm" style="display:block">Menunggu Konfirmasi</div>';
				$status_transaction = 2;

				// confirm button
				$class_action = "btn btn-info btn-sm";
				$text_action = "Konfirmasi";
			elseif ($row->status == 'VERIFIED') :
				$status = '<div class="status badge badge-success badge-sm" style="display:block">Lunas</div>';
				$status_transaction = 3;
			elseif ($row->status == 'EXPIRED') :
				$status = '<div class="status badge badge-danger badge-sm" style="display:block">Kadaluarsa</div>';
				$status_transaction = 4;
			else :
				$status = '<div class="status badge badge-secondary badge-sm" style="display:block">Belum Konfirmasi</div>';
				$status_transaction = 5;
			endif;

            array_push($data, [
                "id" => $row->id,
                "uuid" => $row->uuid,
                "transaction_serial" => $row->transaction_serial,
                "trader_name" => $row->trader_name,
                "user_email" => $row->user_email,
                "code_emiten" => $row->code_emiten,
                "channel" => $row->channel == "VA" ? "Virtual Account" : $row->channel == "BANKTRANSFER" ? "Transfer Bank" : 
                        $row->channel == "WALLET" ? "Saldo Dompet" : $row->channel == "DANA" ? "DATA" : 
                        $row->channel == "MARKET" ? "MARKET " : " - ".$row->description,
                "amount" => rupiah($row->amount),
                "created_at" => formatHariJam($row->created_at),
                "split_fee" => rupiah($row->split_fee),
                "status" => $status,
                "link" => '<a href="#" class="'.$class_action.'">'.$text_action.'</a>'
            ]);
        }
        return response()->json(["data" => $data]);
    }

}
