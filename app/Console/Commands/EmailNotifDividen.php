<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\emiten;

class EmailNotifDividen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifdividen:cron';

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
        $emiten = emiten::join('traders as t', 't.id', '=', 'emitens.trader_id')
            ->join('users as u', 'u.id', '=', 't.user_id')
            ->where('emitens.id', 16)
            ->select('u.email', 'emitens.company_name', 'emitens.begin_period')
            ->first();
        $details = [
            'subject' => 'Pembagian Dividen',
            'company_name' => $emiten->company_name,
            'tanggal_dividen' => $emiten->begin_period
        ];
        \Mail::to($emiten->email)->send(new \App\Mail\NotifPemberitahuanDividen($details));
        \Log::info("Cron is working fine!");
    }
}
