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

        $np = emiten(99, 1, null, null, null, null, null, 'saham', 'notfull');
        $now_playing = collect($np);

        $this->info("Found " . $now_playing->count() . " Emitens...");
        $this->info("Ready to executing...");

    }
}
