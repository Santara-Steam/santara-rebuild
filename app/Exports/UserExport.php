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

class UserExport implements FromView, WithTitle, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $user = User::join('roles as r', 'r.id', '=', 'users.role_id')
            ->join('traders as t', 'users.id', '=', 't.user_id')
            ->where('users.is_deleted', 0)
            ->orderBy('users.id', 'DESC')
            ->select('users.id', 'users.uuid', 't.name', 'users.email', 
                    't.phone', 'users.created_at', 'r.name as role_name')
            ->get();

        return view('admin.export.export-user', ['user' => $user]);
    }

    public function title(): string
    {
        return "Data User";
    }
}
