<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Deposit;

class DepositExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
   
    protected $tglAwal, $tglAkhir;

    public function __construct($tglAwal, $tglAkhir) {
        $this->tglAwal = $tglAwal;
        $this->tglAkhir = $tglAkhir;
    }

    public function view(): View {
        $deposit = Deposit::join('traders as t', 't.id', '=', 'deposits.trader_id')
            ->join('users as u', 'u.id', '=', 't.user_id')
            ->leftJoin('virtual_accounts as va', 'va.deposit_id', '=', 'deposits.id')
            ->leftJoin('onepay_transaction as onepay', 'onepay.deposit_id', '=', 'deposits.id')
            ->whereBetween('deposits.created_at', [$this->tglAwal, $this->tglAkhir])
            ->select('deposits.id', 'deposits.uuid', 'deposits.amount', 'deposits.fee', 
                'u.email', 'deposits.confirmation_photo', 'deposits.split_fee',
                'deposits.bank_to', 'deposits.bank_from', 'deposits.channel', 'deposits.account_number', 
                'deposits.status', 'deposits.created_at', 'deposits.updated_at', 't.name as trader_name', 
                'deposits.created_by', 'va.account_number as va_account_number', 'va.bank as va_bank', 't.phone',
                'onepay.transaction_no')
            ->orderBy('deposits.created_at', 'DESC')
            ->get();
            return view('admin.export.export-deposit', ['deposit' => $deposit, 'tglAwal' => $this->tglAwal, 'tglAkhir' => $this->tglAkhir]);
    }

    public function title(): string
    {
        return "Data Deposit";
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:G1')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
   
            },
        ];
    }



}
