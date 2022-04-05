<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Markets;
use DB;

class TransactionsController extends Controller
{
    
    public function index()
    {
        return view('admin.transactions.index');
    }

    public function detail($uuid, $status_transaction)
    {
        $transaction = User::join('traders as t', 't.user_id', '=', 'users.id')
            ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
            ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
            ->where('tr.is_deleted', 0)
            ->select('tr.id', 'tr.uuid', 'tr.created_at as created_at', 'tr.fee', 'tr.channel', 
                'users.email', 't.phone', 't.name', 
                'tr.amount', 'tr.is_verified', 'e.company_name', 
                'e.price', 'e.code_emiten', DB::raw('(tr.amount/e.price) as qty'))
            ->where('tr.uuid', $uuid)
            ->first();
        
        $channel = "";
        $stock = 0;
        $stock_price = 0;
        if($transaction->channel == 'VA'){
            $channel = 'Virtual Account';
        }else if($transaction->channel == 'BANKTRANSFER'){
            $channel = 'Transfer Bank';
        }else if($transaction->channel == 'WALLET'){
            $channel = 'Saldo Dompet';
        }else if($transaction->channel == 'DANA'){
            $channel = 'DANA';
        }else if($transaction->channel == 'MARKET'){
            $market = Markets::where('transaction_id', $transaction->id)
                ->select('stock', 'stock_price')
                ->first();
            $stock = $market->stock;
            $stock_price = $market->stock_price;
            $channel = 'MARKET';
        }
        return view('admin.transactions.detail', compact('transaction', 'channel', 'stock', 'stock_price', 'status_transaction'));
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

            if($row->status == 'CREATED'){
                $status = '<div class="status badge badge-secondary badge-sm" style="display:block">Belum Konfirmasi</div>';
				$status_transaction = 1;
            }elseif($row->status == 'WAITING FOR VERIFICATION'){
				$status = '<div class="status badge badge-warning badge-sm" style="display:block">Menunggu Konfirmasi</div>';
				$status_transaction = 2;
				// confirm button
				$class_action = "btn btn-info btn-sm";
				$text_action = "Konfirmasi";
            }elseif ($row->status == 'VERIFIED') {
                $status = '<div class="status badge badge-success badge-sm" style="display:block">Lunas</div>';
				$status_transaction = 3;
            }elseif ($row->status == 'EXPIRED'){
				$status = '<div class="status badge badge-danger badge-sm" style="display:block">Kadaluarsa</div>';
				$status_transaction = 4;
            }else{
				$status = '<div class="status badge badge-secondary badge-sm" style="display:block">Belum Konfirmasi</div>';
				$status_transaction = 5;
            }

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
                "created_at" => tgl_indo(date('Y-m-d', strtotime($row->created_at))).' '.formatJam($row->created_at),
                "split_fee" => rupiah($row->split_fee),
                "status" => $status,
                "link" => '<a href="'.url('/admin/transaction/detail/'.$row->uuid.'/'.$status_transaction).'" class="'.$class_action.'">'.$text_action.'</a>'
            ]);
        }
        return response()->json(["data" => $data]);
    }

<<<<<<< HEAD
}
=======
    public function index_user()
    {
        return view('user.transactions.index');
    }

}
>>>>>>> b8ea37367e37d41393a282562f2aef39e1cdb1d0
