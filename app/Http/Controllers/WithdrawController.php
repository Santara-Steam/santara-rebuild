<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Exports\Penarikan;
use Maatwebsite\Excel\Facades\Excel;

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

        $startDate = $request->startDate;
        $endDate = $request->endDate;

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
                    'withdraws.split_fee', 'withdraws.external_id')
                ->get();
        }else{
            if($startDate != "" && $endDate != ""){
                $totalRecords = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->where('withdraws.is_deleted', 0)
                    ->whereDate('withdraws.created_at', '>=', $startDate)
                    ->whereDate('withdraws.created_at', '<=', $endDate)
                    ->orderBy('withdraws.id', 'DESC')
                    ->select('count(*) as allcount')
                    ->count();
                $totalRecordswithFilter = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->where('withdraws.is_deleted', 0)
                    ->where('withdraws.account_name', 'like', '%' .$searchValue . '%')
                    ->whereDate('withdraws.created_at', '>=', $startDate)
                    ->whereDate('withdraws.created_at', '<=', $endDate)
                    ->orderBy('withdraws.id', 'DESC')
                    ->count();
                $withdraws = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->where('withdraws.is_deleted', 0)
                    ->whereDate('withdraws.created_at', '>=', $startDate)
                    ->whereDate('withdraws.created_at', '<=', $endDate)
                    ->skip($start)
                    ->take($rowperpage)
                    ->orderBy('withdraws.id', 'DESC')
                    ->select('withdraws.uuid', 't.uuid as trader_uuid', 'withdraws.id', 
                        'withdraws.is_verified', 'withdraws.account_name','withdraws.account_number', 
                        'withdraws.bank_to', 'withdraws.amount', 'withdraws.fee', 'withdraws.created_at', 
                        'withdraws.updated_at', 't.id as trader_id', 't.name as trader_name', 't.phone', 'u.email', 
                        'withdraws.split_fee', 'withdraws.external_id')
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
                        'withdraws.split_fee', 'withdraws.external_id')
                    ->get();
            }
        }

        $data = [];
        foreach($withdraws as $row){
            $totalWithdraw = rupiahBiasa(($row->amount - $row->fee));
            $saldoAvailable = rupiahBiasa($this->get_saldo($row->trader_uuid));
            $member = '<div class="col-12">ID : '.$row->external_id.' </div><div class="col-12">'.$row->trader_name
                .'</div><div class="col-12">'.$row->email.'</div><div class="col-12">'.$row->phone.'</div><div class="col-12">'
                .$row->bank_to.'</div>';
            $date = '<div class="col-12">'.tgl_indo(date('Y-m-d', strtotime($row->created_at)))
                .'</div><div class="col-12">'.formatJam($row->created_at).'</div>';
            $amount = '<div class="row"><div class="col-6">Withdrawal :</div><div class="col-6">'.rupiah($row->amount).'</div></div><div class="row"><div class="col-6">Fee :</div><div class="col-6">'
                .rupiah($row->fee).'</div></div><div class="row"><div class="col-6">Total :</div><div class="col-6">'.(rupiah($row->amount - $row->fee)).'</div></div>';
            
            if($row->is_verified == 0 || $row->is_verified == null){
                $status = '<a href="#" class="btn btn-info btn-sm btn-block" title="Verifikasi" onClick="confirmWithdraw(\'' . $row->uuid . '\',
                    \'' . $row->account_name . '\',
                    \'' . $row->account_number . '\',
                    \'' . $row->bank_to . '\',                                                                    
                    \'' . $totalWithdraw . '\',
                    \'' . $saldoAvailable . '\')" 
                        >Verifikasi</a> 
                    <a href="#" onClick="rejectWithdraw(\'' . $row->uuid . '\')" class="btn btn-danger btn-sm btn-block" title="Tolak" >Tolak</a>';
            }else if($row->is_verified == 2){
                $status = '<div class="status badge badge-danger badge-pill">Ditolak</div>';
            }elseif($row->is_verified == 1) {
                $status = '<div class="status badge badge-success badge-pill">Sudah Verifikasi</div>';
            }else{
                $status = '<div class="status badge badge-warning badge-pill">Tidak Diketahui</div>';
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

    private function get_saldo($uuid)
    {
        $saldo = 0;

        try {
            $client = new \GuzzleHttp\Client();

            $headers = [
                'Authorization' => 'Bearer ' . app('request')->session()->get('token'),
                'Accept'        => 'application/json',
                'Content-type'  => 'application/json'
            ];

            $response = $client->request('GET', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION') . 'traders/idr/' . $uuid, [
                'headers' => $headers,
            ]);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody()->getContents(), TRUE);
                $saldo = $data['idr'];
            }
        } catch (\Exception $exception) {
            $saldo = null;
        }

        return $saldo;
    }

    public function update($uuid, $status, $keterangan = null)
    {
            $keterangan = ($keterangan != null) ? urldecode($keterangan) : $keterangan;
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('PUT', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION') . "withdraw/" . $uuid, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . app('request')->session()->get('token')
                    ],
                    'form_params' => [
                        'status' => $status,
                        'keterangan' => $keterangan
                    ]
                ]);

                if ($response->getStatusCode() == 200) {
                    echo json_encode(['msg' => $response->getStatusCode()]);
                }
            } catch (\Exception $exception) {
                $response = $exception->getResponse();
                $responseBody = $response->getBody()->getContents();
                $body = json_decode($responseBody, true);
                if (isset($body['message'])) {
                    $msg = $body['message'];
                } else if (isset($body['error'])) {
                    if (isset($body['error']['errors'][0][0])) {
                        $msg
                            = $body['error']['message'] . ", " . $body['error']['errors'][0][0]['message'];
                    } else if (isset($body['error']['reason'][0])) {
                        if (isset($body['error']['reason'][0][0])) {
                            $msg
                                = $body['error']['message'] . ", " . $body['error']['reason'][0][0]['message'];
                        } else {
                            if (isset($body['error']['reason'][0]['message'])) {
                                $msg
                                    = $body['error']['message'] . ", " . $body['error']['reason'][0]['message'];
                            } else {
                                $msg
                                    = $body['error']['message'] . ", " . $body['error']['reason'][0]['reason'];
                            }
                        }
                    }
                } else {
                    if (env('CONFIG_ENV') == "dev") {
                        $msg = $exception->getMessage();
                    } else {
                        $msg = 'Server Error ' . $exception->getCode();
                    }
                }
                echo json_encode(['msg' => $msg]);
                return;
            }
    }

    public function reject($uuid, $status, $keterangan = null)
    {
            $keterangan = ($keterangan != null) ? urldecode($keterangan) : $keterangan;
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('PUT', config('global.BASE_API_ADMIN_URL').'/'.config('global.API_ADMIN_VERSION') . "withdraw/" . $uuid, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . app('request')->session()->get('token')
                    ],
                    'form_params' => [
                        'status' => $status,
                        'keterangan' => $keterangan
                    ]
                ]);

                if ($response->getStatusCode() == 200) {
                    echo json_encode(['msg' => $response->getStatusCode()]);
                }
            } catch (\Exception $exception) {
                $response = $exception->getResponse();
                $responseBody = $response->getBody()->getContents();
                $body = json_decode($responseBody, true);
                if (isset($body['message'])) {
                    $msg = $body['message'];
                } else if (isset($body['error'])) {
                    if (isset($body['error']['errors'][0][0])) {
                        $msg
                            = $body['error']['message'] . ", " . $body['error']['errors'][0][0]['message'];
                    } else if (isset($body['error']['reason'][0])) {
                        if (isset($body['error']['reason'][0][0])) {
                            $msg
                                = $body['error']['message'] . ", " . $body['error']['reason'][0][0]['message'];
                        } else {
                            if (isset($body['error']['reason'][0]['message'])) {
                                $msg
                                    = $body['error']['message'] . ", " . $body['error']['reason'][0]['message'];
                            } else {
                                $msg
                                    = $body['error']['message'] . ", " . $body['error']['reason'][0]['reason'];
                            }
                        }
                    }
                } else {
                    if (env('CONFIG_ENV') == "dev") {
                        $msg = $exception->getMessage();
                    } else {
                        $msg = 'Server Error ' . $exception->getCode();
                    }
                }
                echo json_encode(['msg' => $msg]);
                return;
            }
    }


    public function exportExcel(Request $request)
    {
        return Excel::download(new Penarikan($request->start_date, $request->end_date), 'Data Penarikan.xlsx');
    }

    

}