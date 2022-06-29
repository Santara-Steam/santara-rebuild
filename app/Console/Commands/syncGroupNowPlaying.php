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

    function emitenn($limit, $offset, $search, $minimal, $maksimal, $category, $sort, $type, $jenis)
	{
		// $CI = &get_instance();
		$data = null;
		$url = '/v3.7.1/emitens/emiten?projectValue1=' . $minimal . '&projectValue2=' . $maksimal . '&category=' . $category . '&search=' . $search . '&sort=' . $sort . '&pageSize=' . $limit . '&pageNumber=' . $offset . '&type=' . $type . '&jenis=' . $jenis;

		try {
			$client = new \GuzzleHttp\Client();

			$headers = [
				'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOjMxODAyNCwiZGF0YSI6eyJpZCI6MzE4MDI0LCJ1dWlkIjoiMWI0Zjg2ZmEtMjhlYS00ZTJhLWEyMjgtNDNmNzBkN2I5MTNlIiwiZW1haWwiOiJyaXNmYW5kaWJheXUxOUBnbWFpbC5jb20iLCJjcmVhdGVkX2F0IjoiMjAyMi0wNC0wNiAxMDo1NTozNCIsInVwZGF0ZWRfYXQiOiIyMDIyLTA2LTI3IDIxOjI5OjA4IiwiZGVsZXRlZF9hdCI6bnVsbCwicm9sZV9pZCI6MiwiaXNfdmVyaWZpZWQiOjEsInR3b19mYWN0b3JfYXV0aCI6MCwidHdvX2ZhY3Rvcl9zZWNyZXQiOm51bGwsImlzX2xvZ2dlZF9pbiI6MSwiaXNfZGVsZXRlZCI6MCwiY3JlYXRlZF9ieSI6bnVsbCwidXBkYXRlZF9ieSI6bnVsbCwiaXNfb3RwIjoxLCJhdHRlbXB0IjoyLCJhdHRlbXB0X2VtYWlsIjowLCJmaW5nZXJfcHJpbnQiOm51bGwsImF0dGVtcHRfb3RwIjowLCJhdHRlbXB0X3BpbiI6MCwibmFtZSI6IlJpc2ZhbmRpIiwidHJhZGVyX3R5cGUiOiJwZXJzb25hbCIsImlzX3Jlc2V0X3Bhc3N3b3JkIjoxLCJpc192ZXJpZmllZF9reWMiOjEsInJvbGVfbmFtZSI6IlRyYWRlciJ9LCJpYXQiOjE2NTY0MjYwMjJ9.jyss5lVypmDbNx7foVZ2lUqXpphXBYW45B45NQxAvog',
				'Accept'        => 'application/json',
				'Content-type'  => 'application/json'
			];

			$response = $client->request('GET', config('global.BASE_API_CLIENT_URL') . $url, [
				'headers' => $headers,
			]);

			if ($response->getStatusCode() == 200) {
				$data = json_decode($response->getBody()->getContents(), TRUE);
			}
		} catch (\Exception $exception) {
			$data = null;
		}

		return $data;
	}

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

        // $emitensActive = emitens_old::select(
        //     'emitens.id',
        //     'emitens.company_name',
        //     'emitens.pictures',
        //     'emitens.trademark',
        //     'emitens.price',
        //     'emitens.supply',
        //     'emitens.is_deleted',
        //     'emitens.is_active',
        //     'emitens.begin_period',
        //     'categories.category as ktg', DB::raw("SUM(Distinct(devidend.devidend)) as dvd"),  DB::raw("COUNT(Distinct(devidend.id)) as dvc"))
        //     ->leftjoin('categories', 'categories.id','=','emitens.category_id')
        //     ->leftjoin('devidend', 'devidend.emiten_id','=','emitens.id')
        //     ->leftjoin('transactions','transactions.emiten_id','=','emitens.id')
        //     // ->where('emitens.is_deleted',0)
        //     // ->whereRaw('emitens.end_period < now()')
        //     ->orderby('emitens.id','DESC')
        //     ->groupBy('emitens.id')
        //     ->havingRaw('CONVERT(ROUND(
        //     IF(
        //       (SUM(
        //         IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply > 1, 1,
        //           (SUM(
        //             IF(transactions.is_verified = 1 and transactions.is_deleted = 0, transactions.amount, 0)) / emitens.price) / emitens.supply) * 100, 2), char) = 100.00
        //             and
        //             emitens.is_deleted = 0
        //             and emitens.is_active = 1
        //             and emitens.begin_period < now()')
        //     ->get();
        
        

        $np = $this->emitenn(99, 1, null, null, null, null, null, 'saham', 'notfull');
        $now_playing = collect($np);

        $this->info("Found " . $now_playing->count() . " Emitens...");
        $this->info("Ready to executing...");

        foreach ($now_playing as $emiten) {
            $db = DB::connection('chat');

            $groupExist = $db->table('groups')
                ->where('emiten_id', $emiten['id'])
                ->first();

            if (!$groupExist) {
                $this->info("Creating group with emiten ID [". $emiten['id'] . "] ...");
                $response = Http::withHeaders([
                    "Content-Type" => "application/json",
                    "Accept" => "application/json",
                    "email" => "admin@gmail.com",
                    "password" => "12345678",
                ])->post(env('SANTARA_CHAT_BASE_URL') .'/api/groups', [
                    "name" => $emiten['company_name'],
                    "description" => $emiten['trademark'],
                    "group_type" => 1, //closed group
                    "privacy" => 2,
                    "photo_url" => $emiten['pictures'],
                    "users" => [1],
                    "emiten_id" => $emiten['id']
                ])->json();
                $this->info("group created successfully");

            } else {
                $this->warn("groups with emiten ID [" . $emiten['id'] . "] already exist, skipped...");
            }
        }
    }
}
