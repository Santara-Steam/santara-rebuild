<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Deviden;

class DividenExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    protected $tglAwal, $tglAkhir;

    public function __construct($tglAwal, $tglAkhir) {
        $this->tglAwal = $tglAwal;
        $this->tglAkhir = $tglAkhir;
    }

    public function view(): View {
        $devidens = Deviden::join('traders as t', 't.id', '=', 'bagihasils.trader_id')
                    ->join('users as u', 'u.id', '=', 't.user_id')
                    ->join('emitens as e', 'e.id', '=', 'bagihasils.emiten_id')
                    ->where('bagihasils.is_deleted', 0)
                    ->whereDate('bagihasils.updated_at', '>=', $this->tglAwal)
                    ->whereDate('bagihasils.updated_at', '<=', $this->tglAkhir)
                    ->groupBy('bagihasils.trader_id', 'bagihasils.status','bagihasils.updated_at')
                    ->orderBy('bagihasils.updated_at', 'DESC')
                    ->select('bagihasils.id', 'u.email', 't.uuid as uuid', 't.name', 't.phone', 'e.company_name', 
                        'bagihasils.trader_id', \DB::raw('sum(bagihasils.devidend) as devidend'), 'bagihasils.fee', 
                        'bagihasils.bank', 'bagihasils.account_number', 'bagihasils.status', 'bagihasils.created_at', 
                        'bagihasils.updated_at', 'bagihasils.bank', 'bagihasils.account_number', 
                        'bagihasils.account_name', 'bagihasils.bank_kota', 'bagihasils.bank_cabang', 'bagihasils.deposit_id', 
                        'bagihasils.channel', 'bagihasils.external_id')
                    ->orderBy('bagihasils.created_at', 'DESC')
                    ->get();
        return view('admin.export.export-dividen', ['devidens' => $devidens, 
            'tglAwal' => $this->tglAwal, 
            'tglAkhir' => $this->tglAkhir]);
    }

    public function title(): string
    {
        return "Data Dividen";
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
