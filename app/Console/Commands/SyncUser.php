<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:user';

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
        $this->line("Running command...");

        $users = User::all();

        $this->info("Found [{$users->count()}] users on Santara...\n");

        foreach ($users as $user) {
            $this->line("Search user on Santara-chat...\n");
            $chatConnection = DB::connection('chat');

            $chatUser = $chatConnection
                ->table('users')
                ->where('email', $user->email)
                ->first();

            if (!$chatUser) {
                $this->info("Migrating user with email [{$user->email}] ...");

                $newUser = $chatConnection->table('users')
                    ->insert([
                        'id' => $user->id,
                        'name' => $user->trader->name ?: $user->email,
                        'email' => $user->email,
                        'email_verified_at' => now()->format('Y-m-d H:i:s'),
                        'password' => $user->password,
                        'is_active' => true,
                    ]);
                if ($newUser) {
                    $this->info("User with email [{$user->email}] was created...\n");
                    $this->info("Attaching role to user with email [{$user->email}] ...\n");

                    $chatConnection->table('model_has_roles')
                        ->insert([
                            'role_id' => $user->role->name == 'Admin' ? 1 : 2,
                            'model_type' => 'App\Models\User',
                            'model_id' => $user->id
                        ]);
                    $this->info("Role user with email [{$user->email}] attached...\n");
                }
            } else {
                $this->warn("User with email [{$user->email}] found, skipped!\n");
            }
        }
    }
}
