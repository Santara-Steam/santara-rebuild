<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Withdraw;

class Penarikan implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    
    protected $tglAwal, $tglAkhir;

    public function __construct($tglAwal, $tglAkhir) {
        $this->tglAwal = $tglAwal;
        $this->tglAkhir = $tglAkhir;
    }

    public function view(): View {
        $withdraws = Withdraw::join('traders as t', 't.id', '=', 'withdraws.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->where('withdraws.is_deleted', 0)
                    ->whereDate('withdraws.created_at', '>=', $this->tglAwal)
                    ->whereDate('withdraws.created_at', '<=', $this->tglAkhir)
                    ->orderBy('withdraws.id', 'DESC')
                    ->select('withdraws.uuid', 't.uuid as trader_uuid', 'withdraws.id', 
                        'withdraws.is_verified', 'withdraws.account_name','withdraws.account_number', 
                        'withdraws.bank_to', 'withdraws.amount', 'withdraws.fee', 'withdraws.created_at', 
                        'withdraws.updated_at', 't.id as trader_id', 't.name as trader_name', 't.phone', 'u.email', 
                        'withdraws.split_fee', 'withdraws.external_id')
                    ->get();
        return view('admin.export.export-penarikan', ['withdraws' => $withdraws, 'tglAwal' => $this->tglAwal, 'tglAkhir' => $this->tglAkhir]);
    }

    public function title(): string
    {
        return "Data Penarikan";
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:F1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
   
            },
        ];
    }
}
