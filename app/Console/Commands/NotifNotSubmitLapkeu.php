<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\emiten;

class NotifNotSubmitLapkeu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notsubmitlapkeu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tanggalSekarang = Carbon::now()->format('d');
        if($tanggalSekarang == 1 || $tanggalSekarang > 5){
            $emitens = emiten::join('traders as t', 't.id', '=', 'emitens.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->where('emitens.is_deleted', 0)
                ->where('emitens.is_verified',1)
                ->select('u.email', 'emitens.company_name')
                ->whereNotIn('emitens.id', function($q){
                    $q->select('emitens_id')->from('financial_reports')
                        ->where('financial_reports.month', Carbon::now()->format('m'))
                        ->where('financial_reports.year', Carbon::now()->format('Y'))
                        ->where('financial_reports.is_deleted', 0)
                        ->groupBy('financial_reports.emitens_id');
                })
                ->get();
            foreach($emitens as $row){
                if (env('CONFIG_ENV') == 'dev') {
                    if($row->email == 'fatakhulafi11@gmail.com' || $row->email == 'technical@santara.co.id'){
                        $details = [
                            'subject' => 'Unggah Laporan Keuangan',
                            'company_name' => $row->company_name,
                            'bulan_lapkeu' => Carbon::now()->format('Y-m-d')
                        ];
                        \Mail::to($row->email)->send(new \App\Mail\EmailNotSubmitLapKeu($details));
                        \Log::info("Cron lapkeu is working fine!");
                    }
                }else{
                    $details = [
                        'subject' => 'Unggah Laporan Keuangan',
                        'company_name' => $row->company_name,
                        'bulan_lapkeu' => Carbon::now()->format('Y-m-d')
                    ];
                    \Mail::to($row->email)->send(new \App\Mail\EmailNotSubmitLapKeu($details));
                    \Log::info("Cron lapkeu is working fine!");
                }
            }
        }
    }
}
