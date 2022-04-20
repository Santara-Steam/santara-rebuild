<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Markets;
use App\Models\emiten;
use App\Models\TransactionStatus;
use App\Models\StatusHistori;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Auth;

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
            $totalRecords = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->where('tr.last_status', $request->filter)
                ->where('tr.is_deleted', 0)
                ->select('count(*) as allcount')
                ->count();
            $totalRecordswithFilter = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->where('tr.last_status', $request->filter)
                ->where('tr.is_deleted', 0)
                ->where('t.name', 'like', '%' .$searchValue . '%')
                ->count();
    
            $transactions = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->where('tr.is_deleted', 0)
                ->where('tr.last_status', $request->filter)
                ->skip($start)
                ->take($rowperpage)
                ->select('tr.id', 'tr.uuid', 't.name as trader_name', 'users.email as user_email', 
                    't.id as trader_id', 'e.code_emiten', DB::raw('CONCAT("SAN","-", tr.id, "-", e.code_emiten) as transaction_serial'), 
                    'tr.channel', 'tr.description', 'tr.is_verified', 'tr.split_fee', 'tr.created_at as created_at', 
                    'tr.amount', 'tr.fee', 'e.price', DB::raw('(tr.amount/e.price) as qty'), 
                    'tr.last_status as status', 't.phone')
                ->orderBy('tr.created_at', 'DESC')
                ->get();
        }else{
            $totalRecords = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->where('tr.is_deleted', 0)
                ->select('count(*) as allcount')
                ->count();
            $totalRecordswithFilter = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->where('tr.is_deleted', 0)
                ->where('t.name', 'like', '%' .$searchValue . '%')
                ->count();
    
            $transactions = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->where('tr.is_deleted', 0)
                ->skip($start)
                ->take($rowperpage)
                ->select('tr.id', 'tr.uuid', 't.name as trader_name', 'users.email as user_email', 
                    't.id as trader_id', 'e.code_emiten', DB::raw('CONCAT("SAN","-", tr.id, "-", e.code_emiten) as transaction_serial'), 
                    'tr.channel', 'tr.description', 'tr.is_verified', 'tr.split_fee', 'tr.created_at as created_at', 
                    'tr.amount', 'tr.fee', 'e.price', DB::raw('(tr.amount/e.price) as qty'), 
                    'tr.last_status as status', 't.phone')
                ->orderBy('tr.created_at', 'DESC')
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

            //$member = '<div class="row"></div>'
            $channel = $row->channel == "VA" ? "Virtual Account" : $row->channel == "BANKTRANSFER" ? "Transfer Bank" : 
                $row->channel == "WALLET" ? "Saldo Dompet" : $row->channel == "DANA" ? "DATA" : 
                $row->channel == "MARKET" ? "MARKET " : " - ".$row->description;

            $transaction = '<div class="row"><div class="col-5">ID:</div><div class="col-7">'.$row->transaction_serial.'</div></div><div class="row"><div class="col-5">Token:</div><div class="col-7">'.$row->code_emiten.'</div></div><div class="row">
                <div class="col-5">Pembayaran:</div><div class="col-7">'.$channel.'</div></div>';

            $member = '<div class="row"><div class="col-3">Nama:</div><div class="col-9">'.$row->trader_name.'</div></div>'
                .'<div class="row"><div class="col-3">Email:</div><div class="col-9">'.$row->user_email.'</div></div>'
                .'<div class="row"><div class="col-3">HP:</div><div class="col-9">'.$row->phone.'</div></div>';

            $created_at = '<div class="row"><div class="col-4">Date:</div><div class="col-8">'.tgl_indo(date('Y-m-d', strtotime($row->created_at)))
                .'</div></div><div class="row"><div class="col-4">Time:</div><div class="col-8">'.formatJam($row->created_at).'</div></div>';              

            array_push($data, [
                "id" => $row->id,
                "uuid" => $row->uuid,
                "transaksi" => $transaction,
                "member" => $member,
                "amount" => rupiah($row->amount),
                "created_at" => $created_at,
                "split_fee" => rupiah($row->split_fee),
                "status" => $status,
                "link" => '<a href="'.url('/admin/transaction/detail/'.$row->uuid.'/'.$status_transaction).'" class="'.$class_action.'">'.$text_action.'</a>'
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

    public function user_transaksi()
    {
        $uid = Auth::user()->id;
        $transactions = User::join('traders as t', 't.user_id', '=', 'users.id')
                ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
                ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
                ->where('users.id', $uid)
                ->where('tr.is_deleted', 0)
                ->where('tr.last_status', 'EXPIRED')
                ->orwhere('users.id', $uid)
                ->where('tr.is_deleted', 0)
                ->where('tr.last_status', 'VERIFIED')
                ->select('tr.id', 'tr.uuid','e.pictures', 't.name as trader_name', 'users.email as user_email', 
                    't.id as trader_id','e.trademark','e.company_name', 'e.code_emiten', DB::raw('CONCAT("SAN","-", tr.id, "-", e.code_emiten) as transaction_serial'), 
                    'tr.channel', 'tr.description', 'tr.is_verified', 'tr.split_fee', 'tr.created_at as created_at', 
                    'tr.amount', 'tr.fee', 'e.price', DB::raw('(tr.amount/e.price) as qty'), 
                    'tr.last_status as status')
                ->get();
        return view('user.transactions.index',compact('transactions'));
    }

    public function confirm($uuid)
    {
        try {
			$client = new \GuzzleHttp\Client();

			$headers = [
				'Authorization' => 'Bearer '.app('request')->session()->get('token'),
				'Accept'        => 'application/json',
				'Content-type'  => 'application/json'
			];

			$response = $client->request('POST', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'transaction/confirm/'.$uuid, [
				'headers' => $headers,
			]);

			if ($response->getStatusCode() == 200) {
				echo json_encode(['msg' => 200]);
			}
		} catch (\Exception $exception) {
			$statusCode = $exception->getResponse()->getStatusCode();
            echo json_encode(['msg' => $statusCode]);
		}
    }

    public function cancelConfirm($uuid)
    {
        try {
			$client = new \GuzzleHttp\Client();

			$headers = [
				'Authorization' => 'Bearer '.app('request')->session()->get('token'),
				'Accept'        => 'application/json',
				'Content-type'  => 'application/json'
			];

			$response = $client->request('POST', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'transaction/unconfirm/'.$uuid, [
				'headers' => $headers,
			]);

			if ($response->getStatusCode() == 200) {
                return response()->json(['msg' => 200]);
			}
		} catch (\Exception $exception) {
			$statusCode = $exception->getResponse()->getStatusCode();
            return response()->json(['msg' => $statusCode]);
		}
    }

    public function deleteTransaction(Request $request)
    {
        DB::transaction(function() use ($request) {
            $emiten = Transaction::join('emitens as e', 'e.id', '=', 'transactions.emiten_id')
                ->where('transactions.id', $request->id)
                ->select('e.id as emiten_id', 'e.sold as sold', 'e.price as price', 'transactions.amount')
                ->first();
            if($emiten != null) {
                $emiten = emiten::find($emiten->emiten_id);
                $emiten->sold = $emiten->sold - ($emiten->amount / $emiten->price);
                $emiten->save();

                $transaction = Transaction::find($request->id);
                $transaction->is_verified = 0;
                $transaction->save();

                $data_status = [
                    'status' => 'created',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'is_deleted' => 0,
                    'created_by' => NULL,
                    'updated_by' => NULL
                ];

                $trStatus = TransactionStatus::create($data_status);
                $data_status_id = $trStatus->id;

                $data_status_histories = [
                    'uuid' => Str::uuid(),
                    'transaction_id' => $request->id,
                    'status_id' => $data_status_id,
                    'created_by' => NULL,
                    'updated_at' => NULL,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'is_deleted' => 0
                ];

                $insertHistori = StatusHistori::create($data_status_histories);
                if($insertHistori){
                    
                    $transaction = Transaction::find($request->id);
                    if($transaction->is_verified != 0) {
                        $emiten = emiten::find($transaction->emiten_id);
                        $emiten->sold = $emiten->sold - ($transaction->amount / $transaction->price);
                        $emiten->save();
                    }

                    $deleted = Transaction::where('id', $request->id)->update([
                        'is_deleted' => 1
                    ]);
                    if($deleted){
                        echo json_encode(['msg' => 200]);
                    }

                }else{
                    echo json_encode(['msg' => 500]);
                }

            }
        });
    }
    
    

}
