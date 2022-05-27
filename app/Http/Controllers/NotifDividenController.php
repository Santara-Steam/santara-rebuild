<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\emiten;
use Carbon\Carbon;

class NotifDividenController extends Controller
{
    
    public function index()
    {
        // query untuk notif dividen
        // $sold_out = emiten::select('emitens.id', 'emitens.company_name', 'emitens.trademark', 'emitens.code_emiten', 'emitens.price',
        //     'emitens.supply', 'emitens.is_deleted', 'emitens.is_active', 'emitens.begin_period', 'emitens.created_at',
        //     'emitens.begin_period as sd', 'emitens.end_period as ed', 'emitens.last_emiten_journey')
        //     ->leftjoin('transactions','transactions.emiten_id','=','emitens.id')
        //     ->where('emitens.is_deleted',0)
        //     ->whereYear('emitens.begin_period', Carbon::now()->format('Y'))
        //     ->whereMonth('emitens.begin_period', Carbon::now()->addMonth()->format('m'))
        //     ->groupBy('emitens.id')
        //     ->get();

        $sold_out = emiten::select('emitens.id', 'emitens.company_name', 'emitens.trademark', 'emitens.code_emiten', 'emitens.price',
            'emitens.supply', 'emitens.is_deleted', 'emitens.is_active', 'emitens.begin_period', 'emitens.created_at',
            'emitens.begin_period as sd', 'emitens.end_period as ed', 'emitens.last_emiten_journey')
            ->leftjoin('transactions','transactions.emiten_id','=','emitens.id')
            ->where('emitens.is_deleted',0)
            ->groupBy('emitens.id')
            ->havingRaw('CONVERT(ROUND(
                IF(
                (SUM(
                    IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply > 1, 1,
                    (SUM(
                        IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply) * 100, 2), char) = 100.00
                        and 
                        emitens.is_deleted = 0
                        and emitens.is_active = 1
                        and emitens.begin_period < now()')
            ->get();
        return view('admin.emiten.notif-dividen', compact('sold_out'));
    }

    public function sendNotif($id)
    {
        $emiten = emiten::join('traders as t', 't.id', '=', 'emitens.trader_id')
            ->join('users as u', 'u.id', '=', 't.user_id')
            ->where('emitens.id', $id)
            ->select('u.email', 'emitens.company_name', 'emitens.begin_period')
            ->first();
        $details = [
            'subject' => 'Pembagian Dividen',
            'company_name' => $emiten->company_name,
            'tanggal_dividen' => $emiten->begin_period
        ];
        \Mail::to($emiten->email)->send(new \App\Mail\NotifPemberitahuanDividen($details));
        return response()->json(["code" => 200, "message" => "Berhasil kirim email pemberitahuan"]);
    }

}
