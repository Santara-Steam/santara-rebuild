<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deviden;
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
        if($request->filter != ""){
            if($request->filter == 'wallet' || $request->filter == 'rekening'){
                $devidens = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                    ->where('bagihasils.is_deleted', 0)
                    ->where('bagihasils.status', $request->filter)
                    ->where('bagihasils.deposit_id', null )
                    ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                    ->orderBy('bagihasils.updated_at', 'DESC')
                    ->select('bagihasils.id', 'u.email', 't.uuid as uuid', 't.name', 'e.company_name', 
                        'bagihasils.trader_id', DB::raw('sum(bagihasils.devidend) as devidend'), 'bagihasils.fee', 
                        'bagihasils.bank', 'bagihasils.account_number', 'bagihasils.status', 'bagihasils.created_at', 
                        'bagihasils.updated_at', 'bagihasils.bank', 'bagihasils.account_number', 
                        'bagihasils.account_name', 'bagihasils.bank_kota', 'bagihasils.bank_cabang', 'bagihasils.deposit_id', 
                        'bagihasils.channel')
                    ->get();
            }else{
                $devidens = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                    ->where('bagihasils.is_deleted', 0)
                    ->where('bagihasils.status', $request->filter)
                    ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                    ->orderBy('bagihasils.updated_at', 'DESC')
                    ->select('bagihasils.id', 'u.email', 't.uuid as uuid', 't.name', 'e.company_name', 
                        'bagihasils.trader_id', DB::raw('sum(bagihasils.devidend) as devidend'), 'bagihasils.fee', 
                        'bagihasils.bank', 'bagihasils.account_number', 'bagihasils.status', 'bagihasils.created_at', 
                        'bagihasils.updated_at', 'bagihasils.bank', 'bagihasils.account_number', 
                        'bagihasils.account_name', 'bagihasils.bank_kota', 'bagihasils.bank_cabang', 'bagihasils.deposit_id', 
                        'bagihasils.channel')
                    ->get();
            }
        }else{
            $devidens = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                ->where('bagihasils.is_deleted', 0)
                ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                ->orderBy('bagihasils.updated_at', 'DESC')
                ->select('bagihasils.id', 'u.email', 't.uuid as uuid', 't.name', 'e.company_name', 
                    'bagihasils.trader_id', DB::raw('sum(bagihasils.devidend) as devidend'), 'bagihasils.fee', 
                    'bagihasils.bank', 'bagihasils.account_number', 'bagihasils.status', 'bagihasils.created_at', 
                    'bagihasils.updated_at', 'bagihasils.bank', 'bagihasils.account_number', 
                    'bagihasils.account_name', 'bagihasils.bank_kota', 'bagihasils.bank_cabang', 'bagihasils.deposit_id', 
                    'bagihasils.channel')
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
                        class="btn btn-info btn-sm btn-block" title="Verifikasi" >Verifikasi</a> 
                    
                    <a href="#" onClick="rejectDividend(\'' . $row->id . '\',
                                                            \'' . $row->uuid . '\',
                                                            \'' . $row->company_name . '\',
                                                            \'' . $row->devidend . '\',
                                                            \'' . $row->trader_id . '\',
                                                            \'' . $row->updated_at . '\')" class="btn btn-danger btn-sm btn-block" title="Tolak" >Tolak</a>';

            $pencairan = 'Belum Dicairkan';
            $detail = '<a href="#" onClick="getEmitenDetailConfirm(
                                \'' . $row->trader_id . '\',
                                \'' . $row->status . '\',
                                \'' . $row->updated_at . '\')" class="btn btn-warning btn-sm btn-block" title="Tolak" >Detail</a>';
            
            if ($row->status == 0) {
                $status = '<div class="status" style="color: #1e9ff2; font-weight: bold;">Tersedia</div>';
            } elseif ($row->status == 1) {
                $status = $confirm;
            } elseif ($row->status == 2) {
                $status = '<div class="status" style="color: #28d094; font-weight: bold;">Terverifikasi</div>';
                $pencairan = ($row->deposit_id != null) ? 'Wallet' : (($row->channel == 'Dana') ? 'Dana' : 'Rekening');
                if ($row->channel == 'DANA') {
                    $pencairan = 'DANA';
                }
            } elseif ($row->status == 3) {
                $status = '<div class="status" style="color: #ff4961; font-weight: bold;">Ditolak</div>';
            } else {
                $status = '<div class="status badge badge-warning badge-pill badge" style="display:block">Undefined</div>';
                $pencairan = '-';
            }
            array_push($data, [
                "name" => $row->name,
                "email" => $row->email,
                "devidend" => rupiah($row->devidend),
                "status" => $status,
                "updated_at" => $updated_at,
                "pencarian" => $pencairan,
                "detail" => $detail
            ]);
        }
        return response()->json(["data" => $data]);
    }

}