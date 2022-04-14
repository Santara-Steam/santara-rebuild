<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class UserLoggedIn
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //
        // app('request')->session()->put('test', Auth::user()->id);
        try {
            $client = new Client();
  
            $response = $client->request('POST', env("BASE_API_CLIENT_URL").'/v3.7.1/auth/login/', [
              'headers' => [
                'Origin'        => env("BASE_API_FILE")
              ],
              'form_params' => [
                'email' => Auth::user()->email,
                'password' => app('request')->session()->get('pwd')
              ],
            ]);
            
            // app('request')->session()->put('test', $response->getStatusCode());
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody()->getContents(), TRUE);
                app('request')->session()->put('token', $result['token']['token']);

            }
        } catch (\Exception $exception) {
                // $statusCode = $exception->getResponse()->getStatusCode();
                // $exception->getResponse()->getStatusCode();
                // $response = $exception->getResponse();
                // $responseBody = $response->getBody()->getContents();
                // $body = json_decode($responseBody, true);
                // // echo json_encode(count($body));
                // echo json_encode(['msg' => isset($body['message']) ?  $body['message'] : 'Server error ' . $exception->getResponse()->getStatusCode()]);
            app('request')->session()->put('token', 'fail');

        }
    }
}
