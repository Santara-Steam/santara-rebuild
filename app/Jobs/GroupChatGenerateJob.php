<?php

namespace App\Jobs;

use App\Helpers\AuthHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class GroupChatGenerateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $request;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return RedirectResponse
     */
    public function handle()
    {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "email" => $this->request['email'],
            "password" => $this->request['password'],
        ])->post(env('SANTARA_CHAT_BASE_URL') . '/api/groups', [
            "name" => $this->request['name'],
            "description" => $this->request['description'],
            "group_type" => 2, //closed group
            "privacy" => 2, //private group
            "photo_url" => $this->request['photo_url'],
            "users" => $this->request['users'],
            "emiten_id" => $this->request['emiten_id']
        ])->json();

        if (!$response['success']) {
            return redirect()->back()->with([
                'message' => 'Error when creating group chat',
                'alert-type' => 'danger'
            ]);
        }
    }
}
