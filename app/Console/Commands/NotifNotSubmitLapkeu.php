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

    public $tahun;
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
            $bulanSekarang = Carbon::now()->format('m');
            $this->tahun = Carbon::now()->format('Y');
            if($bulanSekarang == 1){
                $this->tahun = Carbon::now()->format('Y');
                $this->tahun = $this->tahun - 1;
            }
            $detTanggal = $this->tahun.'-'.Carbon::now()->subMonth()->format('m').'-'.$tanggalSekarang;
            $emitens = emiten::select('emitens.id','u.email', 'emitens.company_name', 'emitens.price', 'emitens.supply', 'emitens.is_deleted',
                'emitens.is_active', 'emitens.begin_period')
                ->join('traders as t', 't.id', '=', 'emitens.trader_id')
                ->join('users as u', 'u.id', '=', 't.user_id')
                ->leftjoin('transactions','transactions.emiten_id','=','emitens.id')
                ->where('emitens.is_deleted',0)
                ->whereNotIn('emitens.id', function($q){
                    $q->select('emitens_id')->from('financial_reports')
                        ->where('financial_reports.month', Carbon::now()->subMonth()->format('m'))
                        ->where('financial_reports.year', $this->tahun)
                        ->where('financial_reports.is_deleted', 0)
                        ->groupBy('financial_reports.emitens_id');
                })
                ->groupBy('emitens.id')
                ->havingRaw('CONVERT(ROUND(
                    IF(
                    (SUM(
                        IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply > 1, 1,
                        (SUM(
                            IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply) * 100, 2), char) = 100.00
                            and 
                            emitens.is_deleted = 0
                            and emitens.is_active = 1
                            and emitens.begin_period < now()')
                ->get();
            foreach($emitens as $row){
                if (config('global.CONFIG_ENV_GLOBAL') == "DEV"){
                    if($row->email == 'fatakhulafi11@gmail.com'){
                        $details = [
                            'subject' => 'Unggah Laporan Keuangan',
                            'company_name' => $row->company_name,
                            'bulan_lapkeu' => $detTanggal
                        ];
                        \Mail::to($row->email)->send(new \App\Mail\EmailNotSubmitLapKeu($details));
                        \Log::info("Cron lapkeu is working fine!");
                    }
                }else{
                    $details = [
                        'subject' => 'Unggah Laporan Keuangan',
                        'company_name' => $row->company_name,
                        'bulan_lapkeu' => $detTanggal
                    ];
                    \Mail::to($row->email)->send(new \App\Mail\EmailNotSubmitLapKeu($details));
                    \Log::info("Cron lapkeu is working fine!");
                }
            }
        }
    }
}
