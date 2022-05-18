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

class PenerbitExport implements FromView, WithTitle, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $emiten = emiten::join('transactions as tr', 'tr.emiten_id', '=', 'emitens.id')
            ->join('traders as t', 't.id', '=', 'tr.trader_id')
            ->select('emitens.id', 'emitens.code_emiten', 'emitens.company_name', 'emitens.trademark', 
                'emitens.begin_period', \DB::raw('sum(tr.amount) as total'))
            ->where('tr.is_deleted', 0)
            ->where('emitens.is_active', 1)
            ->where('emitens.is_deleted', 0)
            ->groupBy('tr.emiten_id')
            ->get();

        return view('admin.export.export-penerbit', ['emiten' => $emiten]);
    }

    public function title(): string
    {
        return "Data Penerbit";
    }
}
