<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\emiten;

class CalonPenerbit implements FromView, WithTitle, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $pralisting = emiten::select('emitens.id', 'emitens.uuid', 'emitens.company_name', 'emitens.trademark', 'emitens.code_emiten', 'emitens.price',
                'emitens.supply', 'emitens.is_deleted', 'emitens.is_active', 'emitens.begin_period', 'emitens.created_at',
                'categories.category as ktg','emitens.begin_period as sd', 'emitens.end_period as ed', 'emitens.capital_needs', 'emitens.is_verified',
                't.name', 't.phone', 'emitens.is_verified_bisnis')
                ->leftjoin('categories', 'categories.id','=','emitens.category_id')
                ->leftjoin('emiten_votes as ev','ev.emiten_id','=','emitens.id')
                ->leftjoin('emiten_journeys','emiten_journeys.emiten_id','=','emitens.id')
                ->leftjoin('traders as t', 't.id', '=', 'emitens.trader_id')
                ->where('emitens.is_deleted',0)
                ->where('emitens.is_verified',1)
                ->where('emitens.is_pralisting',1)
                ->where('emitens.is_coming_soon',1)
                ->groupBy('emitens.id')
                ->orderby('emitens.created_at','DESC')
                ->get();
        return view('admin.export.export-calon-penerbit', ['emiten' => $pralisting]);
    }

    public function title(): string
    {
        return "Data Calon Penerbit";
    }
}
