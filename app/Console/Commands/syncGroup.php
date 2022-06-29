<?php

namespace App\Console\Commands;

use App\Helpers\EmitenHelper;
use App\Models\emitens_old;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class syncGroup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:group';

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

        $emitensActive = EmitenHelper::Active()->toArray();

        $this->info("Found " . $emitensActive->count() . " Emitens...");
        $this->info("Ready to executing...");

        foreach ($emitensActive as $emiten) {
            $db = DB::connection('chat');
            $groupExist = $db->table('groups')
                ->where('emiten_id', $emiten->id)
                ->first();

            if (!$groupExist) {
                $this->info("Creating group with emiten ID [". $emiten->id . "] ...");
                $response = Http::withHeaders([
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                    "email" => "admin@gmail.com",
                    "password" => "12345678",
                ])->post(env('SANTARA_CHAT_BASE_URL') .'/api/groups', [
                    "name" => $emiten->company_name,
                    "description" => $emiten->trademark,
                    "group_type" => 1, //closed group
                    "privacy" => 2,
                    "photo_url" => $emiten->pictures,
                    "users" => [1],
                    "emiten_id" => $emiten->id
                ])->json();
                $this->info("group created successfully");

            } else {
                $this->warn("groups with emiten ID [" . $emiten->id . "] already exist, skipped...");
            }
        }
    }
}
