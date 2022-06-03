<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\emiten;
use App\Models\emiten_journey;
use App\Models\FinancialReport;
use App\Models\Dividen;
use DB;

class PerhitunganDividenController extends Controller
{
    
    public function index()
    {
        $soldout = emiten::select('emitens.id', 'emitens.company_name', 'emitens.trademark', 'emitens.code_emiten', 'emitens.price',
            'emitens.supply', 'emitens.is_deleted', 'emitens.is_active', 'emitens.begin_period', 'emitens.created_at',
            'categories.category as ktg','emitens.begin_period as sd', 'emitens.end_period as ed')
            ->leftjoin('categories', 'categories.id','=','emitens.category_id')
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
        $commingsoon = emiten::select('emitens.id', 'emitens.company_name', 'emitens.trademark', 'emitens.code_emiten', 'emitens.price',
            'emitens.supply', 'emitens.is_deleted', 'emitens.is_active', 'emitens.begin_period', 'emitens.created_at',
            'categories.category as ktg','emitens.begin_period as sd', 'emitens.end_period as ed')
            ->leftjoin('categories', 'categories.id','=','emitens.category_id')
            ->leftjoin('emiten_votes as ev','ev.emiten_id','=','emitens.id')
            ->leftjoin('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
            ->where('emitens.is_deleted',0)
            ->where('emitens.is_verified',1)
            ->where('emitens.is_pralisting',1)
            ->where('emitens.is_coming_soon',1)
            ->groupBy('emitens.id')
            ->orderby('created_at','DESC')
            ->get();
        $dtNowPlaying = emiten::select('emitens.id', 'emitens.company_name', 'emitens.trademark', 'emitens.code_emiten', 'emitens.price',
        'emitens.supply', 'emitens.is_deleted', 'emitens.is_active', 'emitens.begin_period', 'emitens.created_at',
        'categories.category as ktg','emitens.begin_period as sd', 'emitens.end_period as ed',
        DB::raw('CONVERT(ROUND(
            IF(
              (SUM(
                IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply > 1, 1,
                  (SUM(
                    IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply) * 100, 2), char) as sold_out'))
            ->leftjoin('categories', 'categories.id','=','emitens.category_id')
            ->leftjoin('transactions', function($query){
                $query->on('transactions.emiten_id','=','emitens.id')
                    ->where('transactions.channel', '<>', 'MARKET');
            })
            ->where('emitens.is_active', 1)
            ->where('emitens.is_deleted',0)
            ->groupBy('emitens.id')
            ->get();
        $nowPlaying = [];
        
        $collection = collect($soldout);
        $merged = $collection->merge($commingsoon);
        $mergedData = $merged->all();

        foreach($dtNowPlaying as $row){
            if($row->sold_out != '100.00'){
                array_push($mergedData, [
                    'id' => $row->id,
                    'company_name' => $row->company_name,
                    'trademark' => $row->trademark,
                    'code_emiten' => $row->code_emiten,
                    'price' => $row->price,
                    'supply' => $row->supply,
                    'is_deleted' => $row->is_deleted,
                    'is_active' => $row->is_active,
                    'begin_period' => $row->begin_period,
                    'created_at' => $row->created_at,
                    'ktg' => $row->ktg,
                ]);
            }
        }
        $emiten = [];
        foreach($mergedData as $row){
                $latestJourney = $this->getLatestJourney($row['id']);
                array_push($emiten, [
                    'id' => $row['id'],
                    'company_name' => $row['company_name'],
                    'trademark' => $row['trademark'],
                    'code_emiten' => $row['code_emiten'],
                    'price' => $row['price'],
                    'supply' => $row['supply'],
                    'is_deleted' => $row['is_deleted'],
                    'is_active' => $row['is_active'],
                    'begin_period' => $row['begin_period'],
                    'created_at' => $row['created_at'],
                    'ktg' => $row['ktg'],
                ]);
        }
        return view('admin.emiten.perhitungan-deviden', compact('emiten'));
    }

    public function getLatestJourney($emitenId)
    {
        $emitenJourney = emiten_journey::where('emiten_id', $emitenId)
            ->orderBy('created_at', 'DESC')
            ->first();
        return $emitenJourney;
    }

    public function getTahapDividen($emitenId){
        $dv = Dividen::select('devidend.devidend_date')
            ->leftjoin('emitens', 'emitens.id','=','devidend.emiten_id')
            ->where('devidend.emiten_id',$emitenId)
            ->where('emitens.is_active',1)
            ->where('emitens.is_deleted',0)
            ->where('devidend.is_deleted', 0)
            ->get();
        $tmpyd = emiten_journey::select('emiten_journeys.date', 'emiten_journeys.end_date')
            ->leftjoin('emitens', 'emitens.id','=','emiten_journeys.emiten_id')
            ->where('emiten_journeys.emiten_id',$emitenId)
            ->where('emiten_journeys.title','Penyerahan Dana')
            ->where('emitens.is_active',1)
            ->where('emitens.is_deleted',0)
            ->groupBy('emitens.id')
            ->first();
        $data = [];
        $tglAwal = "";
        if($tmpyd != null){
            $tglAwal = $tmpyd->date;
        }
        array_push($data, [
            'devidend_date' => $tmpyd != null ?  $tglAwal : ""
        ]);
        foreach($dv as $row){
            array_push($data, [
                'devidend_date' => $row->devidend_date
            ]);
        }
      
        return response()->json(["code" => 200, "data" => $data]);
    }

    public function hitungBulan(Request $request)
    {
        
        
    }

    public function detailData(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $emitenId = $request->emiten_id;
        $financialReports = FinancialReport::join('emitens as e', 'e.id', '=', 'financial_reports.emitens_id')
            ->where('financial_reports.month', $bulan)
            ->where('financial_reports.year', $tahun)
            ->where('financial_reports.is_deleted', 0)
            ->where('financial_reports.status', 'verified')
            ->where('financial_reports.emitens_id', $emitenId)
            ->select('financial_reports.month', 'financial_reports.year', 'financial_reports.net_profit')
            ->first();
        return response()->json(["data" => $financialReports]);
    }

    public function sumNetProfitData(Request $request)
    {
        $tahun = $request->tahun;
        $emitenId = $request->emiten_id;
        $total = FinancialReport::join('emitens as e', 'e.id', '=', 'financial_reports.emitens_id')
            ->where('financial_reports.year', $tahun)
            ->where('financial_reports.is_deleted', 0)
            ->where('financial_reports.status', 'verified')
            ->where('financial_reports.emitens_id', $emitenId)
            ->groupBy('financial_reports.year')
            ->select(\DB::raw('SUM(financial_reports.net_profit) as total'), 'e.avg_capital_needs', 'e.avg_general_share_amount')
            ->first();
        return response()->json(["data" => $total]);
    }

}
