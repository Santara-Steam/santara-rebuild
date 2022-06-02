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

class Investor implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    
    protected $tglAwal, $tglAkhir;

    public function __construct($tglAwal, $tglAkhir) {
        $this->tglAwal = $tglAwal;
        $this->tglAkhir = $tglAkhir;
    }

    public function view(): View
    {
        $user = User::join('traders as t', 'users.id', '=', 't.user_id')
            ->leftJoin('trader_banks as bank', 'bank.trader_id', '=', 't.id')
            ->leftJoin('bank_investors as bank_invest', 'bank_invest.id', '=', 'bank.bank_investor1')
            ->leftJoin('regencies as reg', 'reg.id', '=', 't.birth_place')
            ->where('users.is_deleted', 0)
            ->whereBetween('users.created_at', [$this->tglAwal, $this->tglAkhir])
            ->orderBy('users.id', 'DESC')
            ->select('users.id', 'users.uuid', 't.name', 'users.email', 
                    't.phone', 't.job', 't.birth_place', 't.birth_date', 't.gender', 'bank.account_number1',
                    'bank_invest.bank', 'reg.name as tempat_lahir')
            ->get();

        return view('admin.export.export-investor', ['user' => $user, 'tglAwal' => $this->tglAwal, 'tglAkhir' => $this->tglAkhir]);
    }

    public function title(): string
    {
        return "Data Investor";
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:I1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
   
            },
        ];
    }
}
