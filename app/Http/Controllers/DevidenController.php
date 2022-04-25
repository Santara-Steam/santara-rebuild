<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Deviden;
use App\Models\HistoriDividen;
use App\Models\emiten;
use DB;

class DevidenController extends Controller
{
    
    public function index()
    {
        return view('admin.deviden.index');
    }

    public function create()
    {
        $emitens = emiten::where('is_deleted', 0)
            ->where('code_emiten', '!=', '')
            ->orderBy('code_emiten')
            ->select('id', 'uuid', 'code_emiten')
            ->get();
        $bulans = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );
        return view('admin.deviden.add', compact('emitens', 'bulans'));
    }

    public function detail(Request $request)
    {
        $trader_id = $request->trader_id;
        $status = $request->status; 
        $updated_at = $request->updated_at;
        $dividen = Deviden::join('traders as t', 'bagihasils.trader_id', '=', 't.id')
            ->join('users as u', 't.user_id', '=', 'u.id')
            ->join('emitens as e', 'bagihasils.emiten_id', '=', 'e.id')
            ->where('bagihasils.is_deleted', 0)
            ->where('bagihasils.trader_id', $trader_id)
            ->where('bagihasils.status', $status)
            ->where('bagihasils.updated_at', $updated_at)
            ->select('e.trademark', 'bagihasils.devidend as dividend')
            ->first();
        
        $response = "<div class='table-responsive'>";
        $response .= "<table class='table table-hover'>";
        $response .= "<tr><th>Nama Penerbit</th><th style='text-align: right;'>Jumlah bagi hasil</th></tr>";
        $total = 0;
        $trademark = $dividen->trademark;
        $data_dividend = $dividen->dividend;
        $total += $data_dividend;
        $response .= "<tr><td>" . $trademark . "</td><td style='text-align: right;'>" . rupiah($data_dividend) . "</td></tr>";
        
        $response .= "</table>";
        $response .= "<span style='float: right; padding-right: 2rem;'><b>" . rupiah($total) . "</b></span>";
        $response .= "</div>";

        return response()->json($response);
    
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
            if($request->filter == 'wallet' || $request->filter == 'rekening'){
                $totalRecords = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                    ->where('bagihasils.is_deleted', 0)
                    ->where('bagihasils.status', $request->filter)
                    ->whereNull('bagihasils.deposit_id')
                    ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                    ->orderBy('bagihasils.updated_at', 'DESC')
                    ->select('count(*) as allcount')
                    ->count();
                $totalRecordswithFilter = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                    ->where('bagihasils.is_deleted', 0)
                    ->where('bagihasils.status', $request->filter)
                    ->whereNull('bagihasils.deposit_id')
                    ->where('t.name', 'like', '%' .$searchValue . '%')
                    ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                    ->orderBy('bagihasils.updated_at', 'DESC')
                    ->count();
                $devidens = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                    ->where('bagihasils.is_deleted', 0)
                    ->where('bagihasils.status', $request->filter)
                    ->whereNull('bagihasils.deposit_id')
                    ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                    ->orderBy('bagihasils.updated_at', 'DESC')
                    ->skip($start)
                    ->take($rowperpage)
                    ->select('bagihasils.id', 'u.email', 't.uuid as uuid', 't.name', 'e.company_name', 
                        'bagihasils.trader_id', DB::raw('sum(bagihasils.devidend) as devidend'), 'bagihasils.fee', 
                        'bagihasils.bank', 'bagihasils.account_number', 'bagihasils.status', 'bagihasils.created_at', 
                        'bagihasils.updated_at', 'bagihasils.bank', 'bagihasils.account_number', 
                        'bagihasils.account_name', 'bagihasils.bank_kota', 'bagihasils.bank_cabang', 'bagihasils.deposit_id', 
                        'bagihasils.channel')
                    ->orderBy('bagihasils.created_at', 'DESC')
                    ->get();
            }else{
                $totalRecords = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                    ->where('bagihasils.is_deleted', 0)
                    ->where('bagihasils.status', $request->filter)
                    ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                    ->orderBy('bagihasils.updated_at', 'DESC')
                    ->select('count(*) as allcount')
                    ->count();
                $totalRecordswithFilter = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                    ->where('bagihasils.is_deleted', 0)
                    ->where('bagihasils.status', $request->filter)
                    ->where('t.name', 'like', '%' .$searchValue . '%')
                    ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                    ->orderBy('bagihasils.updated_at', 'DESC')
                    ->count();
                $devidens = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                    ->where('bagihasils.is_deleted', 0)
                    ->where('bagihasils.status', $request->filter)
                    ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                    ->orderBy('bagihasils.updated_at', 'DESC')
                    ->skip($start)
                    ->take($rowperpage)
                    ->select('bagihasils.id', 'u.email', 't.uuid as uuid', 't.name', 't.phone', 'e.company_name', 
                        'bagihasils.trader_id', DB::raw('sum(bagihasils.devidend) as devidend'), 'bagihasils.fee', 
                        'bagihasils.bank', 'bagihasils.account_number', 'bagihasils.status', 'bagihasils.created_at', 
                        'bagihasils.updated_at', 'bagihasils.bank', 'bagihasils.account_number', 
                        'bagihasils.account_name', 'bagihasils.bank_kota', 'bagihasils.bank_cabang', 'bagihasils.deposit_id', 
                        'bagihasils.channel')
                    ->orderBy('bagihasils.created_at', 'DESC')
                    ->get();
            }
        }else{
            $totalRecords = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                ->where('bagihasils.is_deleted', 0)
                ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                ->orderBy('bagihasils.updated_at', 'DESC')
                ->select('count(*) as allcount')
                ->count();
            $totalRecordswithFilter = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                ->where('bagihasils.is_deleted', 0)
                ->where('t.name', 'like', '%' .$searchValue . '%')
                ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                ->orderBy('bagihasils.updated_at', 'DESC')
                ->count();
            $devidens = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                ->where('bagihasils.is_deleted', 0)
                ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                ->orderBy('bagihasils.updated_at', 'DESC')
                ->skip($start)
                ->take($rowperpage)
                ->select('bagihasils.id', 'u.email', 't.uuid as uuid', 't.name', 't.phone', 'e.company_name', 
                    'bagihasils.trader_id', DB::raw('sum(bagihasils.devidend) as devidend'), 'bagihasils.fee', 
                    'bagihasils.bank', 'bagihasils.account_number', 'bagihasils.status', 'bagihasils.created_at', 
                    'bagihasils.updated_at', 'bagihasils.bank', 'bagihasils.account_number', 
                    'bagihasils.account_name', 'bagihasils.bank_kota', 'bagihasils.bank_cabang', 'bagihasils.deposit_id', 
                    'bagihasils.channel')
                ->orderBy('bagihasils.created_at', 'DESC')
                ->get();
        }
        
        $data = [];
        foreach($devidens as $row){

            $updated_at = tgl_indo(date('Y-m-d', strtotime($row->updated_at))).' '.formatJam($row->updated_at);
            $dividendIdr = rupiah($row->devidend);
            $feeIdr = rupiah($row->fee);
            $totalIdr = rupiah(($row->devidend - $row->fee));
            $account_name = str_replace("'", "", $row->account_name);

            $confirm = '
                    <a href="#" onClick="confirmDividend(\''.$row->id . '\',
                                        \'' . $row->name . '\',
                                        \'' . $row->trader_id . '\',
                                        \'' . $row->company_name . '\',
                                        \'' . $dividendIdr . '\',
                                        \'' . $feeIdr . '\',
                                        \'' . $totalIdr . '\', 
                                        \'' . $row->bank . '\',
                                        \'' . $row->account_number . '\',
                                        \'' . $account_name . '\',
                                        \'' . $row->bank_kota . '\',
                                        \'' . $row->bank_cabang . '\',
                                        \'' . $row->uuid . '\',
                                        \'' . $row->devidend . '\',
                                        \'' . $row->updated_at . '\')" 
                        class="btn btn-info btn-sm " title="Verifikasi" >Verifikasi</a> 
                    
                    <a href="#" onClick="rejectDividend(\'' . $row->id . '\',
                                                            \'' . $row->uuid . '\',
                                                            \'' . $row->company_name . '\',
                                                            \'' . $row->devidend . '\',
                                                            \'' . $row->trader_id . '\',
                                                            \'' . $row->updated_at . '\')" class="btn btn-danger btn-sm " title="Tolak" >Tolak</a>';

            $pencairan = 'Belum Dicairkan';
            $detail = '<a href="#" onClick="getEmitenDetailConfirm(
                                \'' . $row->trader_id . '\',
                                \'' . $row->status . '\',
                                \'' . $row->updated_at . '\')" class="btn btn-warning btn-sm " title="Tolak" >Detail</a>';
            
            if ($row->status == 0) {
                $status = '<div class="status" style="color: #1e9ff2; font-weight: bold;">&nbsp;Tersedia </div>';
            } elseif ($row->status == 1) {
                $status = $confirm;
            } elseif ($row->status == 2) {
                $status = '<div class="status" style="color: #28d094; font-weight: bold;">&nbsp;Terverifikasi </div>';
                $pencairan = ($row->deposit_id != null) ? 'Wallet' : (($row->channel == 'Dana') ? 'Dana' : 'Rekening');
                if ($row->channel == 'DANA') {
                    $pencairan = 'DANA';
                }
            } elseif ($row->status == 3) {
                $status = '<div class="status" style="color: #ff4961; font-weight: bold;">&nbsp;Ditolak</div>';
            } else {
                $status = '<div class="status badge badge-warning badge-pill badge">&nbsp;Undefined</div>';
                $pencairan = '-';
            }

            $member = '<div class="col-12">'.$row->name.'</div>'
                .'<div class="col-12">'.$row->email.'</div>'
                .'<div class="col-12">'.$row->phone.'</div>';
            $updated_at = '<div class="col-12">'.tgl_indo(date('Y-m-d', strtotime($row->updated_at)))
                .'</div><div class="col-12">'.formatJam($row->updated_at).'</div>';              

            array_push($data, [
                "member" => $member,
                "devidend" => rupiah($row->devidend),
                "status" => $status,
                "updated_at" => $updated_at,
                "pencarian" => $pencairan,
                "detail" => $detail
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

    public function getEmitenByUuid(Request $request)
    {
        $emiten = emiten::where('is_deleted', 0)
            ->where('uuid', $request->emiten_uuid)
            ->orderBy('code_emiten')
            ->select('id', 'uuid as emiten_uuid', 'company_name', 'trademark', 'code_emiten')
            ->first();
        return response()->json(["data" => $emiten]);
    }

    public function generateDividend(Request $request)
    {   
        $this->validate($request,[
            'code_emiten' => 'required',
            'company_name' => 'required',
            'trademark' => 'required',
            'phase' => 'required',
            'trademark' => 'required',
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'amount' => 'required'
         ]);

         $date = $request->date.'-'.$request->month.'-'.$request->year;
         $dividend_date = date('Y-m-d', strtotime($date));
         $dividend_date_time = tgl_indo(date('Y-m-d', strtotime($date))).' '.formatJamLengkap($date);
         $dividend_detail = [
            'emiten_uuid' => $request->emiten_uuid,
            'code_emiten' => $request->code_emiten,
            'trademark' => $request->trademark,
            'company_name' => $request->company_name,
            'phase' => $request->phase,
            'date' => $dividend_date,
            'amount' => $request->amount,
            'date_time' => $dividend_date_time
        ];

        $dividends = null;
        $amount = (int)str_replace(".", "", $request->amount);

        // Belum selesai
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get(config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION').'dividend/generate', [
                'headers' => [
                    'Authorization' => 'Bearer '.app('request')->session()->get('token')
                ],
                'form_params' => [
                    'uuid' => $request->emiten_uuid,
                    'total_dividend' => $amount
                ]
            ]);
            
            if ($response->getStatusCode() == 200) {
                $dividends = json_decode($response->getBody()->getContents(), TRUE);
            }
            $dividend['dividend_detail'] = $dividend_detail;
            $dividend['dividends'] = $dividends;
            $request->session()->put('dividend', $dividend);
            echo json_encode(['msg' => $response->getStatusCode(), 'dividend' => $dividend]);
        } catch (\Exception $exception) {
            $statusCode = $exception->getResponse()->getStatusCode();
            echo json_encode(['msg' => $statusCode]);
        }
    }

    public function saveGenerateDividen(Request $request)
    {
        if($request->session()->has('dividend')){
            $dividend_session = $request->session()->get('dividend');
            $uuid = $request->uuid;
            $data_array = $dividend_session['dividends'];
            $name_file = 'dividend.json';
            $path_file = public_path().'/temp/';

            $fp = fopen($name_file, 'w');
            fwrite($fp, json_encode($data_array));
            fclose($fp);
            $amount = (int)str_replace(".", "", $dividend_session['dividend_detail']['amount']);
            $data_dividend = [
                [
                    'name' => 'uuid',
                    'contents' => $dividend_session['dividend_detail']['emiten_uuid']
                ],
                [
                    'name' => 'total_dividend',
                    'contents' => $amount
                ],
                [
                    'name' => 'date_dividen',
                    'contents' => $dividend_session['dividend_detail']['date_time']
                ],
                [
                    'name' => 'phase',
                    'contents' => $dividend_session['dividend_detail']['phase']
                ],
                [
                    'name' => 'data',
                    'contents' => fopen($name_file, 'r'),
                    'filename' => $name_file
                ],
            ];

            if ($dividend_session['dividend_detail']['emiten_uuid'] == $uuid) {
                try {
                    $client = new \GuzzleHttp\Client();

                    $response = $client->request('POST', config('global.BASE_API_ADMIN_URL').config('global.API_ADMIN_VERSION') . 'dividend/', [
                        'headers' => [
                            'Authorization' => 'Bearer '.app('request')->session()->get('token')
                        ],
                        'multipart' =>  $data_dividend,
                        'timeout' => 500, // Response timeout
                        'connect_timeout' => 501, // Connection timeout
                    ]);
                    $request->session()->forget('dividend');

                    if ($response->getStatusCode() == 200) {
                        echo json_encode(['msg' => $response->getStatusCode()]);
                    }
                } catch (\Exception $exception) {

                    $request->session()->forget('dividend');
                    $response = $exception->getResponse();
                    $responseBody = $response->getBody()->getContents();
                    $body = json_decode($responseBody, true);
                    echo json_encode(['msg' => isset($body['message']) ?  $body['message'] : 'Server error ' . $exception->getMessage()]);
                }
            } else {
                echo json_encode(['msg' => 404]);
            }
        }else{
            echo json_encode(['msg' => 404]);
        }
        unlink($name_file);
    }

    public function hapusSession(Request $request)
    {
        //echo json_encode($request->session()->get('dividend'));
        $request->session()->forget('dividend');
    }

    public function getAdminHistoryDividend(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; 
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir']; 
        $searchValue = $search_arr['value'];

        $totalRecords = HistoriDividen::join('emitens as e', 'e.id', '=', 'devidend.emiten_id')
            ->where('devidend.is_deleted', 0)
            ->select('count(*) as allcount')
            ->count();

        $totalRecordswithFilter = HistoriDividen::join('emitens as e', 'e.id', '=', 'devidend.emiten_id')
            ->where('devidend.is_deleted', 0)
            ->select('count(*) as allcount')
            ->where('e.company_name', 'like', '%' .$searchValue . '%')
            ->count();

        $dividen = HistoriDividen::join('emitens as e', 'e.id', '=', 'devidend.emiten_id')
            ->where('devidend.is_deleted', 0)
            ->skip($start)
            ->take($rowperpage)
            ->select('devidend.id', 'devidend.emiten_id', 'e.company_name', 'e.code_emiten', 'devidend.phase', 
                'e.trademark', 'devidend.devidend', 'devidend.created_at', 'devidend.updated_at')
            ->orderBy('devidend.updated_at', 'DESC')
            ->get();

        $viewDeleteDividen = 0;
        
        $data = [];
        foreach($dividen as $row){

            $updated_at = formatTanggalJamSistem($row->updated_at);
            $action = '<a href="#" onClick="getDetailHistory(\'' . $row->devidend . '\',\'' . $row->phase . '\')" 
                            class="btn btn-info btn-sm " title="Detail">Detail</a>';
            
            if($viewDeleteDividen) {
                $action .= '<a href="#" onClick="deleteDividen(\'' . $row->id . '\',\'' . $row->company_name . '\',\'' . $row->code_emiten . '\',\'' . $row->phase . '\')" 
                                class="btn btn-danger btn-sm " title="Hapus Dividen">Hapus Dividen</a>';
            }
            array_push($data, [
                "updated_at" => $updated_at,
                "code_emiten" => $row->code_emiten,
                "company_name" => $row->company_name,
                "trademark" => $row->trademark,
                "phase" => $row->phase,
                "aksi" => $action
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