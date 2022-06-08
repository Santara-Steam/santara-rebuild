<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SsoController extends Controller
{
    public function sso(Request $request): RedirectResponse
    {
        $chatUrl = config('global.SANTARA_CHAT_API_BASE_URL');

        $payload = [
            "session" => $request->session()->all(),
            "userId" => Auth::user()->getAuthIdentifier(),
            "email" => Auth::user()->email,
            "name" => Auth::user()->trader->name,
            "password" => $request->session()->get('pwd')
        ];

        $response = json_decode(Http::post( $chatUrl . '/api/sso', $payload)->body(), true);

        if (isset($response['success']) && $response['success']) {
            return redirect()->away($chatUrl . "/sso");
        } else {
            return redirect()->back();
        }
    }
}
