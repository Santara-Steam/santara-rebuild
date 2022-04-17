<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deposit;
use DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class DepositController extends Controller
{
    //
    public function user_depo()
    {
        $deposit = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
            ->join('users as u', 'u.id', '=', 't.user_id')
            ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
            ->where('deposits.trader_id',Auth::user()->trader->id)
            ->select('deposits.id', 'deposits.uuid', 'deposits.amount', 'deposits.fee', 
                'u.email', 'deposits.confirmation_photo', 'deposits.split_fee',
                'deposits.bank_to', 'deposits.bank_from', 'deposits.channel', 'deposits.account_number', 
                'deposits.status', 'deposits.created_at', 'deposits.updated_at', 't.name as trader_name', 
                'deposits.created_by', 'va.account_number as va_account_number', 'va.bank as va_bank')
            ->orderBy('deposits.created_at','DESC')
            ->get();
        return view('user.deposit.index',compact('deposit'));
    }

    public function admin_deposit()
    {
        return view('admin.deposit.index');
    }

    public function fetchDataAdminDeposit(Request $request)
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
            if($request->filter == "menuggupembayaran"){
                $totalRecords = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
                    ->where('deposits.status', $request->filter)
                    ->whereNull('deposits.confirmation_photo')  
			        ->whereNull('deposits.bank_to')
                    ->select('count(*) as allcount')
                    ->count();
                $totalRecordswithFilter = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
                    ->where('deposits.status', $request->filter)
                    ->whereNull('deposits.confirmation_photo')  
			        ->whereNull('deposits.bank_to')
                    ->where('t.name', 'like', '%' .$searchValue . '%')
                    ->count();
                $deposit = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
                    ->where('deposits.status', $request->filter)
                    ->whereNull('deposits.confirmation_photo')  
			        ->whereNull('deposits.bank_to')
                    ->skip($start)
                    ->take($rowperpage)
                    ->select('deposits.id', 'deposits.uuid', 'deposits.amount', 'deposits.fee', 
                        'u.email', 'deposits.confirmation_photo', 'deposits.split_fee',
                        'deposits.bank_to', 'deposits.bank_from', 'deposits.channel', 'deposits.account_number', 
                        'deposits.status', 'deposits.created_at', 'deposits.updated_at', 't.name as trader_name', 
                        'deposits.created_by', 'va.account_number as va_account_number', 'va.bank as va_bank')
                    ->orderBy('deposits.created_at', 'DESC')
                    ->get();
            }else{
                $totalRecords = $deposit = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
                    ->where('deposits.status', $request->filter)
                    ->select('count(*) as allcount')
                    ->count();
                $totalRecordswithFilter = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
                    ->where('deposits.status', $request->filter)
                    ->where('t.name', 'like', '%' .$searchValue . '%')
                    ->count();
                $deposit = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
                    ->where('deposits.status', $request->filter)
                    ->skip($start)
                    ->take($rowperpage)
                    ->select('deposits.id', 'deposits.uuid', 'deposits.amount', 'deposits.fee', 
                        'u.email', 'deposits.confirmation_photo', 'deposits.split_fee',
                        'deposits.bank_to', 'deposits.bank_from', 'deposits.channel', 'deposits.account_number', 
                        'deposits.status', 'deposits.created_at', 'deposits.updated_at', 't.name as trader_name', 
                        'deposits.created_by', 'va.account_number as va_account_number', 'va.bank as va_bank')
                    ->orderBy('deposits.created_at', 'DESC')
                    ->get();
            }
        }else{
            $totalRecords = $deposit = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
                ->select('count(*) as allcount')
                ->count();
            $totalRecordswithFilter = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
                ->where('t.name', 'like', '%' .$searchValue . '%')
                ->count();
            $deposit = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
                ->skip($start)
                ->take($rowperpage)
                ->select('deposits.id', 'deposits.uuid', 'deposits.amount', 'deposits.fee', 
                    'u.email', 'deposits.confirmation_photo', 'deposits.split_fee',
                    'deposits.bank_to', 'deposits.bank_from', 'deposits.channel', 'deposits.account_number', 
                    'deposits.status', 'deposits.created_at', 'deposits.updated_at', 't.name as trader_name', 
                    'deposits.created_by', 'va.account_number as va_account_number', 'va.bank as va_bank')
                ->orderBy('deposits.created_at', 'DESC')
                ->get();
        }

        $data = [];
        foreach($deposit as $row){

            $totalDeposit = rupiah($row->amount);
            if(($row->status == 1 && $row->confirmation_photo != null && $row->bank_to != null) || ($row->status == 1 && $row->confirmation_photo == null && $row->bank_to == null)) {
                $status = '<div class="status badge badge-success badge-pill badge" style="margin-bottom:0.5rem;display: block;">Sudah Verifikasi</div> ';
                if($row->channel == 'BANKTRANSFER') {
                    //$status .= '<a href="#" onClick="detailDeposit(\'' . BASE_API_FILE . '' . $deposit->confirmation_photo . '?token=' . $this->session->token . '\')" class="btn btn-info btn-sm btn-block" title="Detail" >Lihat Bukti</a>';
                    $status .= '<a href="#" class="btn btn-info btn-sm btn-block" title="Detail">Lihat Bukti</a>'; 
                }
            }elseif($row->status == 0 && $row->confirmation_photo != null && $row->bank_to != null){
                $photo = null;
                //if(ispermitted('CONFIRM_DEPOSIT')){
                    // Nanti dulu
                    // if(empty($deposit->account_number) || $deposit->channel == 'BANKTRANSFER') {
                    //     $photo = BASE_API_FILE . '' . $deposit->confirmation_photo . '?token=' . $this->session->token;
                    // }
                    // $status = '<a href="#" onClick="confirmDeposit(
                    //     \'' . $row->uuid . '\',
                    //     \'' . $photo . '\',
                    //     \'' . $row->trader_name . '\',
                    //     \'' . $totalDeposit . '\')" class="btn btn-info btn-sm btn-block" title="Verifikasi" >
                    //     Verifikasi
                    // </a>';
                    // $status .= '<a href="#" onClick="rejectDeposit(\'' . $deposit->uuid . '\')" class="btn btn-danger btn-sm btn-block" title="Tolak" >Tolak</a>';
                    $status = '<a href="#" onClick="confirmDeposit(
                        //     \'' . $row->uuid . '\',
                        //     \'' . $photo . '\',
                        //     \'' . $row->trader_name . '\',
                        //     \'' . $totalDeposit . '\')" class="btn btn-info btn-sm btn-block" title="Verifikasi" >
                        //     Verifikasi
                        // </a>';
                    $status .= '<a href="#" onClick="rejectDeposit(\''. $row->uuid.'\')" class="btn btn-danger btn-sm btn-block" title="Tolak" >Tolak</a>';
                //} else {
                //    $status = '<div class="status badge badge-warning badge-pill badge" style="display: block;">Menuggu Verifikasi</div>';
                //}
            }elseif($row->status == 2) {
                $status = '<div class="status badge badge-danger badge-pill badge" style="display: block;">Ditolak</div>';
            }else {
                $status = '<div class="status badge badge-warning badge-pill badge" style="display: block;">Menunggu Pembayaran</div>';
            }

            $created_at = tgl_indo(date('Y-m-d', strtotime($row->created_at))).' '.formatJam($row->created_at);

            $bank_to = '-';
            $bank_from = '-';
            $account_number = '-';
            if($row->channel){
                if($row->channel == 'VA' || isset($row->virtual_account)) {
                    $channel        = 'Virtual Account';
                    $account_number = $row->va_account_number;
                    $bank_to        = $row->va_bank;
                }elseif($row->channel == 'BANKTRANSFER') {
                    $channel        = 'Bank Transfer';
                    $bank_from      = $row->bank_from;
                    $account_number = $row->account_number;

                    switch($row->bank_to) {
                        case 1:
                            $bank_to = 'BCA';
                            break;
                        case 2:
                            $bank_to = 'MANDIRI';
                            break;
                        case 3:
                            $bank_to = 'BRI';
                            break;
                        default:
                            $bank_to = '-';
                            break;
                    }
                }elseif($row->channel == 'DANA') {
                    $channel = 'DANA';
                }elseif($row->channel == 'ONEPAY') {
                    $channel = 'Other Payment (ONEPAY)';
                }else{
                    $channel = 'Bank Transfer';
                }
            }else{
                $channel = $row->created_by;
            }

            array_push($data, [
                "trader_name" => $row->trader_name,
                "email" => $row->email,
                "nominal" => rupiah($row->amount + $row->fee),
                "channel" => $channel,
                "bank_from" => $bank_from,
                "account_number" => $account_number,
                "bank_to" => $bank_to,
                "created_at" => $created_at,
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

    public function user_cdepo(Request $request){
        // try {
            $client = new Client();
            $response = $client->request('POST', env("BASE_API_CLIENT_URL") . '/v3.7.1/deposit/idr', [
                'headers' => [
                    'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
                    'Origin'        => env("BASE_API_FILE")
                ],
                'form_params' => [
                    'amount'         => $request->am,
                    // 'bank_from'      => strip_tags('BNI'),
                    // 'account_number' => strip_tags(),
                    // 'bank'           => strip_tags($data['bank']),
                    'channel'        => "ONEPAY",
                    // 'channel'        => $data['channel'],
                    // 'fee'            => $fee,
                    'pin'            => '111111',
                    'finger'         => true
                ]
            ]);


            // echo json_encode(json_decode($response->getBody()->getContents()));
            $rsp = json_encode(json_decode($response->getBody()->getContents()));
            $r = json_decode($rsp, true);
            // return;
            $newUrl = $r['data']['deposit']['redirectURL'];
            session()->flash('newurl', $newUrl);
            return redirect()->back();
            // return redirect()->away($r['data']['deposit']['redirectURL']);

            // dd($rsp);
            // print_r($r['data']['deposit']['redirectURL']);
        // } catch (\Exception $exception) {
        //     echo json_encode(errorcatch($exception, 'deposit'));
        //     return;
        // }
    }
}
