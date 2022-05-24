<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\User;
use DB;

class TransaksiExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    protected $tglAwal, $tglAkhir;

    public function __construct($tglAwal, $tglAkhir) {
        $this->tglAwal = $tglAwal;
        $this->tglAkhir = $tglAkhir;
    }

    public function view(): View {
        $transactions = User::join('traders as t', 't.user_id', '=', 'users.id')
            ->join('transactions as tr', 'tr.trader_id', '=', 't.id')
            ->join('emitens as e', 'e.id', '=', 'tr.emiten_id')
            ->leftJoin('onepay_transaction as onepay', 'onepay.transaction_id', '=', 'tr.id')
            ->whereBetween('tr.created_at', [$this->tglAwal, $this->tglAkhir])
            ->where('tr.is_deleted', 0)
            ->select('tr.id', 'tr.uuid', 't.name as trader_name', 'users.email as user_email', 
                't.id as trader_id', 'e.code_emiten', DB::raw('CONCAT("SAN","-", tr.id, "-", e.code_emiten) as transaction_serial'), 
                'tr.channel', 'tr.description', 'tr.is_verified', 'tr.split_fee', 'tr.created_at as created_at', 
                'tr.amount', 'tr.fee', 'e.price', DB::raw('(tr.amount/e.price) as qty'), 
                'tr.last_status as status', 't.phone', 'onepay.transaction_no')
            ->orderBy('tr.created_at', 'DESC')
            ->get();
        return view('admin.export.export-transaksi', ['transactions' => $transactions, 'tglAwal' => $this->tglAwal, 'tglAkhir' => $this->tglAkhir]);
    }

    public function title(): string
    {
        return "Data Transaksi";
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
