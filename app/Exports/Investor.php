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
            ->where('users.is_deleted', 0)
            ->orderBy('users.id', 'DESC')
            ->select('users.id', 'users.uuid', 't.name', 'users.email', 
                    't.phone')
            ->get();

        return view('admin.export.export-investor', ['user' => $user]);
    }

    public function title(): string
    {
        return "Data Investor";
    }
}
