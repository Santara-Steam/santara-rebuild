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

class Investor implements FromView, WithTitle, ShouldAutoSize
{
    public function view(): View
    {
        $user = User::join('traders as t', 'users.id', '=', 't.user_id')
            ->join('balance_utama as bu', 'bu.trader_id', '=', 't.id')
            ->leftJoin('trader_banks as bank', 'bank.trader_id', '=', 'traders.id')
            ->leftJoin('bank_investors as bank_invest', 'bank_invest.id', '=', 'bank.bank_investor1')
            ->where('users.is_deleted', 0)
            ->orderBy('users.id', 'DESC')
            ->select('users.id', 'users.uuid', 't.name', 'users.email', 
                    't.phone', 't.job', 't.birth_place', 't.birth_date', 't.gender', 'bank.account_number1',
                    'bank_invest.bank')
            ->get();

        return view('admin.export.export-investor', ['user' => $user]);
    }

    public function title(): string
    {
        return "Data Investor";
    }
}
