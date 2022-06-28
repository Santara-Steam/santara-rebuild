<?php

namespace App\Console\Commands;

use App\Models\emitens_old;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class syncGroupNowPlaying extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:groupNp';

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
        $this->info("Running...");

//        $emitensActive = DB::connection('mysql2')
//            ->table('emitens')
//            ->join('emiten_journeys','emitens.id', '=', 'emiten_journeys.emiten_id')
//            ->where('emitens.is_active', '=', true)
//            ->groupBy('emiten_journeys.emiten_id')
////            ->where('last_emiten_journey', '!=', 'PRA PENAWARAN SAHAM')
////            ->Where('last_emiten_journey', '!=', 'PENAWARAN SAHAM')
//            ->get(['emitens.id', 'emitens.company_name', 'emitens.pictures', 'emitens.trademark']);
//        dd($emitensActive->toArray());

        $emitensActive = emitens_old::select(
            'emitens.id',
            'emitens.company_name',
            'emitens.pictures',
            'emitens.trademark',
            'emitens.price',
            'emitens.supply',
            'emitens.is_deleted',
            'emitens.is_active',
            'emitens.begin_period',
            'categories.category as ktg')
            ->leftjoin('categories', 'categories.id','=','emitens.category_id')
            // ->leftjoin('devidend', 'devidend.emiten_id','=','emitens.id')
            // ->leftjoin('transactions','transactions.emiten_id','=','emitens.id')
            // ->where('emitens.is_deleted',0)
            // ->whereRaw('emitens.end_period < now()')
            // ->Where('emitens.last_emiten_journey', '=', 'PENAWARAN SAHAM')
            // ->whereDate('emitens.end_period', '>=', now())  
            // ->whereDate('emitens.begin_period', '<=', now())                                 
            ->Where('emitens.is_coming_soon', '=', 0)
            ->Where('emitens.is_active', '=', 1)
            ->orderby('emitens.id','DESC')
            ->groupBy('emitens.id')
            ->get();

            // dd(now());
        $this->info("Found " . $emitensActive->count() . " Emitens...");
        $this->info("Ready to executing...");

        // foreach ($emitensActive as $emiten) {
        //     $db = DB::connection('chat');

        //     $groupExist = $db->table('groups')
        //         ->where('emiten_id', $emiten->id)
        //         ->first();

        //     if (!$groupExist) {
        //         $this->info("Creating group with emiten ID [". $emiten->id . "] ...");
        //         $response = Http::withHeaders([
        //             "Content-Type" => "application/json",
        //             "Accept" => "application/json",
        //             "email" => "admin@gmail.com",
        //             "password" => "12345678",
        //         ])->post(env('SANTARA_CHAT_BASE_URL') .'/api/groups', [
        //             "name" => $emiten->company_name,
        //             "description" => $emiten->trademark,
        //             "group_type" => 1, //closed group
        //             "privacy" => 2,
        //             "photo_url" => $emiten->pictures,
        //             "users" => [1],
        //             "emiten_id" => $emiten->id
        //         ])->json();
        //         $this->info("group created successfully");

        //     } else {
        //         $this->warn("groups with emiten ID [" . $emiten->id . "] already exist, skipped...");
        //     }
        // }
    }
}
