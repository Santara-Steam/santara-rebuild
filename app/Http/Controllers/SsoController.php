<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SsoController extends Controller
{
    public function sso(Request $request): RedirectResponse
    {
        $payload = [
            "session" => $request->session()->all(),
            "email" => Auth::user()->email,
            "name" => Auth::user()->trader->name,
            "password" => Auth::user()->password,
        ];

        $response = json_decode(Http::post(config('global.SANTARA_CHAT_API_BASE_URL') . '/api/sso', $payload)->body(), true);

        if (isset($response['success']) && $response['success']) {
            return redirect()->away('http://localhost:8083');
        } else {
            return redirect()->back();
        }
    }
}
